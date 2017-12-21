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
    public function computeMonthlySalesForYear($year, Restaurant $restaurant)
    {
        $builder = $this->createAggregationBuilder(DailySale::class);
        $builder
            ->match()
                ->field('restaurant')->references($restaurant)
                ->field('year')->equals((int)$year)
            ->group()
                ->field('id')->expression(['month' => '$month'])
                ->field('count')->sum(1)
                ->field('foodSaleTotal')->sum('$foodSaleAmount')
        ;

        return $builder->execute();
    }

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
}