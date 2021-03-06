<?php

use AppBundle\Document\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class RestaurantFixtures extends Fixture implements FixtureInterface
{
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

            $this->setReference($restaurantDatas['identifier'], $restaurant);
        }
        $manager->flush();
    }
}