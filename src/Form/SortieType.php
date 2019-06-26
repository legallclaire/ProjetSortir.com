<?php

namespace App\Form;

use App\Entity\Sorties;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
            ->add('datedebut', DateType::class, [
                'label' => 'Date et heure de la sortie'
            ])
            ->add('dateclosure', DateType::class, [
                'label' => 'Date limite d\'inscription'
            ])
            ->add('nbinscriptionsmax', TextType::class, [
                'label' => 'Nombre de places'
            ])
            ->add('descriptioninfos', TextareaType::class, [
                'label' => 'Description et infos'
            ])
            ->add('datefin', DateType::class, [
                'label' => 'Date de fin de la sortie'
            ])
            ->add('lieu', EntityType::class, [
                'class' => 'App\Entity\Lieux',
                'choice_label' => 'Lieu',
                'placeholder' => '-- Choisissez un lieu',
                'required' => true,
                'expanded' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('l')
                        ->where("l.nom_lieu like '%o%'");
                }
            ])
//            ->add('etat')
//            ->add('site')
//            ->add('participantsInscrit')
//            ->add('organisateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
        ]);
    }
}
