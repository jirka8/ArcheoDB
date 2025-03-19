<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        /*
        Create a new user with the following credentials:
        - email: test@test.com
        - password: password
        */

        $user = new User();
        $user->setEmail('test@test.com');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
        $manager->persist($user);

        $category1 = new Categories();
        $category1->setTitle('Category 1');
        $manager->persist($category1);

        $category2 = new Categories();
        $category2->setTitle('Category 2');
        $category2->setParent($category1);
        $manager->persist($category2);

        $manager->flush();
    }
}
