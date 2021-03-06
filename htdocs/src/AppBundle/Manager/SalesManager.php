<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 19/12/2017
 * Time: 17:05
 */

namespace AppBundle\Manager;

use AppBundle\Document\Budget;
use AppBundle\Document\DailySale;
use AppBundle\Document\MarketRank;
use AppBundle\Document\Restaurant;
use AppBundle\Document\SouthEst;
use AppBundle\Model\MonthlySales;
use AppBundle\Model\TrackDailySales;
use AppBundle\Services\Utils;
use Doctrine\ODM\MongoDB\DocumentManager;
use \DateTime;

class SalesManager
{
    /**
     * @var DocumentManager
     */
    private $dm;
    /**
     * @var Utils
     */
    private $utils;
    /**
     * @var Restaurant
     */
    private $restaurant;

    /**
     * SalesManager constructor.
     * @param DocumentManager $dm
     * @param Utils $utils
     */
    public function __construct(DocumentManager $dm, Utils $utils)
    {
        $this->dm = $dm;
        $this->utils = $utils;
    }

    /**
     * @param Restaurant $restaurant
     */
    public function setRestaurant(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * @param $year
     * @return array
     */
    public function computeMonthlySalesForYear($year)
    {
        $computedMonthlySales = array_combine(array_keys($this->utils->getMonths()), [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]);
        $monthlySales = $this->dm->getRepository(DailySale::class)->computeMonthlySalesForYear($year, $this->restaurant);
        if ($monthlySales->count()) {
            foreach ($monthlySales as $monthlyResult) {
                $computedMonthlySales[$monthlyResult['_id']['month']] = $monthlyResult['foodSaleTotal'];
            }
        }
        return $computedMonthlySales;
    }

    /**
     * @param integer $year
     * @param integer $month
     * @return MonthlySales
     */
    public function prepareMonth($year, $month)
    {
        $monthlySales = new MonthlySales($this->restaurant, $year, $month);

        $searchOptions = [
            'restaurant' => $this->restaurant,
            'year' => $year,
            'month' => $month
        ];

        $maxDayInMonth = strftime('%d', mktime(0, 0, 0, $month + 1, 0, $year));

        /**
         * @var DailySale[] $dailySales
         * @var DailySale[] $monthlySalesEntries
         */
        $dailySales = $this->dm->getRepository(DailySale::class)->getDailySalesOrderedByDay($searchOptions);
        $monthlySalesEntries = [];
        foreach ($dailySales as $dailySale) {
            $monthlySalesEntries[$dailySale->getDay()] = $dailySale;
        }

        // If needed, add missing DailySale
        for ($i = 1; $i <= $maxDayInMonth; $i++) {
            if (empty($monthlySalesEntries[$i])) {
                $emptyDailySale = new DailySale($this->restaurant);
                $emptyDailySale->setYear($year);
                $emptyDailySale->setMonth($month);
                $emptyDailySale->setDay($i);
                $this->dm->persist($emptyDailySale);
                $this->dm->flush($emptyDailySale);
                $monthlySalesEntries[$i] = $emptyDailySale;
                $emptyDailySale = null;
            }
            $lastYearDailySale = $this->getPrecedentCA($year, $month, $i);
            $monthlySalesEntries[$i]->setPrecedentCA($lastYearDailySale['computed']);
        }
        $monthlySales->setDailySales($monthlySalesEntries);

        return $monthlySales;
    }

    /**
     * @param $year
     * @param $month
     * @param $day
     * @return []
     */
    public function getPrecedentCA($currentYear, $currentMonth, $currentDay)
    {
        $lastYearDailySale = $this->dm->getRepository(DailySale::class)
            ->findLastYearEntryForSameDayName((int)$currentYear, (int)$currentMonth, (int)$currentDay, $this->restaurant);

        $formatedPrecedentCA = [];
        $precedentCA = 0;
        if ($lastYearDailySale) {
            $precedentCA = $lastYearDailySale->getFoodSaleAmount();
            $formatedPrecedentCA[] = number_format($precedentCA, 0, '.', ' ').' &euro;';
            $formatedPrecedentCA[] = '<i class="small text-aqua">'.$lastYearDailySale->getDateFormatted().'</i>';
        }
        return ['document' => $lastYearDailySale, 'computed' => implode('<br />', $formatedPrecedentCA), 'amount' => $precedentCA];
    }

    /**
     * @param $year
     * @param $month
     * @return array
     */
    public function trackDailySales($year, $month)
    {
        $trackingDailySales = [
            'items' => [],
            'total' => [
                'precedentCA' => ['value' => 0, 'progression' => 0],
                'precedent2YearsCA' => ['value' => 0, 'progression' => 0],
                'currentCA' => ['value' => 0, 'progression' => 0],
                'cumul_daily_budget' => ['value' => 0, 'progression' => 0],
                'budget' => ['value' => 0, 'progression' => 0],
                'futureCA' => ['value' => 0, 'progression' => 0]
            ]
        ];

        $searchOptions = [
            'restaurant' => $this->restaurant,
            'year' => $year,
            'month' => $month
        ];
        /**
         * @var DailySale[] $dailySales
         * @var DailySale[] $monthlySalesEntries
         */
        $dailySales = $this->dm->getRepository(DailySale::class)->getDailySalesOrderedByDay($searchOptions);
        $monthlySalesEntries = [];
        foreach ($dailySales as $dailySale) {
            $monthlySalesEntries[$dailySale->getDay()][] = $dailySale;
        }

        $maxDayInMonth = strftime('%d', mktime(0, 0, 0, $month + 1, 0, $year));
        for ($i = 1; $i <= $maxDayInMonth; $i++) {
            $trackDailySales = new TrackDailySales($year, $month, $i);
            $lastYearDailySale = $this->getPrecedentCA($year, $month, $i);
            $trackDailySales->setPrecedentCA($lastYearDailySale);

            if (!empty($monthlySalesEntries[$i])) {
                foreach ($monthlySalesEntries[$i] as $monthlySalesEntry) {
                    $trackDailySales->setCurrentBudget($monthlySalesEntry->getBudgetAmount());
                    $trackDailySales->setCurrentSales($monthlySalesEntry->getFoodSaleAmount());

                    $trackingDailySales['total']['cumul_daily_budget']['value'] += $monthlySalesEntry->getBudgetAmount();
                }
            }

            $trackingDailySales['items'][] = $trackDailySales->compute();

            if (empty($trackDailySales->getCurrentSales())) {
                $trackingDailySales['total']['futureCA']['value'] += $trackDailySales->getCurrentBudget();
            } else {
                $trackingDailySales['total']['futureCA']['value'] += $trackDailySales->getCurrentSales();
                $trackingDailySales['total']['currentCA']['value'] += $trackDailySales->getCurrentSales();
            }
        }

        $precedentDailySales = $this->dm->getRepository(DailySale::class)->computeMonthlySalesForYear($year - 1, $this->restaurant);
        if ($precedentDailySales->count()) {
            foreach ($precedentDailySales as $monthlyResult) {
                if ($monthlyResult['_id']['month'] == $month) {
                    $trackingDailySales['total']['precedentCA']['value'] = $monthlyResult['foodSaleTotal'];
                    break;
                }
            }
        }

        // last 2 years precedent sales
        $precedentDailySales = $this->dm->getRepository(DailySale::class)->computeMonthlySalesForYear($year - 2, $this->restaurant);
        if ($precedentDailySales->count()) {
            foreach ($precedentDailySales as $monthlyResult) {
                if ($monthlyResult['_id']['month'] == $month) {
                    $trackingDailySales['total']['precedent2YearsCA']['value'] = $monthlyResult['foodSaleTotal'];
                    break;
                }
            }
        }

        if ($trackingDailySales['total']['precedentCA']['value']) {
            $n1 = $trackingDailySales['total']['precedentCA']['value'];

            if ($trackingDailySales['total']['precedent2YearsCA']['value']) {
                $n2 = $trackingDailySales['total']['precedent2YearsCA']['value'];
                $trackingDailySales['total']['precedentCA']['progression'] = round((($n1 - $n2) / $n2) * 100, 2);
            }

            $prevJ = $trackingDailySales['total']['cumul_daily_budget']['value'];
            $trackingDailySales['total']['cumul_daily_budget']['progression'] = round((($prevJ - $n1) / $n1) * 100, 2);

            $n = $trackingDailySales['total']['currentCA']['value'];
            $trackingDailySales['total']['currentCA']['progression'] = round((($n - $n1) / $n1) * 100, 2);

            $f = $trackingDailySales['total']['futureCA']['value'];
            $trackingDailySales['total']['futureCA']['progression'] = round((($f - $n1) / $n1) * 100, 2);
            $trackingDailySales['total']['futureCA']['progression_supp'] = $f - $prevJ;
        }

        $searchOptions = ['year' => $year];
        if ($this->restaurant) {
            $searchOptions['restaurant'] = $this->restaurant;
        }

        $restaurantBudgetList = $this->dm->getRepository(Budget::class)->findBy($searchOptions);
        if ($restaurantBudgetList) {
            foreach ($restaurantBudgetList as $restaurantBudget) {
                $annualBudget = $restaurantBudget->toArray();
                $monthName = strtolower(strftime('%b', mktime(0, 0, 0, $month, 1, $year)));
                $trackingDailySales['total']['budget']['value'] += $annualBudget[$monthName];
            }
        }

        return $trackingDailySales;
    }

    /**
     * @param $year
     * @return array
     */
    public function trackWeeklySales($year)
    {
        $trackingWeeklySales = [
            'items' => []
        ];

        $computedWeeklySales = [];
        for ($i=0; $i<=53; $i++) {
            $computedWeeklySales[$i] = [
                'n-3' => 0,
                'n-2' => 0,
                'n-1' => 0,
                'n' => 0,
            ];
        }

        /**
         * @var DailySale[] $dailySales
         * @var DailySale[] $weeklySales
         */
        // current year
        $weeklySales = $this->dm->getRepository(DailySale::class)->getDailySalesGroupedByWeek($year, $this->restaurant);
        if ($weeklySales->count()) {
            foreach ($weeklySales as $weeklyResult) {
                $computedWeeklySales[$weeklyResult['_id']['weekNumber']]['n'] = $weeklyResult['foodSaleTotal'];
            }
        }

        // n-1
        $weeklySales = $this->dm->getRepository(DailySale::class)->getDailySalesGroupedByWeek($year - 1, $this->restaurant);
        if ($weeklySales->count()) {
            foreach ($weeklySales as $weeklyResult) {
                $computedWeeklySales[$weeklyResult['_id']['weekNumber']]['n-1'] = $weeklyResult['foodSaleTotal'];
            }
        }

        // n-2
        $weeklySales = $this->dm->getRepository(DailySale::class)->getDailySalesGroupedByWeek($year - 2, $this->restaurant);
        if ($weeklySales->count()) {
            foreach ($weeklySales as $weeklyResult) {
                $computedWeeklySales[$weeklyResult['_id']['weekNumber']]['n-2'] = $weeklyResult['foodSaleTotal'];
            }
        }

        // n-3
        $weeklySales = $this->dm->getRepository(DailySale::class)->getDailySalesGroupedByWeek($year - 3, $this->restaurant);
        if ($weeklySales->count()) {
            foreach ($weeklySales as $weeklyResult) {
                $computedWeeklySales[$weeklyResult['_id']['weekNumber']]['n-3'] = $weeklyResult['foodSaleTotal'];
            }
        }

        // SE
        $SE = $this->dm->getRepository(SouthEst::class)->findOneBy(['year' => (int)$year]);
        if (!$SE)
            $SE = new SouthEst();

        // now, calculate
        foreach ($computedWeeklySales as $week=>$datas) {
            if (!empty($datas['n']) || !empty($datas['n-1']) || !empty($datas['n-2']) || !empty($datas['n-3'])) {
                $element = [
                    'week' => $week,
                    'year3' => $datas['n-3'],
                    'year2' => $datas['n-2'],
                    'ratio_year3_year2' => !empty($datas['n-3'])? round((($datas['n-2'] - $datas['n-3']) / $datas['n-3']) * 100, 2): -100,
                    'year1' => $datas['n-1'],
                    'ratio_year2_year1' => !empty($datas['n-2'])? round((($datas['n-1'] - $datas['n-2']) / $datas['n-2']) * 100, 2): -100,
                    'year' => $datas['n'],
                    'ratio_year1_year' => !empty($datas['n-1'])? round((($datas['n'] - $datas['n-1']) / $datas['n-1']) * 100, 2): -100,
                    'SE' => $SE->getWeek($week),
                    'ratio_year_SE' => 0,
                    'ratio_year2_year' => !empty($datas['n-2'])? round((($datas['n'] - $datas['n-2']) / $datas['n-2']) * 100, 2): -100
                ];
                $element['ratio_year_SE'] = $element['ratio_year1_year'] - $element['SE'];
                $trackingWeeklySales['items'][] = $element;
            }
        }

        return $trackingWeeklySales;
    }

    /**
     * @return array
     */
    public function trackMonthlySales()
    {
        $trackingMonthlySales = [
            'items' => [],
            'year' => [
                'min' => strftime('%Y', time()) - 2,
                'max' => strftime('%Y', time())
            ]
        ];

        $computedMonthlySales = [];
        foreach ($this->utils->getMonths() as $monthNumber=>$monthShortName) {
            $computedMonthlySales[$monthNumber] = [
                'month' => $monthShortName,
                'year' => 0,
                'amount' => 0,
                'ratio_year1_year' => 0,
                'SE' => 0,
                'ratio_year_SE' => 0,
                'rank' => 0
            ];
        }

        $SEList = $marketRankList = [];

        $monthlySales = $this->dm->getRepository(DailySale::class)->getDailySalesGroupedByMonth($this->restaurant);
        if ($monthlySales->count()) {
            foreach ($monthlySales as $monthlyResult) {
                $monthNumber = $monthlyResult['_id']['month'];
                $year = $monthlyResult['_id']['year'];
                $amount = $monthlyResult['foodSaleTotal'];

                if ($year < $trackingMonthlySales['year']['min'])
                    $trackingMonthlySales['year']['min'] = $year;

                $item = $computedMonthlySales[$monthNumber];

                $item['year'] = $year;
                $item['amount'] = $amount;

                // SE
                if (empty($SEList[$year])) {
                    $SE = $this->dm->getRepository(SouthEst::class)->findOneBy(['year' => (int)$year]);
                    if (!$SE)
                        $SE = new SouthEst();
                    $SEList[$year] = $SE;
                } else {
                    $SE = $SEList[$year];
                }
                $item['SE'] = $SE->getMonth($monthNumber);

                // MarketRank
                if (empty($marketRankList[$year])) {
                    $marketRank = $this->dm->getRepository(MarketRank::class)->findOneBy(['year' => (int)$year, 'restaurant' => $this->restaurant]);
                    if (!$marketRank)
                        $marketRank = new MarketRank($this->restaurant);
                    $marketRankList[$year] = $marketRank;
                } else {
                    $marketRank = $marketRankList[$year];
                }
                $item['rank'] = $marketRank->getMonth($monthNumber);

                if (!empty($trackingMonthlySales['items'][$monthNumber][$year - 1])) {
                    $precedentYear = $trackingMonthlySales['items'][$monthNumber][$year - 1];
                    $item['ratio_year1_year'] = !empty($precedentYear['amount'])? round((($item['amount'] - $precedentYear['amount']) / $precedentYear['amount']) * 100, 2): -100;
                    $item['ratio_year_SE'] = $item['ratio_year1_year'] - $item['SE'];
                }

                $trackingMonthlySales['items'][$monthNumber][$year] = $item;
            }
            ksort($trackingMonthlySales['items']);
        }

        return $trackingMonthlySales;
    }

    /**
     * @return array
     */
    public function trackGlobalMonthlySales()
    {
        $trackingMonthlySales = [
            'items' => [],
            'total' => [
                'first_semestre' => [],
                'second_semestre' => [],
                'annual' => []
            ],
            'year' => [
                'min' => strftime('%Y', time()) - 2,
                'max' => strftime('%Y', time())
            ]
        ];

        $computedMonthlySales = [];
        foreach ($this->utils->getMonths() as $monthNumber=>$monthShortName) {
            $computedMonthlySales[$monthNumber] = [
                'month' => $monthShortName,
                'year' => 0,
                'amount' => 0,
                'ratio_year2_year1' => 0,
                'ratio_year1_year' => 0,
                'ratio_year2_year' => 0,
                'SE' => 0,
                'ratio_year_SE' => 0,
                'rank' => 0
            ];
        }

        $SEList = $marketRankList = [];
        $monthlySales = $this->dm->getRepository(DailySale::class)->getDailySalesGroupedByMonth($this->restaurant, strftime('%Y', time()) - 7);
        if ($monthlySales->count()) {
            foreach ($monthlySales as $monthlyResult) {
                $monthNumber = $monthlyResult['_id']['month'];
                $year = $monthlyResult['_id']['year'];
                $amount = $monthlyResult['foodSaleTotal'];

                if ($year < $trackingMonthlySales['year']['min'])
                    $trackingMonthlySales['year']['min'] = $year;

                $item = $computedMonthlySales[$monthNumber];

                $item['year'] = $year;
                $item['amount'] = $amount;

                // SE
                if (empty($SEList[$year])) {
                    $SE = $this->dm->getRepository(SouthEst::class)->findOneBy(['year' => (int)$year]);
                    if (!$SE)
                        $SE = new SouthEst();
                    $SEList[$year] = $SE;
                } else {
                    $SE = $SEList[$year];
                }
                $item['SE'] = $SE->getMonth($monthNumber);

                // MarketRank
                if (empty($marketRankList[$year])) {
                    $marketRank = $this->dm->getRepository(MarketRank::class)->findOneBy(['year' => (int)$year, 'restaurant' => null]);
                    if (!$marketRank)
                        $marketRank = new MarketRank();
                    $marketRankList[$year] = $marketRank;
                } else {
                    $marketRank = $marketRankList[$year];
                }
                $item['rank'] = $marketRank->getMonth($monthNumber);

                if (!empty($trackingMonthlySales['items'][$monthNumber][$year - 1])) {
                    $precedentYear = $trackingMonthlySales['items'][$monthNumber][$year - 1];
                    $item['ratio_year1_year'] = !empty($precedentYear['amount'])? round((($item['amount'] - $precedentYear['amount']) / $precedentYear['amount']) * 100, 2): -100;
                    $item['ratio_year_SE'] = $item['ratio_year1_year'] - $item['SE'];
                }

                if (!empty($trackingMonthlySales['items'][$monthNumber][$year - 2])) {
                    $precedentYear = $trackingMonthlySales['items'][$monthNumber][$year - 2];
                    $item['ratio_year2_year'] = !empty($precedentYear['amount'])? round((($item['amount'] - $precedentYear['amount']) / $precedentYear['amount']) * 100, 2): -100;
                }

                $trackingMonthlySales['items'][$monthNumber][$year] = $item;

                if (empty($trackingMonthlySales['total']['first_semestre'][$year])) {
                    $trackingMonthlySales['total']['first_semestre'][$year] = [
                        'month' => 'first_semestre',
                        'year' => $year,
                        'amount' => 0,
                        'ratio_year2_year1' => 0,
                        'ratio_year1_year' => 0,
                        'ratio_year2_year' => 0,
                        'SE' => $SE->getFirstSemestre(),
                        'ratio_year_SE' => 0,
                        'rank' => '--'
                    ];
                }

                if (empty($trackingMonthlySales['total']['second_semestre'][$year])) {
                    $trackingMonthlySales['total']['second_semestre'][$year] = [
                        'month' => 'second_semestre',
                        'year' => $year,
                        'amount' => 0,
                        'ratio_year2_year1' => 0,
                        'ratio_year1_year' => 0,
                        'ratio_year2_year' => 0,
                        'SE' => $SE->getSecondSemestre(),
                        'ratio_year_SE' => 0,
                        'rank' => '--'
                    ];
                }

                if (empty($trackingMonthlySales['total']['annual'][$year])) {
                    $trackingMonthlySales['total']['annual'][$year] = [
                        'month' => 'annual',
                        'year' => $year,
                        'amount' => 0,
                        'ratio_year2_year1' => 0,
                        'ratio_year1_year' => 0,
                        'ratio_year2_year' => 0,
                        'SE' => $SE->getAnnual(),
                        'ratio_year_SE' => 0,
                        'rank' => $marketRank->getAnnual()
                    ];
                }

                if ($monthNumber <= 6) {
                    $trackingMonthlySales['total']['first_semestre'][$year]['amount'] += $item['amount'];
                    if (!empty($trackingMonthlySales['total']['first_semestre'][$year - 1]['amount']))
                        $trackingMonthlySales['total']['first_semestre'][$year]['ratio_year1_year'] = (($trackingMonthlySales['total']['first_semestre'][$year]['amount'] - $trackingMonthlySales['total']['first_semestre'][$year - 1]['amount']) / $trackingMonthlySales['total']['first_semestre'][$year - 1]['amount']) * 100;
                    if (!empty($trackingMonthlySales['total']['first_semestre'][$year - 2]['amount']))
                        $trackingMonthlySales['total']['first_semestre'][$year]['ratio_year2_year'] = (($trackingMonthlySales['total']['first_semestre'][$year]['amount'] - $trackingMonthlySales['total']['first_semestre'][$year - 2]['amount']) / $trackingMonthlySales['total']['first_semestre'][$year - 2]['amount']) * 100;
                    $trackingMonthlySales['total']['first_semestre'][$year]['ratio_year_SE'] = $trackingMonthlySales['total']['first_semestre'][$year]['ratio_year1_year'] - $trackingMonthlySales['total']['first_semestre'][$year]['SE'];
                } else {
                    $trackingMonthlySales['total']['second_semestre'][$year]['amount'] += $item['amount'];

                    if (!empty($trackingMonthlySales['total']['second_semestre'][$year - 1]['amount']))
                        $trackingMonthlySales['total']['second_semestre'][$year]['ratio_year1_year'] = (($trackingMonthlySales['total']['second_semestre'][$year]['amount'] - $trackingMonthlySales['total']['second_semestre'][$year - 1]['amount']) / $trackingMonthlySales['total']['second_semestre'][$year - 1]['amount']) * 100;
                    if (!empty($trackingMonthlySales['total']['second_semestre'][$year - 2]['amount']))
                        $trackingMonthlySales['total']['second_semestre'][$year]['ratio_year2_year'] = (($trackingMonthlySales['total']['second_semestre'][$year]['amount'] - $trackingMonthlySales['total']['second_semestre'][$year - 2]['amount']) / $trackingMonthlySales['total']['second_semestre'][$year - 2]['amount']) * 100;
                    $trackingMonthlySales['total']['second_semestre'][$year]['ratio_year_SE'] = $trackingMonthlySales['total']['second_semestre'][$year]['ratio_year1_year'] - $trackingMonthlySales['total']['second_semestre'][$year]['SE'];
                }

                $trackingMonthlySales['total']['annual'][$year]['amount'] += $item['amount'];
                if (!empty($trackingMonthlySales['total']['annual'][$year - 1]['amount']))
                    $trackingMonthlySales['total']['annual'][$year]['ratio_year1_year'] = (($trackingMonthlySales['total']['annual'][$year]['amount'] - $trackingMonthlySales['total']['annual'][$year - 1]['amount']) / $trackingMonthlySales['total']['annual'][$year - 1]['amount']) * 100;
                if (!empty($trackingMonthlySales['total']['annual'][$year - 2]['amount']))
                    $trackingMonthlySales['total']['annual'][$year]['ratio_year2_year'] = (($trackingMonthlySales['total']['annual'][$year]['amount'] - $trackingMonthlySales['total']['annual'][$year - 2]['amount']) / $trackingMonthlySales['total']['annual'][$year - 2]['amount']) * 100;
                $trackingMonthlySales['total']['annual'][$year]['ratio_year_SE'] = $trackingMonthlySales['total']['annual'][$year]['ratio_year1_year'] - $trackingMonthlySales['total']['annual'][$year]['SE'];

            }
            ksort($trackingMonthlySales['items']);
        }

        return $trackingMonthlySales;
    }
}