<?php

namespace AppBundle\DataFixtures\MongoDB;

use AppBundle\Document\Budget;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class BudgetFixtures extends Fixture implements FixtureInterface, ContainerAwareInterface, DependentFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
    }

    public function load(ObjectManager $manager)
    {
        $budgetListToCreate = [
            'CV' => [
                '2017' =>[
                    'jan' => 208320,
                    'feb' => 185700,
                    'mar' => 206550,
                    'apr' => 202660,
                    'may' => 213110,
                    'jun' => 193150,
                    'jul' => 210750,
                    'aug' => 234350,
                    'sep' => 206150,
                    'oct' => 204850,
                    'nov' => 200000,
                    'dec' => 209000
                ]
            ],
            'MH' => [
                '2017' =>[
                    'jan' => 400000,
                    'feb' => 378000,
                    'mar' => 406000,
                    'apr' => 443000,
                    'may' => 431000,
                    'jun' => 413000,
                    'jul' => 483000,
                    'aug' => 525000,
                    'sep' => 400000,
                    'oct' => 450000,
                    'nov' => 420000,
                    'dec' => 440000
                ]
            ],
            'DR' => [
                '2016' =>[
                    'jan' => 330100,
                    'feb' => 316300,
                    'mar' => 339400,
                    'apr' => 347700,
                    'may' => 360700,
                    'jun' => 332600,
                    'jul' => 383100,
                    'aug' => 413600,
                    'sep' => 341300,
                    'oct' => 367900,
                    'nov' => 334800,
                    'dec' => 355700
                ],
                '2017' =>[
                    'jan' => 332100,
                    'feb' => 318300,
                    'mar' => 341400,
                    'apr' => 349700,
                    'may' => 362700,
                    'jun' => 337600,
                    'jul' => 385100,
                    'aug' => 415600,
                    'sep' => 343300,
                    'oct' => 369900,
                    'nov' => 336800,
                    'dec' => 357700
                ]
            ]
        ];

        foreach($budgetListToCreate as $restaurantIdentifier=>$yearsDatas) {
            if ($this->hasReference($restaurantIdentifier)) {
                $restaurant = $this->getReference($restaurantIdentifier);
                foreach($yearsDatas as $year=>$monthsDatas) {
                    $budget = new Budget($restaurant, $monthsDatas);
                    $budget->setYear($year);
                    $manager->persist($budget);
                }
            }
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