<?php


namespace App\Tests;

use App\DataFixtures\GeoFixtures;
use App\Entity\Departement;
use App\Entity\Region;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class GeoApiTest extends KernelTestCase
{
    public function testGeoFixtures(): void
    {
        self::bootKernel();
        $container = self::$kernel->getContainer();

        $httpClient = $this->createMock(HttpClientInterface::class);
        $responseMockRegions = $this->createMock(ResponseInterface::class);
        $responseMockDepartments = $this->createMock(ResponseInterface::class);

        $regionsData = [
            ['code' => '11', 'nom' => 'Île-de-France'],
            ['code' => '84', 'nom' => 'Auvergne-Rhône-Alpes']
        ];

        $departmentsData = [
            ['code' => '75', 'nom' => 'Paris', 'codeRegion' => '11'],
            ['code' => '69', 'nom' => 'Rhône', 'codeRegion' => '84']
        ];

        $responseMockRegions->method('toArray')->willReturn($regionsData);
        $responseMockDepartments->method('toArray')->willReturn($departmentsData);

        $httpClient->method('request')->willReturnMap([
            ['GET', 'https://geo.api.gouv.fr/regions', [], $responseMockRegions],
            ['GET', 'https://geo.api.gouv.fr/departements', [], $responseMockDepartments],
        ]);

        $entityManager = $container->get('doctrine')->getManager();
        $fixture = new GeoFixtures($httpClient);

        $loader = new Loader();
        $loader->addFixture($fixture);

        $purger = new ORMPurger($entityManager);
        $executor = new ORMExecutor($entityManager, $purger);
        $executor->execute($loader->getFixtures());

        $regionRepo = $entityManager->getRepository(Region::class);
        $departementRepo = $entityManager->getRepository(Departement::class);

        $this->assertCount(2, $regionRepo->findAll());
        $this->assertCount(2, $departementRepo->findAll());

        $paris = $departementRepo->findOneBy(['code' => '75']);
        $this->assertNotNull($paris);
        $this->assertEquals('Paris', $paris->getLibelle());
        $this->assertEquals('Île-de-France', $paris->getRegion()->getLibelle());
    }
}
