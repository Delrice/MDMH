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
        // create 20 users! Bam!
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setUsername('Username'.chr(64+$i));

            $password = $this->encoder->encodePassword($user, 'pass_1234');
            $user->setPassword($password);

            $manager->persist($user);
        }

        $manager->flush();
    }
}