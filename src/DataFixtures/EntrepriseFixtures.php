<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EntrepriseFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $entreprise = new Entreprise();
        $entreprise ->setName('Entreprise La Fonderie')
                    ->setActivity('fonderie')
                    ->setAdress('10 rue de la fonte 05000 la fonte')
                    ->setSite('www.lafonderie.fr')
                    ->setExponent('Dupond Martin');
        $manager->persist($entreprise);
    

        $manager->flush();
    }
}
