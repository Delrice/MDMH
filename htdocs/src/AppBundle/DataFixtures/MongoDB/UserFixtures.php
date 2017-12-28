<?php

namespace AppBundle\DataFixtures\MongoDB;

use AppBundle\Document\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;


class UserFixtures extends Fixture implements FixtureInterface, ContainerAwareInterface, DependentFixtureInterface
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
                'role' => 'ROLE_ADMIN',
                'restaurants' => ['CV', 'MH', 'DR']
            ],[
                'username' => 'michel',
                'password' => 'michel',
                'email' => 'michel@hmd.fr',
                'role' => 'ROLE_FRANCHISE',
                'restaurants' => ['CV', 'MH', 'DR']
            ],[
                'username' => 'delphine',
                'password' => 'delphine',
                'email' => 'delphine@hmd.fr',
                'role' => 'ROLE_SUPERVISOR',
                'restaurants' => ['CV', 'MH', 'DR']
            ],[
                'username' => 'aurore',
                'password' => 'aurore',
                'email' => 'aurore@hmd.fr',
                'role' => 'ROLE_USERS',
                'restaurants' => ['DR']
            ],[
                'username' => 'aline',
                'password' => 'aline',
                'email' => 'aline@hmd.fr',
                'role' => 'ROLE_USERS',
                'restaurants' => ['CV']
            ],[
                'username' => 'sebastien',
                'password' => 'sebastien',
                'email' => 'sebastien@hmd.fr',
                'role' => 'ROLE_USERS',
                'restaurants' => ['MH']
            ]
        ];

        foreach($userListToCreate as $userDatas) {
            $user = new User();
            $user->setUsername($userDatas['username']);

            $password = $this->encoder->encodePassword($user, $userDatas['password']);
            $user->setPassword($password);
            $user->setEmail($userDatas['email']);
            $user->setAccessRole($userDatas['role']);

            foreach($userDatas['restaurants'] as $restaurantIdentifier) {
                if ($this->hasReference($restaurantIdentifier)) {
                    $user->addRestaurant($this->getReference($restaurantIdentifier));
                }
            }

            $manager->persist($user);
        }
        $manager->flush();
    }

    function getDependencies()
    {
        return [
            RestaurantFixtures::class
        ];
    }


}