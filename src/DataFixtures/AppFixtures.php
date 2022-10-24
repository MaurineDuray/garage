<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Voitures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // $product = new Product();
        // $manager->persist($product);

        $marques = ['Citroën', 'Peugeot', 'Fiat', 'BMW', 'Mini', 'Jaguar'];
        $modeles=['Boîte à clous', 'Caisse à savons', 'Vieille caisse', 'Vieux broll'];
        $carburants=['diesel','essence','gaz','électricité','hybride'];
        $transmissions=['arrière', 'avant','générale'];
        for($i=1; $i <= 30 ; $i++)
        {
            $voiture = new Voitures();
            $marque = $faker->randomElement($marques);
           
            $modele = $faker->randomElement($modeles);
            $carburant = $faker->randomElement($carburants);
           
            $transmission= $faker->randomElement($transmissions);
            $description = $faker->paragraph(2);
            $options = $faker->sentence();
            

            $voiture->setMarque($marque)
                ->setModele($modele)
                ->setImage('https://picsum.photos/1000/350')
                ->setKm(rand(0,50000))
                ->setPrix(rand(5000,120000))
                ->setNbProprio(rand(1,5))
                ->setCylindree(rand(1,4))
                ->setPuissance(rand(1,200))
                ->setCarburant($carburant)
                ->setAnnee(rand(1885,2030))
                ->setTransmission($transmission)
                ->setDescription($description)
                ->setOptions($options)
                
               ;


            $manager->persist($voiture);

        }
        $manager->flush();
    }
}
