<?php

namespace AppBundle\Form;

use AppBundle\Document\Budget;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BudgetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('restaurant', null, [
                'label' => 'budget.restaurant',
                'disabled' => true
            ])
            ->add('year', null, [
                'label' => 'budget.year',
                'disabled' => true
            ])
            ->add('jan', IntegerType::class, [
                'label' => 'month-jan',
                'required' => false
            ])
            ->add('feb', IntegerType::class, [
                'label' => 'month-feb',
                'required' => false
            ])
            ->add('mar', IntegerType::class, [
                'label' => 'month-mar',
                'required' => false
            ])
            ->add('apr', IntegerType::class, [
                'label' => 'month-apr',
                'required' => false
            ])
            ->add('may', IntegerType::class, [
                'label' => 'month-may',
                'required' => false
            ])
            ->add('jun', IntegerType::class, [
                'label' => 'month-jun',
                'required' => false
            ])
            ->add('jul', IntegerType::class, [
                'label' => 'month-jul',
                'required' => false
            ])
            ->add('aug', IntegerType::class, [
                'label' => 'month-aug',
                'required' => false
            ])
            ->add('sep', IntegerType::class, [
                'label' => 'month-sep',
                'required' => false
            ])
            ->add('oct', IntegerType::class, [
                'label' => 'month-oct',
                'required' => false
            ])
            ->add('nov', IntegerType::class, [
                'label' => 'month-nov',
                'required' => false
            ])
            ->add('dec', IntegerType::class, [
                'label' => 'month-dec',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Budget::class
        ]);
    }
}
