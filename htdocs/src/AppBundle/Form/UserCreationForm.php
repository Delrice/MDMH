<?php

namespace AppBundle\Form;

use AppBundle\Document\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserCreationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'user.username.label'
            ])
            ->add('email', EmailType::class, [
                'label' => 'user.email.label'
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'user.password.repeated.error',
                'first_options' => [
                    'label' => 'user.password.label'
                ],
                'second_options' => [
                    'label' => 'user.password.repeated.label'
                ]
            ])
            ->add('restaurants', null, [
                'label' => 'user.restaurants.label'
            ])
            ->add('accessRole', ChoiceType::class, [
                'choices' => User::$ROLES,
                'multiple' => false,
                'expanded' => true,
                'label' => 'user.access_role.label'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'validation_groups' => array('registration')
        ]);
    }
}
