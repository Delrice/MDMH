<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 19/12/2017
 * Time: 17:30
 */

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class User
 * @package AppBundle\Document
 * @ODM\Document(repositoryClass="AppBundle\Document\Repositories\DailySaleRepository")
 * @UniqueEntity(fields={"restaurant.$id", "year", "month", "day"})
 */
class DailySale
{
    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @ODM\ReferenceOne(targetDocument="Restaurant", inversedBy="budgets")
     */
    private $restaurant;

    /**
     * @ODM\Field(type="string")
     */
    private $year;

    /**
     * @ODM\Field(type="string")
     */
    private $month;

    /**
     * @ODM\Field(type="string")
     */
    private $day;

    /**
     * @ODM\Field(type="integer")
     */
    private $budgetAmount;

    /**
     * @ODM\Field(type="integer")
     */
    private $totalSaleAmount;

    /**
     * @ODM\Field(type="integer")
     */
    private $foodSaleAmount;

    /**
     * @ODM\Field(type="collection")
     */
    private $timeDivision;

    public function __construct(Restaurant $restaurant=null)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Restaurant
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }

    /**
     * @param mixed $restaurant
     */
    public function setRestaurant(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param mixed $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * @return mixed
     */
    public function getBudgetAmount()
    {
        return $this->budgetAmount;
    }

    /**
     * @param mixed $budgetAmount
     */
    public function setBudgetAmount($budgetAmount)
    {
        $this->budgetAmount = $budgetAmount;
    }

    /**
     * @return mixed
     */
    public function getTotalSaleAmount()
    {
        return $this->totalSaleAmount;
    }

    /**
     * @param mixed $totalSaleAmount
     */
    public function setTotalSaleAmount($totalSaleAmount)
    {
        $this->totalSaleAmount = $totalSaleAmount;
    }

    /**
     * @return mixed
     */
    public function getFoodSaleAmount()
    {
        return $this->foodSaleAmount;
    }

    /**
     * @param mixed $foodSaleAmount
     */
    public function setFoodSaleAmount($foodSaleAmount)
    {
        $this->foodSaleAmount = $foodSaleAmount;
    }

    /**
     * @return mixed
     */
    public function getTimeDivision()
    {
        return $this->timeDivision;
    }

    /**
     * @param mixed $timeDivision
     */
    public function setTimeDivision($timeDivision)
    {
        $this->timeDivision = $timeDivision;
    }

}