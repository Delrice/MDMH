<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 19/12/2017
 * Time: 17:05
 */

namespace AppBundle\Manager;


use AppBundle\Document\DailySale;
use AppBundle\Document\Restaurant;
use AppBundle\Model\MonthlySales;
use AppBundle\Services\Utils;
use Doctrine\ODM\MongoDB\DocumentManager;

class SalesManager
{
    /**
     * @var DocumentManager
     */
    private $dm;
    /**
     * @var Utils
     */
    private $utils;

    /**
     * SalesManager constructor.
     * @param DocumentManager $dm
     * @param Utils $utils
     */
    public function __construct(DocumentManager $dm, Utils $utils)
    {
        $this->dm = $dm;
        $this->utils = $utils;
    }

    /**
     * @param $year
     * @param Restaurant $restaurant
     * @return array
     */
    public function computeMonthlySalesForYear($year, Restaurant $restaurant)
    {
        $computedMonthlySales = array_combine(array_keys($this->utils->getMonths()), [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]);
        $monthlySales = $this->dm->getRepository(DailySale::class)->computeMonthlySalesForYear($year, $restaurant);
        if ($monthlySales->count()) {
            foreach ($monthlySales as $monthlyResult) {
                $computedMonthlySales[$monthlyResult['_id']['month']] = $monthlyResult['foodSaleTotal'];
            }
        }
        return $computedMonthlySales;
    }

    /**
     * @param Restaurant $restaurant
     * @param null $year
     * @param null $month
     * @return MonthlySales
     */
    public function prepareMonth(Restaurant $restaurant, $year=null, $month=null)
    {
        if (null === $year)
            $year = strftime('%Y', time());

        if (null === $month)
            $month = strftime('%m', time());

        $monthlySales = new MonthlySales($restaurant, $year, $month);

        $searchOptions = [
            'restaurant' => $restaurant,
            'year' => $year,
            'month' => $month
        ];

        $maxDayInMonth = strftime('%d', mktime(0, 0, 0, $month + 1, 0, $year));

        $dailySales = $this->dm->getRepository(DailySale::class)->getDailySalesOrderedByDay($searchOptions);
        $monthlySalesEntries = [];
        foreach ($dailySales as $dailySale) {
            //$monthlySales->addDailySale($dailySale);
            $monthlySalesEntries[$dailySale->getDay()] = $dailySale;
        }

        // If needed, add missing DailySale
        for ($i = 1; $i <= $maxDayInMonth; $i++) {
            if (empty($monthlySalesEntries[$i])) {
                $emptyDailySale = new DailySale($restaurant);
                $emptyDailySale->setYear($year);
                $emptyDailySale->setMonth($month);
                $emptyDailySale->setDay($i);
                $monthlySalesEntries[$i] = $emptyDailySale;
                $emptyDailySale = null;
            }
        }
        $monthlySales->setDailySales($monthlySalesEntries);

        return $monthlySales;
    }
}