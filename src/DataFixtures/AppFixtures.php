<?php

namespace App\DataFixtures;

use App\Factory\EvenementFactory;
use App\Factory\JeuFactory;
use App\Factory\UtilisateurFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        EvenementFactory::createMany(10); //nombres de lignes à créer pour évènement
        JeuFactory::createMany(10); //nombres de lignes à créer pour jeu
        UtilisateurFactory::createMany(10); //nombres de lignes à créer pour utilisateur

        $manager->flush();
    }
}
