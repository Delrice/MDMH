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
use AppBundle\Services\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\TranslatorInterface;

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
     * @Route("/budgets/{id}/{year}", name="restaurant_budgets", defaults={"year"=null})
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

    /**
     * @Route("/sales/{id}/{year}/{month}", name="restaurant_daily_sales", defaults={"year"=null, "month"=null})
     */
    public function dailySalesAction(Request $request, $id, $year, $month, Security $securityService, SalesManager $salesManager, Utils $utils)
    {
        $checkerResult = $this->checkUserAccess($id, $securityService);
        if ($checkerResult instanceof RedirectResponse)
            return $checkerResult;

        $dm = $this->get('doctrine_mongodb')->getManager();
        /**
         * @var Restaurant $restaurant
         */
        $restaurant = $dm->getRepository(Restaurant::class)->find($id);
        $salesManager->setRestaurant($restaurant);

        if (null === $year)
            $year = strftime('%Y', time());

        if (null === $month)
            $month = strftime('%m', time());

        $monthlySales = $salesManager->prepareMonth($year, $month);
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

        $navigation = $utils->generateMonthNavigation('restaurant_daily_sales', $id, $year, $month);

        return $this->render('restaurants/daily_sales.html.twig', [
            'currentMenuActive' => [
                'menu.restaurant.'.$id,
                'menu.restaurant.'.$id.'.daily_sales'
            ],
            'restaurant' => $restaurant,
            'year' => $year,
            'month' => $month,
            'navigation' => $navigation,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/track/daily/{id}/{year}/{month}", name="restaurant_track_dailysales", defaults={"year"=null, "month"=null})
     */
    public function trackDailySalesAction(Request $request, $id, $year, $month, Security $securityService, SalesManager $salesManager, Utils $utils)
    {
        $checkerResult = $this->checkUserAccess($id, $securityService);
        if ($checkerResult instanceof RedirectResponse)
            return $checkerResult;

        $dm = $this->get('doctrine_mongodb')->getManager();
        /**
         * @var Restaurant $restaurant
         */
        $restaurant = $dm->getRepository(Restaurant::class)->find($id);
        $salesManager->setRestaurant($restaurant);

        if (null === $year)
            $year = strftime('%Y', time());

        if (null === $month)
            $month = strftime('%m', time());

        $trackingDailySales = $salesManager->trackDailySales($year, $month);

        $navigation = $utils->generateMonthNavigation('restaurant_track_dailysales', $id, $year, $month);

        return $this->render('restaurants/track_dailysales.html.twig', [
            'currentMenuActive' => [
                'menu.restaurant.'.$id,
                'menu.restaurant.'.$id.'.track_dailysales'
            ],
            'restaurant' => $restaurant,
            'navigation' => $navigation,
            'elements' => $trackingDailySales,
            'cYear' => $year,
            'pYear' => $year - 1
        ]);
    }

    /**
     * @Route("/track/globaldaily/{year}/{month}", name="restaurant_track_global_dailysales", defaults={"year"=null, "month"=null})
     */
    public function trackGlobalDailySalesAction(Request $request, $year, $month, Security $securityService, SalesManager $salesManager, Utils $utils)
    {
        if (null === $year)
            $year = strftime('%Y', time());

        if (null === $month)
            $month = strftime('%m', time());

        $trackingDailySales = $salesManager->trackDailySales($year, $month);

        $navigation = $utils->generateMonthNavigation('restaurant_track_global_dailysales', null, $year, $month);

        return $this->render('restaurants/track_global_dailysales.html.twig', [
            'currentMenuActive' => [
                'menu.supervisor.track_dailysales'
            ],
            'navigation' => $navigation,
            'elements' => $trackingDailySales,
            'cYear' => $year,
            'pYear' => $year - 1
        ]);
    }

    /**
     * @Route("/track/weekly/{id}/{year}", name="restaurant_track_weeklysales", defaults={"year"=null})
     */
    public function trackWeeklySalesAction(Request $request, $id, $year, Security $securityService, SalesManager $salesManager, Utils $utils)
    {
        $checkerResult = $this->checkUserAccess($id, $securityService);
        if ($checkerResult instanceof RedirectResponse)
            return $checkerResult;

        $dm = $this->get('doctrine_mongodb')->getManager();
        /**
         * @var Restaurant $restaurant
         */
        $restaurant = $dm->getRepository(Restaurant::class)->find($id);
        $salesManager->setRestaurant($restaurant);

        if (null === $year)
            $year = strftime('%Y', time());

        $trackingWeeklySales = $salesManager->trackWeeklySales($year);

        $navigation = $utils->generateYearNavigation('restaurant_track_weeklysales', $id, $year);

        return $this->render('restaurants/track_weeklysales.html.twig', [
            'currentMenuActive' => [
                'menu.restaurant.'.$id,
                'menu.restaurant.'.$id.'.track_weeklysales'
            ],
            'restaurant' => $restaurant,
            'navigation' => $navigation,
            'elements' => $trackingWeeklySales,
            'cYear' => $year,
            'pYear1' => $year - 1,
            'pYear2' => $year - 2,
            'pYear3' => $year - 3
        ]);
    }

    /**
     * @Route("/track/globalweekly/{year}", name="restaurant_track_global_weeklysales", defaults={"year"=null})
     */
    public function trackGlobalWeeklySalesAction(Request $request, $year, Security $securityService, SalesManager $salesManager, Utils $utils)
    {
        if (null === $year)
            $year = strftime('%Y', time());

        $trackingWeeklySales = $salesManager->trackWeeklySales($year);

        $navigation = $utils->generateYearNavigation('restaurant_track_global_weeklysales', null, $year);

        return $this->render('restaurants/track_global_weeklysales.html.twig', [
            'currentMenuActive' => [
                'menu.supervisor.track_weeklysales'
            ],
            'navigation' => $navigation,
            'elements' => $trackingWeeklySales,
            'cYear' => $year,
            'pYear1' => $year - 1,
            'pYear2' => $year - 2,
            'pYear3' => $year - 3
        ]);
    }

    /**
     * @param $restaurantId
     * @param Security $securityService
     * @return bool|RedirectResponse
     */
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
