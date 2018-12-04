<?php

namespace App\Form;


use App\Entity\Categorie;
use App\Entity\Image;
use App\Entity\Product;
use App\Entity\User;

use Doctrine\DBAL\Types\FloatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("title", TextType::class, array(
                'label' => "Nom",
                'attr' => array(
                    'placeholder' => 'Nom'
                )
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Description',
                'attr' => array(
                    'placeholder' => 'Description du produit'
                )
            ))
            ->add('price', NumberType::class, array(
                'label' => 'Prix'
            ))
            ->add('image', FileType::class, array(
                'label' => 'Image',
                'required' => false,
                'data_class' => null
            ))
            ->add('categories', EntityType::class, array(
                'label' => "Categories",
                'class' => Categorie::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ));


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class
        ]);
    }

}
