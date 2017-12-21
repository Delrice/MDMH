<?php

namespace AppBundle\Form;

use AppBundle\Model\MonthlySales;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonthlySalesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dailySales', CollectionType::class, [
                'entry_type' => DailySaleType::class,
                'entry_options' => ['label' => false],
                'label' => 'monthlySales.dailySales'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => MonthlySales::class,
        ));
    }
}
