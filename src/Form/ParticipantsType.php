<?php

namespace App\Form;

use App\Entity\Participants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('no_participant')
            ->add('pseudo', TextType::class,[
                'label'=>'Pseudo',
            ])
            //->add('nom')
            //->add('prenom')
            //->add('telephone')
            //->add('mail')
            ->add('mot_de_passe', RepeatedType::class,[
                'type'=>PasswordType::class,
                'invalid_message'=>'Vous n\'avez pas saisi le même mot de passe',
                'first_options'=>[
                    'label'=>'Mot de passe'
                ],
                'second_options'=> [
                    'label'=>'Confirmation du mot de passe'
                ]
            ])
        ;
            
            //->add('administrateur')
            //->add('actif')
            //->add('sites_no_site')
            //->add('organisateur')
            //->add('sorties')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participants::class,
        ]);
    }
}
