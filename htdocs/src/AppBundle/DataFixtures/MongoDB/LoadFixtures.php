<?php

namespace AppBundle\DataFixtures\MongoDB;

use AppBundle\Document\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;


class LoadFixtures implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var UserPasswordEncoder
     */
    private $encoder;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->encoder = $container->get('security.password_encoder');
    }

    public function load(ObjectManager $manager)
    {
        $userListToCreate = [
            [
                'username' => 'fabrice',
                'password' => 'fabrice',
                'email' => 'fabrice@hmd.fr',
                'role' => 'ROLE_ADMIN'
            ],[
                'username' => 'michel',
                'password' => 'michel',
                'email' => 'michel@hmd.fr',
                'role' => 'ROLE_FRANCHISE'
            ],[
                'username' => 'delphine',
                'password' => 'delphine',
                'email' => 'delphine@hmd.fr',
                'role' => 'ROLE_SUPERVISOR'
            ],[
                'username' => 'aurore',
                'password' => 'aurore',
                'email' => 'aurore@hmd.fr',
                'role' => 'ROLE_RESTAURANT_DR'
            ],[
                'username' => 'aline',
                'password' => 'aline',
                'email' => 'aline@hmd.fr',
                'role' => 'ROLE_RESTAURANT_CV'
            ],[
                'username' => 'sebastien',
                'password' => 'sebastien',
                'email' => 'sebastien@hmd.fr',
                'role' => 'ROLE_RESTAURANT_MH'
            ],

        ];

        foreach($userListToCreate as $userDatas) {
            $user = new User();
            $user->setUsername($userDatas['username']);

            $password = $this->encoder->encodePassword($user, $userDatas['password']);
            $user->setPassword($password);
            $user->setEmail($userDatas['email']);
            $user->setAccessRole($userDatas['role']);

            $manager->persist($user);
        }
        $manager->flush();
    }
}