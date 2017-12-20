<?php

namespace AppBundle\Controller;

use AppBundle\Document\Budget;
use AppBundle\Form\BudgetCreationForm;
use AppBundle\Form\BudgetEditionForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BudgetController
 * @package AppBundle\Controller
 * @Route("/budget")
 */
class BudgetController extends Controller
{
    /**
     * @Route("/new/{id}/{year}", name="restaurant_budget_new")
     */
    public function newBudgetForRestaurantAction(Request $request, $id, $year)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $restaurant = $dm->getRepository('AppBundle:Restaurant')->find($id);

        $budget = new Budget($restaurant);
        $budget->setYear($year);

        $form = $this->createForm(BudgetCreationForm::class, $budget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Budget $budget
             */
            $budget = $form->getData();
            $dm->persist($budget);
            $dm->flush();

            $this->addFlash('success', 'restaurant.budget.new.success');

            return $this->redirectToRoute('restaurant_budget', ['id' => $id]);
        }

        return $this->render('budgets/create.html.twig', [
            'form' => $form->createView(),
            'restaurant' => $restaurant,
            'year' => $year,
            'currentMenuActive' => [
                'menu.restaurant.'.$id,
                'menu.restaurant.'.$id.'.budget'
            ]
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @Route("/edit/{id}", name="restaurant_budget_edit")
     */
    public function editAction(Request $request, $id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $budget = $dm->getRepository('AppBundle:Budget')->find($id);

        $form = $this->createForm(BudgetEditionForm::class, $budget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Budget $budget
             */
            $budget = $form->getData();
            $dm->persist($budget);
            $dm->flush();

            $this->addFlash('success', 'restaurant.budget.update.success');

            return $this->redirectToRoute('restaurant_budget', ['id' => $budget->getRestaurant()->getid()]);
        }

        return $this->render('budgets/edit.html.twig', [
            'form' => $form->createView(),
            'budget' => $budget,
            'restaurant' => $budget->getRestaurant(),
            'currentMenuActive' => [
                'menu.restaurant.'.$id,
                'menu.restaurant.'.$id.'.budget'
            ]
        ]);
    }
}
