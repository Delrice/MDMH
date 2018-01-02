<?php

use AppBundle\Document\Budget;
use AppBundle\Document\DailySale;
use AppBundle\Document\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class DailySalesFixtures extends Fixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $restaurantListToCreate = [
            [
                'name' => 'Daily Sales Restaurant',
                'identifier' => 'DSR'
            ]
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