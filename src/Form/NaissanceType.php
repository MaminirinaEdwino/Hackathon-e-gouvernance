<?php

namespace App\Form;

use App\Entity\Naissance;
use App\Entity\Utilisateurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NaissanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('sexe')
            ->add('date_naissance', null, [
                'widget' => 'single_text',
            ])
            ->add('lieu_naissance')
            ->add('pere', EntityType::class, [
                'class' => Utilisateurs::class,
                'choice_label' => function (Utilisateurs $utilisateurs){
                    return $utilisateurs->getNom(). " " . $utilisateurs->getPrenom();
                },
            ])
            ->add('mere', EntityType::class, [
                'class' => Utilisateurs::class,
                'choice_label' => function (Utilisateurs $utilisateurs){
                    return $utilisateurs->getNom(). " " . $utilisateurs->getPrenom();
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Naissance::class,
        ]);
    }
}
