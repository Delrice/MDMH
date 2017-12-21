<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 19/12/2017
 * Time: 10:26
 */

namespace AppBundle\Document;

use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class Budget
 * @package AppBundle\Document
 * @ODM\Document(repositoryClass="AppBundle\Document\Repositories\BudgetRepository")
 * @ODM\HasLifecycleCallbacks()
 */
class Budget
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
     * @ODM\Field(type="string")
     */
    private $year;

    /**
     * @ODM\Field(type="integer")
     */
    private $jan;

    /**
     * @ODM\Field(type="integer")
     */
    private $feb;

    /**
     * @ODM\Field(type="integer")
     */
    private $mar;

    /**
     * @ODM\Field(type="integer")
     */
    private $apr;

    /**
     * @ODM\Field(type="integer")
     */
    private $may;

    /**
     * @ODM\Field(type="integer")
     */
    private $jun;

    /**
     * @ODM\Field(type="integer")
     */
    private $jul;

    /**
     * @ODM\Field(type="integer")
     */
    private $aug;

    /**
     * @ODM\Field(type="integer")
     */
    private $sep;

    /**
     * @ODM\Field(type="integer")
     */
    private $oct;

    /**
     * @ODM\Field(type="integer")
     */
    private $nov;

    /**
     * @ODM\Field(type="integer")
     */
    private $dec;

    public function __construct(Restaurant $restaurant=null, $monthsPrefilledDatas=[])
    {
        $this->restaurant = $restaurant;
        if ($monthsPrefilledDatas) {
            $this->setFromArray($monthsPrefilledDatas);
        }
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
    public function getJan()
    {
        return $this->jan;
    }

    /**
     * @param mixed $jan
     */
    public function setJan($jan)
    {
        $this->jan = $jan;
    }

    /**
     * @return mixed
     */
    public function getFeb()
    {
        return $this->feb;
    }

    /**
     * @param mixed $feb
     */
    public function setFeb($feb)
    {
        $this->feb = $feb;
    }

    /**
     * @return mixed
     */
    public function getMar()
    {
        return $this->mar;
    }

    /**
     * @param mixed $mar
     */
    public function setMar($mar)
    {
        $this->mar = $mar;
    }

    /**
     * @return mixed
     */
    public function getApr()
    {
        return $this->apr;
    }

    /**
     * @param mixed $apr
     */
    public function setApr($apr)
    {
        $this->apr = $apr;
    }

    /**
     * @return mixed
     */
    public function getMay()
    {
        return $this->may;
    }

    /**
     * @param mixed $may
     */
    public function setMay($may)
    {
        $this->may = $may;
    }

    /**
     * @return mixed
     */
    public function getJun()
    {
        return $this->jun;
    }

    /**
     * @param mixed $jun
     */
    public function setJun($jun)
    {
        $this->jun = $jun;
    }

    /**
     * @return mixed
     */
    public function getJul()
    {
        return $this->jul;
    }

    /**
     * @param mixed $jul
     */
    public function setJul($jul)
    {
        $this->jul = $jul;
    }

    /**
     * @return mixed
     */
    public function getAug()
    {
        return $this->aug;
    }

    /**
     * @param mixed $aug
     */
    public function setAug($aug)
    {
        $this->aug = $aug;
    }

    /**
     * @return mixed
     */
    public function getSep()
    {
        return $this->sep;
    }

    /**
     * @param mixed $sep
     */
    public function setSep($sep)
    {
        $this->sep = $sep;
    }

    /**
     * @return mixed
     */
    public function getOct()
    {
        return $this->oct;
    }

    /**
     * @param mixed $oct
     */
    public function setOct($oct)
    {
        $this->oct = $oct;
    }

    /**
     * @return mixed
     */
    public function getNov()
    {
        return $this->nov;
    }

    /**
     * @param mixed $nov
     */
    public function setNov($nov)
    {
        $this->nov = $nov;
    }

    /**
     * @return mixed
     */
    public function getDec()
    {
        return $this->dec;
    }

    /**
     * @param mixed $dec
     */
    public function setDec($dec)
    {
        $this->dec = $dec;
    }

    public function setFromArray($monthsDatas)
    {
        if ($monthsDatas) {
            foreach($monthsDatas as $month=>$value) {
                $this->{$month} = $value;
            }
        }
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    public function __toString()
    {
        return $this->year;
    }
}