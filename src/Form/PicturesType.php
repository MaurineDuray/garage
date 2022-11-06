<?php

namespace App\Form;

use App\Entity\Pictures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PicturesType extends AbstractType
{
    /**
     * Construit la partie de formulaire pour l'ajout d'une image à la galerie photo du véhicule
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file',UrlType::class, [
                'attr' => [
                    'placeholder'=>"Url de l'image"
                ],
                "required"=>false
            ])
            ->add('caption',TextType::class, [
                'attr' => [
                    'placeholder'=>"Titre de l'image"
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pictures::class,
        ]);
    }
}
