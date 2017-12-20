<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 19/12/2017
 * Time: 14:48
 */

namespace AppBundle\Manager;

use AppBundle\Document\Restaurant;
use Doctrine\Common\Collections\ArrayCollection;

class RestaurantManager
{
    /**
     * @var Restaurant
     */
    private $restaurant;

    /**
     * @var BudgetManager
     */
    private $budgetManager;
    /**
     * @var SalesManager
     */
    private $salesManager;

    /**
     * RestaurantManager constructor.
     * @param BudgetManager $budgetManager
     * @param SalesManager $salesManager
     */
    public function __construct(BudgetManager $budgetManager, SalesManager $salesManager)
    {
        $this->budgetManager = $budgetManager;

        $this->salesManager = $salesManager;
    }

    /**
     * @param Restaurant $restaurant
     */
    public function setRestaurant(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }


    public function getAllPlannedBudgets()
    {
        if (!empty($this->restaurant->getBudgets())) {
            // Extract all restaurants planned budgets, ordered by year
            $budgetCollection = $this->budgetManager->extractAllBudgets($this->restaurant->getBudgets());
            // With these budgets, here we need to transform them to a simple array
            $budgetListArrayed = $this->budgetManager->exportBudgetsToArray($budgetCollection);
            //We need to extract total sales
            $requestedYears = array_keys($budgetListArrayed);
            $totalSales = [];
            foreach ($requestedYears as $year) {
                $totalSales[$year] = $this->salesManager->computeMonthlySalesForYear($year, $this->restaurant);
            }
            // Finally, to be able to create tables and/or a charts for comparing budget planned and realized sales
            // Merge them both
            $mergedBudgets = [];
            foreach ($budgetListArrayed as $year=>$monthlyBudget) {
                $mergedBudgets[$year] = $this->budgetManager->mergeBudgetAndTotalSales($monthlyBudget, $totalSales[$year]);
            }
            return $mergedBudgets;
        } else {
            return [];
        }
    }
}