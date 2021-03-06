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
 * @ODM\Indexes({
 *  @ODM\Index(keys={"restaurant.$id"="asc", "year"="asc"}),
 *  @ODM\Index(keys={"restaurant.$id"="asc", "week"="asc"}),
 *  @ODM\Index(keys={"restaurant.$id"="asc", "year"="asc", "month"="asc"}),
 *  @ODM\Index(keys={"restaurant.$id"="asc", "year"="asc", "month"="asc", "day"="asc"}),
 *  @ODM\Index(keys={"year"="asc"}),
 *  @ODM\Index(keys={"week"="asc"}),
 *  @ODM\Index(keys={"year"="asc", "month"="asc"}),
 *  @ODM\Index(keys={"year"="asc", "month"="asc", "day"="asc"}),
 * })
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
     * @ODM\Field(type="date")
     */
    private $date;

    /**
     * @ODM\Field(type="string")
     */
    private $week;

    /**
     * @ODM\Field(type="integer")
     */
    private $weekNumber;

    /**
     * @ODM\Field(type="string")
     */
    private $dayname;

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

    private $dateFormatted;
    private $precedentCA;

    public function __construct(Restaurant $restaurant=null)
    {
        $this->restaurant = $restaurant;
        $this->budgetAmount = 0;
        $this->totalSaleAmount = 0;
        $this->foodSaleAmount = 0;
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

    /**
     * @return mixed
     */
    public function getDayname()
    {
        return $this->dayname;
    }

    /**
     * @return mixed
     */
    public function getPrecedentCA()
    {
        return $this->precedentCA;
    }

    /**
     * @param mixed $precedentCA
     */
    public function setPrecedentCA($precedentCA)
    {
        $this->precedentCA = $precedentCA;
    }

    /**
     * @return string
     */
    public function getDateFormatted()
    {
        return $this->date->format('d/m/Y');
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @ODM\PrePersist()
     * @ODM\PreUpdate()
     */
    public function setDate()
    {
        $this->date = \DateTime::createFromFormat('d/m/Y his', $this->day.'/'.$this->month.'/'.$this->year.' 000000');
    }

    /**
     * @ODM\PrePersist()
     * @ODM\PreUpdate()
     */
    public function setWeek()
    {
        $weekNumber = (int)$this->date->format('W');
        $weekYear = (int)$this->date->format('Y');

        $lastDayOfTheYear = \DateTime::createFromFormat('d/m/Y', '31/12/'.$this->year);
        $lastDayWeekNumber = (int)$lastDayOfTheYear->format('W');

        // If the last day is in week 53, decrement weekNumber by one
        if ($lastDayWeekNumber == 53) {
            $weekNumber--;
        }

        // If weekNumber is 53 (from previous year)
        if ($weekNumber == 53) {
            $weekNumber--;
            $weekYear--;
        }

        if (strlen(strval($weekNumber)) == 1) {
            $weekNumber = '0'.$weekNumber;
        }

        $this->week = $weekYear.'/'.$weekNumber;
        $this->weekNumber = (int)$weekNumber;
    }

    /**
     * @ODM\PrePersist()
     * @ODM\PreUpdate()
     */
    public function setDayname()
    {
        $this->dayname = strtolower($this->date->format('D'));
    }


}