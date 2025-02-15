<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $users = [
            ['admin', 'admin@exemple.com', 'admin123', ['ROLE_ADMIN'], 0],
            ['user1', 'user1@exemple.com', 'user123', ['ROLE_USER'], 1],
        ];

        foreach ($users as [$username, $email, $password, $roles, $departementRef]) {
            $user = new User();
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setRoles($roles);
            $user->setPassword($this->passwordHasher->hashPassword($user, $password));
            $user->setDepartement($this->getReference('departement_' . $departementRef));

            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [GeoFixtures::class]; // Dépend de la fixture GeoFixtures
    }
}
