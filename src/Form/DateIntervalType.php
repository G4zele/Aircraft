<?php

namespace App\Form;

use App\Entity\DateInterval;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DateIntervalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('startdate', DateType::class, array(
            'widget' => 'single_text',
            'attr' => array(
                'max' => date('Y-m-d')
            )
        ))
        ->add('enddate', DateType::class, array(
            'widget' => 'single_text',
            'attr' => array(
                'max' => date('Y-m-d')
            )
        ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DateInterval::class,
        ]);
    }
}
