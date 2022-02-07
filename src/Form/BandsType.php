<?php

namespace App\Form;

use App\Entity\Artists;
use App\Entity\Bands;
use App\Entity\Concerts;
use App\Entity\Organizations;
use App\Entity\Pictures;
use App\Entity\Rooms;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BandsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du groupe  '
            ])
            ->add('artists', EntityType::class,
                ['class' => Artists::class,
                    'choice_label' => 'name',
                    'required' => true,
                    'multiple' => true,
                ])
            ->add('picture', EntityType::class, [
                'class' => Pictures::class,
                'label' => 'Image  ',
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bands::class,
        ]);
    }
}