<?php

namespace AppBundle\Form;

use AppBundle\Document\SouthEst;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SouthEstType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('annual', null, [
                'label' => 'supervisor.south_est.annual'
            ])
            ->add('monthly', CollectionType::class, [
                'label' => 'supervisor.south_est.monthly',
                'entry_type' => NumberType::class,
                'required' => false,
                'label_format' => 'month-%name%'
            ])
            ->add('weekly', CollectionType::class, [
                'label' => 'supervisor.south_est.weekly',
                'entry_type' => NumberType::class,
                'required' => false,
                'label_format' => 'week'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => SouthEst::class,
        ));
    }
}
