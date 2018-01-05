<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 19/12/2017
 * Time: 19:38
 */

namespace AppBundle\Services;


use Symfony\Component\PropertyAccess\Exception\RuntimeException;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Translation\TranslatorInterface;

class Utils
{
    private $translator;
    private $urlGenerator;

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

    public function __construct(TranslatorInterface $translator, UrlGeneratorInterface $urlGenerator)
    {
        $this->translator = $translator;
        $this->urlGenerator = $urlGenerator;
    }

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
        $progressBarPercentage = 0; // progress bar
        $progressBarColor = 'danger'; // progress bar

        $realizedPercentage = 0;
        $realizedColor = 'red';

        if ($prevision) {
            $progressBarPercentage = round(($realized / $prevision) * 100, 1, PHP_ROUND_HALF_DOWN);
            $realizedPercentage = round($progressBarPercentage - 100, 1);
        }

        if ($progressBarPercentage >= 100) {
            $progressBarColor = 'success';
            $realizedColor = 'green';
        }

        return [
            $progressBarPercentage,
            $progressBarColor,
            $realizedPercentage,
            $realizedColor
        ];
    }

    public function generateMonthNavigation($routeName, $restaurantId, $year, $month)
    {
        $actualDateTime = \DateTime::createFromFormat('d/m/Y', '1/'.$month.'/'.$year);
        $actualDateTime->sub(new \DateInterval('P1M'));
        $prevMonth = $actualDateTime->format('m');
        $prevYear = $actualDateTime->format('Y');
        $navigationItemPrev = [
            'href' => $this->urlGenerator->generate($routeName, ['id' => $restaurantId, 'year' => $prevYear, 'month' => $prevMonth]),
            'title' => $this->translator->trans('month-'.$this->getMonthShortName($prevMonth)).' '.$prevYear
        ];

        $navigationItemCurrent = [
            'href' => $this->urlGenerator->generate($routeName, ['id' => $restaurantId, 'year' => $year, 'month' => $month]),
            'title' => $this->translator->trans('month-'.$this->getMonthShortName($month)).' '.$year
        ];

        $actualDateTime->add(new \DateInterval('P2M'));
        $nextMonth = $actualDateTime->format('m');
        $nextYear = $actualDateTime->format('Y');
        $navigationItemNext = [
            'href' => $this->urlGenerator->generate($routeName, ['id' => $restaurantId, 'year' => $nextYear, 'month' => $nextMonth]),
            'title' => $this->translator->trans('month-'.$this->getMonthShortName($nextMonth)).' '.$nextYear
        ];

        $navigation = [
            'prev' => $navigationItemPrev,
            'current' => $navigationItemCurrent,
            'next' => $navigationItemNext
        ];
        return $navigation;
    }
}