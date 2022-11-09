<?php

namespace App\Form;


use App\Entity\Voitures;

use App\Form\PicturesType;
use App\Form\ApplicationType;
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
            ->add('marque',TextType::class, $this->getConfiguration('Marque du véhicule', "Marque du véhicule"))
            ->add('modele',TextType::class, $this->getConfiguration('Modèle du véhicule', "Modèle du véhicule"))
            ->add('image', FileType::class,[
                'label'=>"Image de couverture (jpg, jpeg, png)",
            ])
            ->add('km',IntegerType::class,$this->getConfiguration('Nombre de kilomètres', "Donnez le nombre de kilomètres au compteur"))
            ->add('prix', MoneyType::class,$this->getConfiguration('Prix', "Donnez le prix du véhicule"))
            ->add('nbProprio',IntegerType::class,$this->getConfiguration('Nombre de proprio', "Donnez le nombre de prorio qui ont eu le véhicule"))
            ->add('cylindree',IntegerType::class,$this->getConfiguration('Nombre de cylindres', "Donnez le nombre de cylindres (de 1 à 4)"))
            ->add('puissance',IntegerType::class,$this->getConfiguration('Nombre de chevaux', "Donnez le nombre de cheveaux du véhicule (max:200)"))
            ->add('carburant',TextType::class, $this->getConfiguration('Carburant', "Carburant accepté par le véhicule"))
            ->add('annee',IntegerType::class,$this->getConfiguration('Année de mise en circulation', "Donnez l'année de mise en circulation du véhicule"))
            ->add('transmission',TextType::class, $this->getConfiguration('Transmission', "Donnez le type de transmission du véhicule: automatique, manuelle"))
            ->add('description',TextType::class, $this->getConfiguration('Description', "Donnez une description du véhicule"))
            ->add('options',TextType::class, $this->getConfiguration('options', "Listez les options du véhicule"),)
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
