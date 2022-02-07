<?php

namespace App\Form;

use App\Entity\Bands;
use App\Entity\Concerts;
use App\Entity\Pictures;
use App\Entity\Rooms;
use App\Entity\Organizations;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;

class ConcertsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'choice',
                'format' => 'dd / MM / yyyy'
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom du concert  '
            ])
            ->add('room', EntityType::class,
                ['class' => Rooms::class,
                    'label' => 'Salle  ',
                    'choice_label' => 'name'
                ])
            ->add('price', TextType::class,
                ['label' => 'Prix du concert  ',
                ])
            ->add('bands', EntityType::class,
                ['class' => Bands::class,
                    'label' => 'Groupe  ',
                    'choice_label' => 'name',
                ])
            ->add('picture', EntityType::class, [
                'class' => Pictures::class,
                'label' => 'Image  ',
                    'choice_label' => 'name',
            ])
            ->add('organization', EntityType::class, [
                'class' => Organizations::class,
                    'label' => 'Organisation  ',
                    'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Concerts::class,
        ]);
    }
}