<?php

namespace App\Form;

use App\Entity\Participants;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, ['label'=>'Pseudo','attr'=>['class'=>'pseudo-class']])
            ->add('nom', TextType::class, ['label'=>'Nom','attr'=>['class'=>'nom-class']])
            ->add('prenom', TextType::class, ['label'=>'Prénom','attr'=>['class'=>'prenom-class']])
            ->add('telephone', TextType::class, ['label'=>'Téléphone','attr'=>['class'=>'tel-class'], 'required'=> false])
            ->add('mail', TextType::class, ['label'=>'Email','attr'=>['class'=>'mail-class']])
            ->add('mot_de_passe', RepeatedType::class,['type'=>PasswordType::class, 'invalid_message'=>'Vous n\'avez pas saisi le même mot de passe','first_options'=>
                ['label'=> 'Mot de passe'], 'second_options'=>['label' => 'Confirmation du mot de passe']])
            ->add('sites_no_site', EntityType::class, ['class'=>'App\Entity\Sites','choice_label'=>'nom_site','placeholder'=>'Choisir une ville'])
            ->add('urlPhoto', TextType::class, ['label'=>'Ma Photo','attr'=>['class'=>'photo-class'],'required'=> false])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participants::class,
        ]);
    }
}
