<?php

namespace AppBundle\Controller;

use AppBundle\Document\Restaurant;
use AppBundle\Form\MonthlySalesType;
use AppBundle\Manager\SalesManager;
use AppBundle\Model\MonthlySales;
use AppBundle\Services\Security;
use AppBundle\Services\Utils;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DailySalesController
 * @package AppBundle\Controller
 * @Route("/restaurants")
 */
class DailySalesController extends BaseController
{
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

}
