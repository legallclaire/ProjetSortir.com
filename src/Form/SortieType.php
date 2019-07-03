<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use App\Entity\Sorties;
class SortieType extends AbstractType
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la sortie'
            ])
            ->add('datedebut', DateTimeType::class, [
                'label' => 'Date et heure de la sortie',
                'years' => range(2019, 2029),
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy HH:mm',
                'data'=> new \DateTime()
            ])
            ->add('dateclosure', DateTimeType::class, [
                'label' => 'Date limite d\'inscription',
                'years' => range(2019, 2029),
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy HH:mm',
                'data' => new \DateTime()
            ])
            ->add('nbinscriptionsmax', TextType::class, [
                'label' => 'Nombre de places'
            ])
            ->add('datefin', DateTimeType::class, [
                'label' => 'Date de fin de la sortie',
                'years' => range(2019, 2029),
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy HH:mm',
                'data' => new \DateTime()
            ])
            ->add('descriptioninfos', TextareaType::class, [
                'label' => 'Description et infos'
            ]);

    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
        ]);
    }
}
