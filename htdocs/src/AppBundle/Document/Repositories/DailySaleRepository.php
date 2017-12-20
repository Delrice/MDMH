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
    public function computeMonthlySalesForYear($year, Restaurant $restaurant)
    {
        $builder = $this->createAggregationBuilder(DailySale::class);
        $builder
            ->match()
                ->field('restaurant')->references($restaurant)
                ->field('year')->equals((string)$year)
            ->group()
                ->field('id')->expression(['month' => '$month'])
                ->field('count')->sum(1)
                ->field('foodSaleTotal')->sum('$foodSaleAmount')
        ;

        return $builder->execute();
    }
}