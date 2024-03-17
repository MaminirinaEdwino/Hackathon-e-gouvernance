<?php

namespace App\Form;

use App\Entity\Porte;
use App\Entity\Profession;
use App\Entity\Utilisateurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Utilisateurs1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('CIN')
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('date_naissance', null, [
                'widget' => 'single_text',
            ])
            ->add('age')
            ->add('sexe')
            ->add('status_matrimoniale')
            ->add('lieu_naissance')
            ->add('porte', EntityType::class, [
                'class' => Porte::class,
                'choice_label' => 'numero_porte',
            ])
            ->add('profession_employes', EntityType::class, [
                'class' => Profession::class,
                'choice_label' => 'titre_profession',
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
