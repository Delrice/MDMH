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
 * Class MarketRank
 * @package AppBundle\Document
 * @ODM\Document(repositoryClass="AppBundle\Document\Repositories\MarketRankRepository")
 * @ODM\HasLifecycleCallbacks()
 * @ODM\Index(keys={"year"="asc"}))
 */
class MarketRank
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

    public function __construct()
    {
        $this->annual = 0;
        $this->monthly = [];
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
}