<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 03/01/2018
 * Time: 11:13
 */

namespace AppBundle\Model;

use \DateTime;

class TrackDailySales
{
    /**
     * @var \DateTime
     */
    private $datetime;

    /**
     * @var float
     */
    private $precedent_sales;

    /**
     * @var float
     */
    private $current_budget;

    /**
     * @var float
     */
    private $ratio_cbudget_psales;

    /**
     * @var float
     */
    private $current_sales;

    /**
     * @var float
     */
    private $ratio_csales_cbudget;

    /**
     * @var float
     */
    private $ratio_csales_psales;

    /**
     * @var mixed
     */
    private $precedentCA;

    /**
     * TrackDailySales constructor.
     * @param $year
     * @param $month
     */
    public function __construct($year, $month, $day)
    {
        $this->datetime = DateTime::createFromFormat('d/m/Y', "$day/$month/$year");

        $this->ratio_cbudget_psales = 0.00;
        $this->ratio_csales_cbudget = 0.00;
        $this->ratio_csales_psales = 0.00;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->datetime->format('Y');
    }

    /**
     * @return string
     */
    public function getMonth()
    {
        return $this->datetime->format('m');
    }

    /**
     * @return string
     */
    public function getDay()
    {
        return $this->datetime->format('d');
    }

    /**
     * @return string
     */
    public function getDayname()
    {
        return $this->datetime->format('D');
    }

    /**
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param \DateTime $datetime
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->datetime->format('d/m/Y');
    }

    /**
     * @return float
     */
    public function getPrecedentSales()
    {
        return $this->precedent_sales;
    }

    /**
     * @param float $precedent_sales
     */
    public function setPrecedentSales($precedent_sales)
    {
        $this->precedent_sales = $precedent_sales;
    }

    /**
     * @return float
     */
    public function getCurrentBudget()
    {
        return $this->current_budget;
    }

    /**
     * @param float $current_budget
     */
    public function setCurrentBudget($current_budget)
    {
        $this->current_budget = $current_budget;
    }

    /**
     * @return float
     */
    public function getRatioCbudgetPsales()
    {
        $previousSales = 0;
        if (!empty($this->precedentCA['document']))
            $previousSales = $this->precedentCA['document']->getFoodSaleAmount();
        $currentBudget = $this->current_budget;
        if ($previousSales/* && $currentBudget*/)
            return round((($currentBudget - $previousSales) / $previousSales) * 100, 2);
        else
            return 0;
    }

    /**
     * @return float
     */
    public function getCurrentSales()
    {
        return $this->current_sales;
    }

    /**
     * @param float $current_sales
     */
    public function setCurrentSales($current_sales)
    {
        $this->current_sales = $current_sales;
    }

    /**
     * @return float
     */
    public function getRatioCsalesCbudget()
    {
        $currentBudget = $this->current_budget;
        $currentSales = $this->current_sales;
        if ($currentBudget/* && $currentSales*/)
            return round((($currentSales - $currentBudget) / $currentBudget) * 100, 2);
        else
            return 0;
    }

    /**
     * @return float
     */
    public function getRatioCsalesPsales()
    {
        $previousSales = 0;
        if (!empty($this->precedentCA['document']))
            $previousSales = $this->precedentCA['document']->getFoodSaleAmount();
        $currentSales = $this->current_sales;
        if ($previousSales/* && $currentSales*/)
            return round((($currentSales - $previousSales) / $previousSales) * 100, 2);
        else
            return 0;
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


    public function compute()
    {
        return [
            'dayname' => 'dayname-'.strtolower($this->getDayname()),
            'date' => $this->getDate(),
            'precedent_sales' => $this->precedentCA['computed'],
            'current_budget' => $this->current_budget,
            'ratio_cbudget_psales' => $this->getRatioCbudgetPsales(),
            'current_sales' => $this->current_sales,
            'ratio_csales_cbudget' => $this->getRatioCsalesCbudget(),
            'ratio_csales_psales' => $this->getRatioCsalesPsales()
        ];
    }

}