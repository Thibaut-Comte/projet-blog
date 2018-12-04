<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("lastName", TextType::class, array(
                'label' => "Nom",
                'attr' => array(
                    'placeholder' => 'Nom'
                )
            ))
            ->add("firstName", TextType::class, array(
                'label' => "Nom",
                'attr' => array(
                    'placeholder' => 'Prenom'
                )
            ))
            ->add("email", EmailType::class, array(
                'attr' => array(
                    'placeholder' => 'Email'
                )
            ))
            ->add("subject", TextType::class, array(
                'label' => 'Sujet',
                'attr' => array(
                    'placeholder' => 'Sujet'
                )
            ))
            ->add("message", TextareaType::class, array(
                'attr' => array(
                    'placeholder' => 'Message'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
