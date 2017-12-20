<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 19/12/2017
 * Time: 17:05
 */

namespace AppBundle\Manager;


use AppBundle\Document\Restaurant;
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

    public function __construct(DocumentManager $dm, Utils $utils)
    {
        $this->dm = $dm;
        $this->utils = $utils;
    }

    public function computeMonthlySalesForYear($year, Restaurant $restaurant)
    {
        $computedMonthlySales = array_combine($this->utils->getMonths(), [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]);
        $monthlySales = $this->dm->getRepository('AppBundle:DailySale')->computeMonthlySalesForYear($year, $restaurant);
        if ($monthlySales->count()) {
            foreach ($monthlySales as $monthlyResult) {
                $computedMonthlySales[$monthlyResult['_id']['month']] = $monthlyResult['foodSaleTotal'];
            }
        }
        return $computedMonthlySales;
    }
}