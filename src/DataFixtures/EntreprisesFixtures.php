<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;

class EntreprisesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $entreprise = new Entreprise();
            $entreprise->setName("Nom de l'entreprise $i")
                       ->setAdresse("Adresse de l'entreprise $i")
                       ->setDescription("Description de l'entreprise $i")
                       ->setTitre("Titre de l'entreprise $i ")
                       ->setContact("Contact de l'entreprise $i")
                       ->setImage("http://placehold.it/350x150")
                       ->setDate(new \DateTime());
            $manager->persist($entreprise);
        }
        $manager->flush();
    }
}
