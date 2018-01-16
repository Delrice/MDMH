<?php

namespace AppBundle\Controller;

use AppBundle\Document\Restaurant;
use AppBundle\Manager\SalesManager;
use AppBundle\Services\Security;
use AppBundle\Services\Utils;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class WeeklySalesController
 * @package AppBundle\Controller
 * @Route("/restaurants")
 */
class WeeklySalesController extends BaseController
{
    /**
     * @Route("/track/weekly/{id}/{year}", name="restaurant_track_weeklysales", defaults={"year"=null})
     */
    public function trackWeeklySalesAction($id, $year, Security $securityService, SalesManager $salesManager, Utils $utils)
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
    public function trackGlobalWeeklySalesAction($year, SalesManager $salesManager, Utils $utils)
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

}
