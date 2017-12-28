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

        /*
         * Examples
         * 0 - 50 => danger, red
         * 51 - 75 => yellow, yellow
         * 76 - 90 => primary, blue
         * 91 - 100 => success, green
         */
        foreach ($monthlyBudget['months'] as $month=>$budget) {
            $monthNumber = $this->utils->getMonthNumber($month);
            $realizedSales = $monthlySales[$monthNumber];

            if ($budget) {
                $progressPercent = round(($realizedSales / $budget) * 100, 1, PHP_ROUND_HALF_DOWN) ;
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

            $monthlyBudgetComparison['id'] = $monthlyBudget['id'];
            $monthlyBudgetComparison['months'][$month] = [
                'budgeted' => $budget,
                'realized' => $realizedSales,
                'progress_color' => $progressColor,
                'percent' => $progressPercent,
                'percent_color' => $progressPercentColor
            ];
        }

        return $monthlyBudgetComparison;
    }
}