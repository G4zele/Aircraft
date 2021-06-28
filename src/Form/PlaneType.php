<?php

namespace App\Form;

use App\Entity\Plane;
use App\Entity\DateInterval;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class PlaneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Type')
            ->add('boardNumber')
            ->add('releaseDate', DateType::class, array(
                'widget' => 'single_text',
                'attr' => array(
                    'max' => date('Y-m-d')
                )
            ))
            ->add('releasePlace')
            ->add('fixDate', DateType::class, array(
                'widget' => 'single_text',
                'attr' => array(
                    'max' => date('Y-m-d')
                )
            ))
            ->add('fixPlace')
            ->add('exploTime')
            ->add('fixExploTime')
            ->add('startingExploTime')
            ->add('FlyTime')
            ->add('sitDowns')
            ->add('countFails')
            ->add('include')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plane::class,
        ]);
    }
}
