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
                ],
                '2018' =>[
                    'jan' => 200860,
                    'feb' => 193540,
                    'mar' => 205200,
                    'apr' => 203850,
                    'may' => 210800,
                    'jun' => 197800,
                    'jul' => 226000,
                    'aug' => 246050,
                    'sep' => 220800,
                    'oct' => 226500,
                    'nov' => 209100,
                    'dec' => 209500
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
                ],
                '2018' =>[
                    'jan' => 425000,
                    'feb' => 395000,
                    'mar' => 437000,
                    'apr' => 455000,
                    'may' => 450000,
                    'jun' => 420000,
                    'jul' => 505000,
                    'aug' => 575000,
                    'sep' => 445000,
                    'oct' => 485000,
                    'nov' => 438000,
                    'dec' => 450000
                ]
            ],
            'DR' => [
                '2016' =>[
                    'jan' => 334000,
                    'feb' => 315950,
                    'mar' => 344150,
                    'apr' => 351850,
                    'may' => 351550,
                    'jun' => 334050,
                    'jul' => 396750,
                    'aug' => 422450,
                    'sep' => 342450,
                    'oct' => 389450,
                    'nov' => 345550,
                    'dec' => 351800
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
                ],
                '2018' =>[
                    'jan' => 346100,
                    'feb' => 321600,
                    'mar' => 358500,
                    'apr' => 376800,
                    'may' => 372600,
                    'jun' => 364700,
                    'jul' => 406100,
                    'aug' => 449500,
                    'sep' => 366200,
                    'oct' => 392100,
                    'nov' => 342600,
                    'dec' => 374800
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