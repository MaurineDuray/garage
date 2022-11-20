<?php

namespace App\Form;


use App\Entity\Voitures;

use App\Form\PicturesType;
use App\Form\ApplicationType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class VoituresType extends ApplicationType
{
    /**
     * Création du formulaire d'ajout d'un véhicule ua showroom, on utilise getConfiguration pour faciliter la mise en page du formulaire (Application Type)
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque',ChoiceType::class,[
                'label'=>'Marque du véhicule',
                'required'=>'true',
                'placeholder'=>"Choisissez la marque du véhicule",
                'choices'=>[
                    "Renault"=>"Renault",
                    "Peugeot"=>"Peugeot",
                    "Opel"=>"Opel",
                    "Fiat"=>"Fiat",
                    "Mercedes"=>"Mercedes",
                    "Jaguar"=>"Jaguar",
                    "Skoda"=>"Skoda",
                    "Cadillac"=>"Cadillac",
                    "Ford"=>"Ford"
                    ]
                    ],  
                    )
            ->add('modele',TextType::class, $this->getConfiguration('Modèle du véhicule', "Modèle du véhicule"))
            ->add('image', FileType::class,[
                'label'=>"Image de couverture (jpg, jpeg, png)",
            ])
            ->add('km',IntegerType::class,$this->getConfiguration('Nombre de kilomètres', "Donnez le nombre de kilomètres au compteur"))
            ->add('prix', MoneyType::class,$this->getConfiguration('Prix (minimum: 5000 €)', "Donnez le prix du véhicule"))
            ->add('nbProprio',IntegerType::class,$this->getConfiguration('Nombre de propriétaires', "Donnez le nombre de propriétaires qui ont eu le véhicule"))
            ->add('cylindree',IntegerType::class,$this->getConfiguration('Nombre de cylindres (de 1 à 12)', "Donnez le nombre de cylindres (de 1 à 12)"))
            ->add('puissance',IntegerType::class,$this->getConfiguration('Nombre de chevaux (max:200)', "Donnez le nombre de cheveaux du véhicule (max:200)"))
            ->add('carburant',ChoiceType::class,[
                'label'=>'Carburant du véhicule',
                'required'=>'true',
                'placeholder'=>"Choisissez le carburant du véhicule",
                'choices'=>[
                        "Essence"=>"Essence",
                        "Diesel"=>"Diesel",
                        "Electrique"=>"Electrique"
                        ]
                        ],  
                    )
            ->add('annee',IntegerType::class,$this->getConfiguration('Année de mise en circulation', "Donnez l'année de mise en circulation du véhicule"))
            ->add('transmission',ChoiceType::class,[
                'label'=>'Transmission du véhicule',
                'required'=>'true',
                'placeholder'=>"Choisissez la transmission du véhicule",
                'choices'=>[
                        "Manuelle"=>"Manuelle",
                        "Automatique"=>"Automatique"
                        ],  
                    ])
            ->add('description',TextType::class, $this->getConfiguration('Description', "Donnez une description du véhicule"))
            ->add('options',TextType::class, $this->getConfiguration('Options du véhicule', "Listez les options du véhicule"),)
            ->add('slug', TextType::class, $this->getConfiguration('Slug', 'Adresse web (automatique)',[
                'required' => false
            ]))
            ->add(
                'pictures',
                CollectionType::class,
                [
                    'entry_type'=> PicturesType::class,
                    'allow_add'=>true,
                    'allow_delete'=>true,
                    
                    
                ]
            )
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voitures::class,
        ]);
    }
}
