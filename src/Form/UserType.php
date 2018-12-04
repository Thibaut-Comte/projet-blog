<?php

namespace App\Form;


use App\Entity\Image;
use App\Entity\User;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("username", TextType::class, array(
                'label' => "Email",
                'attr' => array(
                    'placeholder' => 'Email'
                )
            ))
            ->add('rawPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Mot de passe (bis)'],
                'required' => $options["required_password"]
            ])

            ->add('firstName', TextType::class, array(
                'label' => "Prénom",
                'attr' => array(
                    'placeholder' => "Prénom"
                )
            ))
            ->add('lastName', TextType::class, array(
                'label' => "Nom",
                'attr' => array(
                    'placeholder' => "Nom"
                )
            ))
            ->add('image', FileType::class, array(
                'label' => "avatar",
                'required' => false,
                'data_class' => null
            ));


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'required_password' => true
        ]);
    }
}
