<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 19/12/2017
 * Time: 19:38
 */

namespace AppBundle\Services;


use Symfony\Component\PropertyAccess\Exception\RuntimeException;

class Utils
{
    private $months = [
        1 => 'jan',
        2 => 'feb',
        3 => 'mar',
        4 => 'apr',
        5 => 'may',
        6 => 'jun',
        7 => 'jul',
        8 => 'aug',
        9 => 'sep',
        10 => 'oct',
        11 => 'nov',
        12 => 'dec',
    ];

    /**
     * @return array
     */
    public function getMonths()
    {
        return $this->months;
    }

    /**
     * @param $monthShortName
     * @return array|bool
     */
    public function getMonthNumber($monthShortName)
    {
        if (in_array($monthShortName, $this->months))
            return array_search($monthShortName, $this->months);
        return false;
    }

    public function getMonthShortName($monthNumber)
    {
        if (empty($this->months[(int)$monthNumber]))
            throw new RuntimeException('No month available at position '.$monthNumber);
        return $this->months[(int)$monthNumber];
    }

    /**
     * @param integer $prevision
     * @param integer $realized
     * @return array
     */
    public function calculateAndColorizePercentProgression($prevision, $realized)
    {
        if ($prevision) {
            $progressPercent = round(($realized / $prevision) * 100, 1, PHP_ROUND_HALF_DOWN);
        } else {
            $progressPercent = 0;
        }

        if ($progressPercent <= 75) {
            $progressColor = 'danger';
            $progressPercentColor = 'red';
        } elseif ($progressPercent <= 95) {
            $progressColor = 'yellow';
            $progressPercentColor = 'yellow';
        } elseif ($progressPercent <= 100) {
            $progressColor = 'success';
            $progressPercentColor = 'green';
        } else {
            $progressColor = 'primary';
            $progressPercentColor = 'blue';
        }

        return [
            $progressPercent,
            $progressColor,
            $progressPercentColor
        ];
    }
}