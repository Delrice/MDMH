<?php

namespace AppBundle\Controller;

use AppBundle\Document\Budget;
use AppBundle\Document\DailySale;
use AppBundle\Document\Restaurant;
use AppBundle\Form\BudgetType;
use AppBundle\Form\BudgetEditionForm;
use AppBundle\Form\DailySaleCreationForm;
use AppBundle\Form\DailySaleEditionForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DailySaleController
 * @package AppBundle\Controller
 * @Route("/sale")
 */
class DailySaleController extends Controller
{
    /**
     * @Route("/new/{id}/{year}/{month}/{day}", name="restaurant_daily_sale_new")
     */
    public function newDailySaleForRestaurantAction(Request $request, $id, $year, $month, $day)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $restaurant = $dm->getRepository(Restaurant::class)->find($id);

        $dailySale = new DailySale($restaurant);
        $dailySale->setYear($year);
        $dailySale->setMonth($month);
        $dailySale->setDay($day);

        $form = $this->createForm(DailySaleCreationForm::class, $dailySale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var DailySale $dailySale
             */
            $dailySale = $form->getData();
            $dm->persist($dailySale);
            $dm->flush();

            $this->addFlash('success', 'restaurant.daily_sale.new.success');

            return $this->redirectToRoute('restaurant_daily_sales', ['id' => $id]);
        }

        return $this->render('dailysales/create.html.twig', [
            'form' => $form->createView(),
            'restaurant' => $restaurant,
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'currentMenuActive' => [
                'menu.restaurant.'.$dailySale->getRestaurant()->getId(),
                'menu.restaurant.'.$dailySale->getRestaurant()->getId().'.daily_sales'
            ]
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @Route("/edit/{id}", name="restaurant_daily_sale_edit")
     */
    public function editAction(Request $request, $id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $dailySale = $dm->getRepository(DailySale::class)->find($id);

        $form = $this->createForm(DailySaleEditionForm::class, $dailySale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Budget $budget
             */
            $dailySale = $form->getData();
            $dm->persist($dailySale);
            $dm->flush();

            $this->addFlash('success', 'restaurant.daily_sale.update.success');

            return $this->redirectToRoute('restaurant_daily_sales', ['id' => $dailySale->getRestaurant()->getid()]);
        }

        return $this->render('budgets/edit.html.twig', [
            'form' => $form->createView(),
            'daily_sale' => $dailySale,
            'restaurant' => $dailySale->getRestaurant(),
            'currentMenuActive' => [
                'menu.restaurant.'.$dailySale->getRestaurant()->getId(),
                'menu.restaurant.'.$dailySale->getRestaurant()->getId().'.daily_sales'
            ]
        ]);
    }
}
