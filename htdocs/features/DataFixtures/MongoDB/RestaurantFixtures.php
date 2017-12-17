<?php

use AppBundle\Document\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;


class RestaurantFixtures extends Fixture implements FixtureInterface, ContainerAwareInterface
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
        $restaurantListToCreate = [
            [
                'name' => 'Centre ville',
                'identifier' => 'CV'
            ],[
                'name' => 'Mas d\'Hours',
                'identifier' => 'MH'
            ],[
                'name' => 'Alès Nord',
                'identifier' => 'DR'
            ],

        ];

        foreach($restaurantListToCreate as $restaurantDatas) {
            $restaurant = new Restaurant();
            $restaurant->setName($restaurantDatas['name']);
            $restaurant->setIdentifier($restaurantDatas['identifier']);

            $manager->persist($restaurant);

            $this->addReference($restaurantDatas['identifier'], $restaurant);
        }
        $manager->flush();
    }
}