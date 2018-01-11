<?php

namespace AppBundle\Controller;

use AppBundle\Document\Budget;
use AppBundle\Document\Restaurant;
use AppBundle\Form\BudgetType;
use AppBundle\Manager\RestaurantManager;
use AppBundle\Services\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BudgetController
 * @package AppBundle\Controller
 */
class BudgetController extends BaseController
{
    /**
     * @Route("/budget/new/{id}/{year}", name="restaurant_budget_new")
     */
    public function newBudgetForRestaurantAction(Request $request, $id, $year)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $restaurant = $dm->getRepository(Restaurant::class)->find($id);

        $budget = new Budget($restaurant);
        $budget->setYear($year);

        $form = $this->createForm(BudgetType::class, $budget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Budget $budget
             */
            $budget = $form->getData();
            $dm->persist($budget);
            $dm->flush();

            $this->addFlash('success', 'restaurant.budget.new.success');

            return $this->redirectToRoute('restaurant_budgets', ['id' => $id, 'year' => $year]);
        }

        return $this->render('budgets/create.html.twig', [
            'form' => $form->createView(),
            'restaurant' => $restaurant,
            'year' => $year,
            'currentMenuActive' => [
                'menu.restaurant.'.$budget->getRestaurant()->getId(),
                'menu.restaurant.'.$budget->getRestaurant()->getId().'.budget'
            ]
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @Route("/budget/edit/{id}", name="restaurant_budget_edit")
     */
    public function editAction(Request $request, $id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $budget = $dm->getRepository(Budget::class)->find($id);

        $form = $this->createForm(BudgetType::class, $budget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Budget $budget
             */
            $budget = $form->getData();
            $dm->persist($budget);
            $dm->flush();

            $this->addFlash('success', 'restaurant.budget.update.success');

            return $this->redirectToRoute('restaurant_budgets', ['id' => $budget->getRestaurant()->getid(), 'year' => $budget->getYear()]);
        }

        return $this->render('budgets/edit.html.twig', [
            'form' => $form->createView(),
            'budget' => $budget,
            'restaurant' => $budget->getRestaurant(),
            'currentMenuActive' => [
                'menu.restaurant.'.$budget->getRestaurant()->getId(),
                'menu.restaurant.'.$budget->getRestaurant()->getId().'.budget'
            ]
        ]);
    }

    /**
     * @Route("/restaurants/budgets/{id}/{year}", name="restaurant_budgets", defaults={"year"=null})
     */
    public function budgetAction($id, $year, Security $securityService, RestaurantManager $restaurantManager)
    {
        $checkerResult = $this->checkUserAccess($id, $securityService);
        if ($checkerResult instanceof RedirectResponse)
            return $checkerResult;

        $dm = $this->get('doctrine_mongodb')->getManager();
        $restaurant = $dm->getRepository(Restaurant::class)->find($id);

        $restaurantManager->setRestaurant($restaurant);
        $annualBudgets = $restaurantManager->getAllPlannedBudgets();

        if (null === $year)
            $year = strftime('%Y', time());

        return $this->render('restaurants/budget.html.twig', [
            'currentMenuActive' => [
                'menu.restaurant.'.$id,
                'menu.restaurant.'.$id.'.budget'
            ],
            'restaurant' => $restaurant,
            'annualBudgets' => $annualBudgets,
            'year' => $year
        ]);
    }

}
