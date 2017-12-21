<?php

namespace AppBundle\Controller;

use AppBundle\Document\DailySale;
use AppBundle\Document\Restaurant;
use AppBundle\Form\MonthlySalesType;
use AppBundle\Form\RestaurantType;
use AppBundle\Manager\RestaurantManager;
use AppBundle\Manager\SalesManager;
use AppBundle\Model\MonthlySales;
use AppBundle\Services\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class RestaurantController
 * @package AppBundle\Controller
 * @Route("/restaurants")
 */
class RestaurantController extends Controller
{
    /**
     * @Route("/", name="restaurant_list")
     */
    public function listAction()
    {
        $restaurantList = $this->get('doctrine_mongodb')
            ->getRepository(Restaurant::class)
            ->findAll();

        return $this->render('restaurants/list.html.twig', [
            'restaurant_list' => $restaurantList,
            'currentMenuActive' => ['administrator.restaurants']
        ]);
    }

    /**
     * @Route("/view/{id}", name="restaurant_view")
     */
    public function viewAction($id, RestaurantManager $restaurantManager)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $restaurant = $dm->getRepository(Restaurant::class)->find($id);

        $restaurantManager->setRestaurant($restaurant);
        $annualBudgets = $restaurantManager->getAllPlannedBudgets();

        return $this->render('restaurants/view.html.twig', [
            'restaurant' => $restaurant,
            'currentMenuActive' => ['menu.restaurant.'.$id],
            'annualBudgets' => $annualBudgets
        ]);
    }

    /**
     * @Route("/edit/{id}", name="restaurant_edit")
     *
     */
    public function editAction(Request $request, $id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $restaurant = $dm->getRepository(Restaurant::class)->find($id);

        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * @var Restaurant $restaurant
             */
            $restaurant = $form->getData();
            $dm->persist($restaurant);
            $dm->flush();

            $this->addFlash('success', 'restaurant.update.success');

            return $this->redirectToRoute('restaurant_list');
        }

        return $this->render('restaurants/edit.html.twig', [
            'form' => $form->createView(),
            'restaurant' => $restaurant,
            'currentMenuActive' => ['administrator.restaurants']
        ]);
    }

    /**
     * @Route("/new", name="restaurant_new")
     */
    public function newAction(Request $request)
    {
        $restaurant = new Restaurant();

        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Restaurant $restaurant
             */
            $restaurant = $form->getData();

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($restaurant);
            $dm->flush();

            $this->addFlash('success', 'restaurant.new.success');

            return $this->redirectToRoute('restaurant_list');
        }

        return $this->render('restaurants/create.html.twig', [
            'form' => $form->createView(),
            'currentMenuActive' => ['administrator.restaurants']
        ]);
    }

    /**
     * @Route("/delete/{id}", name="restaurant_delete")
     */
    public function deleteAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $restaurant = $dm->getRepository(Restaurant::class)->find($id);
        $dm->remove($restaurant);
        $dm->flush();

        $this->addFlash('success', 'restaurant.delete.success');

        return $this->redirectToRoute('restaurant_list');
    }

    /**
     * @Route("/budgets/{id}", name="restaurant_budgets")
     */
    public function budgetAction($id, Security $securityService, RestaurantManager $restaurantManager)
    {
        $checkerResult = $this->checkUserAccess($id, $securityService);
        if ($checkerResult instanceof RedirectResponse)
            return $checkerResult;

        $dm = $this->get('doctrine_mongodb')->getManager();
        $restaurant = $dm->getRepository(Restaurant::class)->find($id);

        $restaurantManager->setRestaurant($restaurant);
        $annualBudgets = $restaurantManager->getAllPlannedBudgets();

        return $this->render('restaurants/budget.html.twig', [
            'currentMenuActive' => [
                'menu.restaurant.'.$id,
                'menu.restaurant.'.$id.'.budget'
            ],
            'restaurant' => $restaurant,
            'annualBudgets' => $annualBudgets
        ]);
    }

    /**
     * @Route("/sales/{id}/{year}/{month}", name="restaurant_daily_sales", defaults={"year"=null, "month"=null})
     */
    public function dailySalesAction(Request $request, $id, $year, $month, Security $securityService, SalesManager $salesManager)
    {
        $checkerResult = $this->checkUserAccess($id, $securityService);
        if ($checkerResult instanceof RedirectResponse)
            return $checkerResult;

        $dm = $this->get('doctrine_mongodb')->getManager();
        /**
         * @var Restaurant $restaurant
         */
        $restaurant = $dm->getRepository(Restaurant::class)->find($id);

        $monthlySales = $salesManager->prepareMonth($restaurant, $year, $month);
        $form = $this->createForm(MonthlySalesType::class, $monthlySales);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var MonthlySales $monthlySales
             */
            $monthlySales = $form->getData();
            foreach ($monthlySales->getDailySales() as $dailySale) {
                $dm->persist($dailySale);
            }
            $dm->flush();

            $this->addFlash('success', 'restaurant.daily_sales.update.success');

            return $this->redirectToRoute('restaurant_daily_sales', ['id' => $id, 'year' => $year, 'month' => $month]);
        }

        return $this->render('restaurants/daily_sales.html.twig', [
            'currentMenuActive' => [
                'menu.restaurant.'.$id,
                'menu.restaurant.'.$id.'.daily_sales'
            ],
            'restaurant' => $restaurant,
            'year' => $year,
            'month' => $month,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/track/{id}", name="restaurant_track_sales")
     */
    public function trackAction($id, Security $securityService)
    {
        $checkerResult = $this->checkUserAccess($id, $securityService);
        if ($checkerResult instanceof RedirectResponse)
            return $checkerResult;

        $dm = $this->get('doctrine_mongodb')->getManager();
        $restaurant = $dm->getRepository(Restaurant::class)->find($id);

        return $this->render('restaurants/track.html.twig', [
            'currentMenuActive' => [
                'menu.restaurant.'.$id,
                'menu.restaurant.'.$id.'.track_sales'
            ],
            'restaurant' => $restaurant
        ]);
    }






    private function checkUserAccess($restaurantId, Security $securityService)
    {
        try{
            $securityService->checkUserAccessToRestaurant($restaurantId);
        } catch(AccessDeniedException $e) {
            $this->addFlash('error', $e->getMessage());
            return $this->redirectToRoute('homepage');
        }
        return true;
    }
}
