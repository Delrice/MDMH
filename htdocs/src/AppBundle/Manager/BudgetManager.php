<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 19/12/2017
 * Time: 14:47
 */

namespace AppBundle\Manager;

use AppBundle\Document\Budget;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ODM\MongoDB\PersistentCollection;
use AppBundle\Services\Utils;

class BudgetManager
{
    /**
     * @var Utils
     */
    private $utils;

    public function __construct(Utils $utils)
    {
        $this->utils = $utils;
    }

    /**
     * @param PersistentCollection $budgetsCollection[]
     * @return ArrayCollection
     */
    public function extractAllBudgets(PersistentCollection $budgetsCollection)
    {
        $collection = new ArrayCollection($budgetsCollection->toArray());

        /**
         * Sort all returned Budget[] in an ArrayCollection by "year"
         */
        $sort = Criteria::create();
        $sort->orderBy([
            'year' => Criteria::ASC
        ]);
        $budgets = $collection->matching($sort);

        return $budgets;
    }

    /**
     * @param ArrayCollection $budgetsCollection
     * @return array
     */
    public function exportBudgetsToArray(ArrayCollection $budgetsCollection)
    {
        $exportedBudgets = [];
        foreach ($budgetsCollection as $budgetDocument) {
            $exportedBudgets[$budgetDocument->getYear()] = ['id' => $budgetDocument->getId(), 'months' => $budgetDocument->toArray()];
            unset(
                $exportedBudgets[$budgetDocument->getYear()]['months']['id'],
                $exportedBudgets[$budgetDocument->getYear()]['months']['restaurant'],
                $exportedBudgets[$budgetDocument->getYear()]['months']['year'],
                $exportedBudgets[$budgetDocument->getYear()]['months']['createdAt'],
                $exportedBudgets[$budgetDocument->getYear()]['months']['updatedAt']
            );
        }
        return $exportedBudgets;
    }

    /**
     * @param $monthlyBudget
     * @param $monthlySales
     * @return array
     */
    public function mergeBudgetAndTotalSales($monthlyBudget, $monthlySales)
    {
        $monthlyBudgetComparison = [];
        $monthlyBudgetComparison['id'] = $monthlyBudget['id'];

        /*
         * Examples
         * 0 - 50 => danger, red
         * 51 - 75 => yellow, yellow
         * 76 - 90 => primary, blue
         * 91 - 100 => success, green
         */
        $totalBudget = $totalRealized = 0;
        foreach ($monthlyBudget['months'] as $month=>$budget) {
            $monthNumber = $this->utils->getMonthNumber($month);
            $realizedSales = $monthlySales[$monthNumber];

            $totalBudget += $budget;
            $totalRealized += $realizedSales;

            list($progressPercent, $progressColor, $progressPercentColor) = $this->utils->calculateAndColorizePercentProgression($budget, $realizedSales);
            $monthlyBudgetComparison['months'][$month] = [
                'budgeted' => $budget,
                'realized' => $realizedSales,
                'progress_color' => $progressColor,
                'percent' => $progressPercent,
                'percent_color' => $progressPercentColor
            ];
        }
        $monthlyBudgetComparison['total_budget'] = $totalBudget;
        $monthlyBudgetComparison['total_realized'] = $totalRealized;

        list($progressPercent, $progressColor, $progressPercentColor) = $this->utils->calculateAndColorizePercentProgression($totalBudget, $totalRealized);
        $monthlyBudgetComparison['total_progress'] = $progressPercent;
        $monthlyBudgetComparison['total_percent_color'] = $progressPercentColor;
        $monthlyBudgetComparison['total_progress_color'] = $progressColor;

        return $monthlyBudgetComparison;
    }
}