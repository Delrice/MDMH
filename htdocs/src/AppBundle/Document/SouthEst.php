<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 09/01/2018
 * Time: 13:21
 */

namespace AppBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class SouthEst
 * @package AppBundle\Document
 * @ODM\Document(repositoryClass="AppBundle\Document\Repositories\SouthEstRepository")
 * @ODM\HasLifecycleCallbacks()
 * @ODM\Index(keys={"year"="asc"}))
 */
class SouthEst
{
    use ExtendedProperties\CreatedAtTrait;
    use ExtendedProperties\UpdatedAtTrait;

    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @ODM\Field(type="integer")
     */
    private $year;

    /**
     * @ODM\Field(type="integer")
     */
    private $annual;

    /**
     * @ODM\Field(type="hash")
     */
    private $monthly;

    /**
     * @ODM\Field(type="hash")
     */
    private $weekly;

    public function __construct()
    {
        $this->annual = 0;
        $this->monthly = [];
        $this->weekly = [];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getAnnual()
    {
        return $this->annual;
    }

    /**
     * @param mixed $annual
     */
    public function setAnnual($annual)
    {
        $this->annual = $annual;
    }

    /**
     * @return array
     */
    public function getMonthly()
    {
        return $this->monthly;
    }

    /**
     * @param array $monthly
     */
    public function setMonthly($monthly)
    {
        $this->monthly = $monthly;
    }

    /**
     * @param $monthNumber
     * @param $monthAmount
     */
    public function addMonth($monthNumber, $monthAmount)
    {
        $this->monthly[$monthNumber] = $monthAmount;
    }

    /**
     * @param $monthNumber
     * @return int
     */
    public function getMonth($monthNumber)
    {
        if (!empty($this->monthly[$monthNumber]))
            return $this->monthly[$monthNumber];
        else
            return 0;
    }

    /**
     * @return array
     */
    public function getWeekly()
    {
        return $this->weekly;
    }

    /**
     * @param array $weekly
     */
    public function setWeekly($weekly)
    {
        $this->weekly = $weekly;
    }

    /**
     * @param $weekNumber
     * @param $weekAmount
     */
    public function addWeek($weekNumber, $weekAmount)
    {
        $this->weekly[$weekNumber] = $weekAmount;
    }

    /**
     * @param $weekNumber
     * @return int
     */
    public function getWeek($weekNumber)
    {
        if (!empty($this->weekly[$weekNumber]))
            return $this->weekly[$weekNumber];
        else
            return 0;
    }
}