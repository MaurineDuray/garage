<?php

namespace App\Form;


use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class PasswordUpdateType extends ApplicationType
{
    /**
     * Création du formulaire pour le changement de mot de passe 
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('oldPassword', PasswordType::class, $this->getConfiguration("Ancien mot de passe", "Votre ancien mot de passe"))
        ->add('newPassword', PasswordType::class, $this->getConfiguration("Nouveau mot de passe", "Votre nouveau mot de passe"))
        ->add('confirmPassword', PasswordType::class, $this->getConfiguration("Confirmation de mot de passe", "Confirmez votre mot de passe"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
