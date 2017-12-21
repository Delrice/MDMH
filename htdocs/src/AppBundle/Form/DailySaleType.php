<?php

namespace AppBundle\Form;

use AppBundle\Document\DailySale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DailySaleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('day', null, [
                'label' => 'dailysale.day',
                'disabled' => true
            ])
            ->add('budgetAmount', null, [
                'label' => 'dailysale.budgetAmount',
                'required' => false
            ])
            ->add('totalSaleAmount', null, [
                'label' => 'dailysale.totalSaleAmount',
                'required' => false
            ])
            ->add('foodSaleAmount', null, [
                'label' => 'dailysale.foodSaleAmount',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DailySale::class
        ]);
    }
}
