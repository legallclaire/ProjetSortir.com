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
//            ->add('lieu', EntityType::class, [
//                'label' => 'Lieu',
//                'class' => 'App\Entity\Lieux',
//                'attr' => [
//                        'class' => 'custom-select',
//                        'id' => 'lieux'
//                    ],
//                'choice_label' => 'nom_lieu',
//                'placeholder' => '-- Choisissez un lieu',
//                'required' => true,
//                'expanded' => false,
//            ]);
//            ->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'))
//            ->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
    }

//    public function addElements(FormInterface $form, Villes $ville = null) {
//
//        $form->add('villes', EntityType::class, [
//            'required' => true,
//            'data' => $ville,
//            'placeholder' => 'Choisissez une ville',
//            'class' => 'App\Entity\Villes'
//        ]);
//
//        $lieux = [];
//
//        if ($ville) {
//            $lieuRepo = $this->em->getRepository('App:Lieux');
//
//            $lieux = $lieuRepo->createQueryBuilder("q")
//                ->where("q.ville = :villeid")
//                ->setParameter("villeid", $ville->getId())
//                ->getQuery()
//                ->getResult();
//        }
//
//        $form->add('lieu', EntityType::class, [
//            'required' => true,
//            'placeholder' => 'Choissiez d\'abord une ville',
//           'class' => 'App\Entity\Lieux',
//            'choices' => $lieux
//        ]);
//    }

//    public function onPreSubmit(FormEvent $event) {
//        $form = $event->getForm();
//        $data = $event->getData();
//
//        // Search for selected City and convert it into an Entity
//        $ville = $this->em->getRepository('App:Villes')->find($data['ville']);
//
//        $this->addElements($form, $ville);
//    }

//    function onPreSetData(FormEvent $event) {
//        $person = $event->getData();
//        $form = $event->getForm();
//
//        // When you create a new person, the City is always empty
//        $ville = $person->getVille() ? $person->getVille() : null;
//
//        $this->addElements($form, $ville);
//    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
        ]);
    }
}
