<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AccountType extends ApplicationType
{
    /**
     * Création du formulaire de création d'un compte 
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstName', TextType::class, $this->getConfiguration("Prénom","Votre prénom..."))
        ->add('lastName', TextType::class, $this->getConfiguration("Nom", "Votre nom de famille..."))
        ->add('email', EmailType::class, $this->getConfiguration("Email", "Votre adresse e-mail..."))
        ->add('introduction', TextType::class, $this->getConfiguration("Introduction", "Présentation rapide"));
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
