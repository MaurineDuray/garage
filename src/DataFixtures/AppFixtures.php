<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Image;
use App\Entity\Pictures;
use App\Entity\Voitures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    // gestion du hash du password 
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    
    /**
     * Création des données factices pour remplir notre bdd pour avoir un aperçu du site "rempli"
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        //création d'un admin 
        $admin = new User();
        $admin->setFirstName('Maurine')
            ->setLastName('Duray')
            ->setEmail('maurine.duray@proximus.be')
            ->setPassword($this->passwordHasher->hashPassword($admin, 'password'))
            ->setIntroduction($faker->sentence())
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        

        

        $marques = ['Renault', 'Peugeot', 'Opel', 'Fiat', 'Mercedes', 'Jaguar', 'Skoda', 'Cadillac', 'Ford'];
        $modeles=['Poussièreuse', 'Caisse à savons', 'Caisse à savon', 'Troies roues', 'Boîte à clous', 'Collection'];
        $carburants=['diesel','essence'];
        $transmissions=['manuelle', 'automatique',];
        $images=["voiture1.jpg","voiture2.jpg","voiture3.jpg","voiture4.jpg","voiture5.jpg","voiture6.jpg","voiture7.jpg","voiture8.jpg","voiture9.jpg","voiture10.jpg"];
        $galeriephoto=[
            'https://www.holtsauto.com/fr/wp-content/uploads/sites/7/2019/06/Vintage-car-dashboard.jpg',
            'https://www.holtsauto.com/fr/wp-content/uploads/sites/7/2019/06/Interior-Dashboard-of-a-Classic-Car.jpg',
            'https://www.wedrivit.com/blog/wp-content/uploads/2021/09/Capture-de%CC%81cran-2021-09-23-a%CC%80-15.32.16.png',
            'https://www.france-troc.com/ImgUsers/annonces/2012/03/562058/wxb2fh.jpg',
            'https://parisbouge.s3.amazonaws.com/news-upload/1920/citroen-2-4230087976.jpg'
        ];
        for($i=1; $i <= 30 ; $i++)
        {
            $voiture = new Voitures();
            $marque = $faker->randomElement($marques);
           
            $modele = $faker->randomElement($modeles);
            $carburant = $faker->randomElement($carburants);
           
            $transmission= $faker->randomElement($transmissions);
            $description = $faker->paragraph(2);
            $options = $faker->sentence();
            $image = $faker->randomElement($images);
            
            $galerie = $faker->randomElement($galeriephoto);

            $voiture->setMarque($marque)
                ->setModele($modele)
                ->setImage($image)
                ->setKm(rand(0,50000))
                ->setPrix(rand(5000,190000))
                ->setNbProprio(rand(1,5))
                ->setCylindree(rand(1,5000))
                ->setPuissance(rand(1,200))
                ->setCarburant($carburant)
                ->setAnnee(rand(1800,2000))
                ->setTransmission($transmission)
                ->setDescription($description)
                ->setOptions($options)
               ;


            $manager->persist($voiture);

            for($j=1; $j<=rand(2,5) ; $j++)
            {
                $picture = new Pictures();
                $picture ->setFile($galerie)
                    ->setCaption($faker->sentence())
                    ->setVoitureId($voiture);
                $manager->persist($picture);
            }

       
        }
      
        $manager->flush();
       
    }
}
