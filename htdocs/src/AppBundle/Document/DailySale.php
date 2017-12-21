<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 19/12/2017
 * Time: 17:30
 */

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class User
 * @package AppBundle\Document
 * @ODM\Document(repositoryClass="AppBundle\Document\Repositories\DailySaleRepository")
 * @ODM\HasLifecycleCallbacks()
 */
class DailySale
{
    use ExtendedProperties\CreatedAtTrait;
    use ExtendedProperties\UpdatedAtTrait;

    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @ODM\ReferenceOne(targetDocument="Restaurant", inversedBy="budgets")
     */
    private $restaurant;

    /**
     * @ODM\Field(type="integer")
     */
    private $year;

    /**
     * @ODM\Field(type="integer")
     */
    private $month;

    /**
     * @ODM\Field(type="integer")
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
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param integer $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return integer
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param integer $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * @return integer
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param integer $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * @return integer
     */
    public function getBudgetAmount()
    {
        return $this->budgetAmount;
    }

    /**
     * @param integer $budgetAmount
     */
    public function setBudgetAmount($budgetAmount)
    {
        $this->budgetAmount = $budgetAmount;
    }

    /**
     * @return integer
     */
    public function getTotalSaleAmount()
    {
        return $this->totalSaleAmount;
    }

    /**
     * @param integer $totalSaleAmount
     */
    public function setTotalSaleAmount($totalSaleAmount)
    {
        $this->totalSaleAmount = $totalSaleAmount;
    }

    /**
     * @return integer
     */
    public function getFoodSaleAmount()
    {
        return $this->foodSaleAmount;
    }

    /**
     * @param integer $foodSaleAmount
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