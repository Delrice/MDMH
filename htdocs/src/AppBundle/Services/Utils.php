<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 19/12/2017
 * Time: 19:38
 */

namespace AppBundle\Services;


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
}