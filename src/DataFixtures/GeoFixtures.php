<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use App\Entity\Region;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GeoFixtures extends Fixture
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function load(ObjectManager $manager): void
    {
        // Récupérer les régions
        $response = $this->httpClient->request('GET', 'https://geo.api.gouv.fr/regions');
        $regionsData = $response->toArray();

        $regions = [];
        foreach ($regionsData as $data) {
            $region = new Region();
            $region->setLibelle($data['nom']);
            $manager->persist($region);
            $regions[$data['code']] = $region; // Stocker pour lier aux départements
        }
        $manager->flush();

        // Récupérer les départements
        $response = $this->httpClient->request('GET', 'https://geo.api.gouv.fr/departements');
        $departementsData = $response->toArray();

        foreach ($departementsData as $data) {
            $departement = new Departement();
            $departement->setLibelle($data['nom']);
            $departement->setCode($data['code']);

            // Lier au bon objet Region
            if (isset($regions[$data['codeRegion']])) {
                $departement->setRegion($regions[$data['codeRegion']]);
            }

            $manager->persist($departement);
        }

        $manager->flush();
    }
}
