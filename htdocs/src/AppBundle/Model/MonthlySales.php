<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 21/12/2017
 * Time: 14:35
 */

namespace AppBundle\Model;


use AppBundle\Document\DailySale;
use AppBundle\Document\Restaurant;
use Doctrine\Common\Collections\ArrayCollection;

class MonthlySales
{
    /**
     * @var Restaurant[]
     */
    private $restaurant;

    /**
     * @var string
     */
    private $year;

    /**
     * @var string
     */
    private $month;

    /**
     * @var DailySale[]
     */
    private $dailySales;

    /**
     * MonthlySales constructor.
     * @param $restaurant
     * @param $year
     * @param $month
     */
    public function __construct($restaurant, $year, $month)
    {
        $this->restaurant = $restaurant;
        $this->year = $year;
        $this->month = $month;
        $this->dailySales = new ArrayCollection();
    }

    /**
     * @return Restaurant[]
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }

    /**
     * @param Restaurant[] $restaurant
     */
    public function setRestaurant($restaurant)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param string $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return string@
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param string $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * @return DailySale[]
     */
    public function getDailySales()
    {
        return $this->dailySales;
    }

    /**
     * @param DailySale[] $dailySales
     */
    public function setDailySales($dailySales)
    {
        $this->dailySales = $dailySales;
    }

    public function addDailySale(DailySale $dailySale)
    {
        $this->dailySales->add($dailySale);
    }
}