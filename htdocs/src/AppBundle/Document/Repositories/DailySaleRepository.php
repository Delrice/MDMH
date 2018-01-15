<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 19/12/2017
 * Time: 10:26
 */

namespace AppBundle\Document\Repositories;

use AppBundle\Document\DailySale;
use AppBundle\Document\Restaurant;
use Doctrine\ODM\MongoDB\DocumentRepository;

class DailySaleRepository extends DocumentRepository
{
    /**
     * @param $year
     * @param Restaurant $restaurant
     * @return \Doctrine\MongoDB\Iterator|\Doctrine\ODM\MongoDB\CommandCursor
     */
    public function computeMonthlySalesForYear($year, Restaurant $restaurant=null)
    {
        $builder = $this->createAggregationBuilder(DailySale::class);
        if ($restaurant) {
            $builder
                ->match()
                ->field('restaurant')->references($restaurant)
                ->field('year')->equals((int)$year);
        } else {
            $builder
                ->match()
                ->field('year')->equals((int)$year);
        }

        $builder->group()
                ->field('id')->expression(['month' => '$month'])
                ->field('foodSaleTotal')->sum('$foodSaleAmount')
            ->sort([
                '_id' => 'ASC'
            ])
        ;

        return $builder->execute();
    }

    /**
     * @param $searchOptions
     * @return mixed
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function getDailySalesOrderedByDay($searchOptions)
    {
        $qb = $this->createQueryBuilder();

        if (!empty($searchOptions['restaurant']))
            $qb->field('restaurant')->references($searchOptions['restaurant']);

        if (!empty($searchOptions['year']))
            $qb->field('year')->equals((int)$searchOptions['year']);

        if (!empty($searchOptions['month']))
            $qb->field('month')->equals((int)$searchOptions['month']);

        $qb->sort([
            'year' => 'ASC',
            'month' => 'ASC',
            'day' => 'ASC'
        ]);

        return $qb->getQuery()->execute()->toArray();
    }

    /**
     * @param $year
     * @param Restaurant|null $restaurant
     * @return \Doctrine\MongoDB\Iterator|\Doctrine\ODM\MongoDB\CommandCursor
     */
    public function getDailySalesGroupedByWeek($year, Restaurant $restaurant=null)
    {
        $builder = $this->createAggregationBuilder(DailySale::class);

        if ($restaurant) {
            $builder
                ->match()
                    ->field('restaurant')->references($restaurant)
                    ->field('week')->equals(new \MongoRegex("/$year\/*/"));
        } else {
            $builder
                ->match()
                    ->field('week')->equals(new \MongoRegex("/$year\/*/"));
        }
        $builder->group()
                ->field('id')->expression(['week' => '$week', 'weekNumber' => '$weekNumber'])
                ->field('foodSaleTotal')->sum('$foodSaleAmount')
            ->sort([
                '_id' => 'DESC'
            ])
        ;

        return $builder->execute();
    }

    /**
     * @param Restaurant|null $restaurant
     * @return \Doctrine\MongoDB\Iterator|\Doctrine\ODM\MongoDB\CommandCursor
     */
    public function getDailySalesGroupedByMonth(Restaurant $restaurant=null)
    {
        $builder = $this->createAggregationBuilder(DailySale::class);

        if ($restaurant) {
            $builder
                ->match()
                    ->field('restaurant')->references($restaurant);
        }

        $builder->group()
                ->field('id')->expression(['year' => '$year', 'month' => '$month'])
                ->field('foodSaleTotal')->sum('$foodSaleAmount')
            ->sort([
                '_id' => 'ASC'
            ])
        ;

        return $builder->execute();
    }

    /**
     * @param $currentYear
     * @param $currentMonth
     * @param $currentDay
     * @param Restaurant $restaurant
     * @return object
     */
    public function findLastYearEntryForSameDayName($currentYear, $currentMonth, $currentDay, Restaurant $restaurant=null)
    {
        // Here, get the precedent CA for the same day 1 year ago
        $dateTime = \DateTime::createFromFormat('d/m/Y', $currentDay.'/'.$currentMonth.'/'.$currentYear);
        $dayname = $dateTime->format('D');

        $lastYearDateTime = clone $dateTime;
        $lastYearDateTime->sub(date_interval_create_from_date_string('1 year'));
        $lastYearDateTime->modify('next '.$dayname);
        $lastYearDayname = $lastYearDateTime->format('D');

        $lastYear = $lastYearDateTime->format('Y');
        $lastMonth = $lastYearDateTime->format('m');
        $lastDay = $lastYearDateTime->format('d');

        if ($restaurant) {
            $lastYearDailySale = $this->findOneBy([
                'year' => (int)$lastYear,
                'month' => (int)$lastMonth,
                'day' => (int)$lastDay,
                'restaurant' => $restaurant
            ]);
        } else {
            $lastYearDailySales = $this->findBy([
                'year' => (int)$lastYear,
                'month' => (int)$lastMonth,
                'day' => (int)$lastDay
            ]);

            $totalAmount = 0;
            foreach ($lastYearDailySales as $lastYearDailySale) {
                $totalAmount += $lastYearDailySale->getFoodSaleAmount();
            }
            $lastYearDailySale->setFoodSaleAmount($totalAmount);
        }

        return $lastYearDailySale;
    }
}