<?php

namespace App\Form;

use App\Entity\Sorties;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la sortie'
            ])
            ->add('datedebut', DateTimeType::class, [
                'label' => 'Date et heure de la sortie',
                'years' => range(2019, 2029),
            ])
            ->add('dateclosure', DateType::class, [
                'label' => 'Date limite d\'inscription',
                'years' => range(2019, 2029),
            ])
            ->add('nbinscriptionsmax', TextType::class, [
                'label' => 'Nombre de places'
            ])
            ->add('datefin', DateTimeType::class, [
                'label' => 'Date de fin de la sortie',
                'years' => range(2019, 2029),
            ])

            ->add('lieu', EntityType::class, [
                'class' => 'App\Entity\Lieux',
                'choice_label' => 'nom_lieu',
                'placeholder' => '-- Choisissez un lieu',
                'required' => true,
                'expanded' => false,

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
        ]);
    }
}
