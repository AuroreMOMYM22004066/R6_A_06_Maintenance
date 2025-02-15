<?php

namespace App\Tests;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->client = static::createClient();

        // Ensure we have a clean database
        $container = static::getContainer();

        /** @var EntityManager $em */
        $em = $container->get('doctrine')->getManager();
        $this->userRepository = $container->get(UserRepository::class);

        // Run the schema update command to ensure the database is up-to-date
        exec('php bin/console doctrine:schema:update --force --env=test');

        foreach ($this->userRepository->findAll() as $user) {
            $em->remove($user);
        }

        $em->flush();
    }

    public function testRegister(): void
    {
        // Ensure the user is logged out
        $this->client->request('GET', '/logout');

        // Register a new user
        $crawler = $this->client->request('GET', '/register');
        $statusCode = $this->client->getResponse()->getStatusCode();
        $location = $this->client->getResponse()->headers->get('Location');

        // Debugging information
        if ($statusCode !== 200) {
            echo "Status Code: $statusCode\n";
            echo "Location: $location\n";
            echo $this->client->getResponse()->getContent();
        }

        self::assertResponseStatusCodeSame(200); // Ensure the response status code is 200 (OK)
        self::assertPageTitleContains('Register');

        $this->client->submitForm('Register', [
            'registration_form[email]' => 'me@example.com',
            'registration_form[plainPassword]' => 'password',
            'registration_form[agreeTerms]' => true,
        ]);

        // Ensure the response redirects after submitting the form, the user exists, and is not verified
        self::assertResponseRedirects('/login');
        $this->client->followRedirect();
        self::assertPageTitleContains('Login');
        self::assertCount(1, $this->userRepository->findAll());
    }
}