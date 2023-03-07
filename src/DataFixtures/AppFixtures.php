<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create('fr_FR');
        //on fait une boucle pour créer 10 users
        for ($i = 0; $i <10; $i ++)
        {
            
            $user = new User;
            $user
                ->setUsername($faker->firstName().'_' . $faker->lastName())
                ->setAvatar($faker->imageUrl(640, 480, 'animals', true))
                ->setEmail($faker->safeEmail())
                ->setPassword($faker->sha256())
                ->setIsSubscribed($faker->boolean())
                ->setRoles(['ROLE_USER'])
            ;
            $manager->persist($user);
            //j'ai cree un objet et je sauvegarde (ca cree une liste d'attente avant flush)
        }

        $manager->flush();
    }
}
