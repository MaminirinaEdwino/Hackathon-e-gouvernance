<?php

namespace App\Form;

use App\Entity\Porte;
use App\Entity\Profession;
use App\Entity\Utilisateurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('CIN')
            ->add('password', PasswordType::class)
            ->add('nom')
            ->add('prenom')
            ->add('date_naissance', null, [
                'widget' => 'single_text',
            ])
            ->add('age')
            ->add('adresse')
            ->add('sexe')
            ->add('status_matrimoniale')
            ->add('profession')
            ->add('lieu_naissance')
            ->add('pere', EntityType::class, [
                'class' => Utilisateurs::class,
                'choice_label' => 'nom',
            ])
            ->add('mere', EntityType::class, [
                'class' => Utilisateurs::class,
                'choice_label' => 'nom',
            ])
            ->add('partenaire', EntityType::class, [
                'class' => Utilisateurs::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
}
