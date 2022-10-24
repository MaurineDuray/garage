<?php

namespace App\Form;

use App\Form\ImageType;
use App\Entity\Voitures;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class VoituresType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque',TextType::class, $this->getConfiguration('marque', "Marque du véhicule"))
            ->add('modele',TextType::class, $this->getConfiguration('modèle', "Modèle du véhicule"))
            ->add('image')

            ->add('km',IntegerType::class,$this->getConfiguration('Nombre de kilomètres', "Donnez le nombre de kilomètres au compteur"))
            ->add('prix', IntegerType::class,$this->getConfiguration('Prix', "Donnez le prix du véhicule"))
            ->add('nbProprio',IntegerType::class,$this->getConfiguration('Nombre de proprio', "Donnez le nombre de prorio qui ont eu le véhicule"))
            ->add('cylindree',IntegerType::class,$this->getConfiguration('Nombre de cylindres', "Donnez le nombre de cylindres (de 1 à 4)"))
            ->add('puissance',IntegerType::class,$this->getConfiguration('Nombre de chevaux', "Donnez le nombre de chaveaux du véhicule (max:200)"))
            ->add('carburant',TextType::class, $this->getConfiguration('marque', "Marque du véhicule"))
            ->add('annee',IntegerType::class,$this->getConfiguration('Année de mise en circulation', "Donnez l'année"))
            ->add('transmission',TextType::class, $this->getConfiguration('transmission', "Donnez le type de transmission du véhicule: avant, arrière ou globale"))
            ->add('description',TextType::class, $this->getConfiguration('description', "Donnez une description du véhicule"))
            ->add('options',TextType::class, $this->getConfiguration('options', "Listez les potions du véhicule"))
            ->add('slug')
            ->add(
                'images',
                CollectionType::class,
                [
                    'entry_type' => ImageType::class,
                    'allow_add' => true, // permet d'ajouter des éléments et surtout avoir data_prototype
                    'allow_delete' => true
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voitures::class,
        ]);
    }
}
