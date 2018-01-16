<?php

namespace AppBundle\Form;

use AppBundle\Document\MarketRank;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarketRankGlobalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('annual', null, [
                'label' => 'supervisor.market_rank.annual'
            ])
            ->add('monthly', CollectionType::class, [
                'label' => 'supervisor.market_rank.monthly',
                'entry_type' => NumberType::class,
                'required' => false,
                'label_format' => 'month-%name%'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => MarketRank::class,
        ));
    }
}
