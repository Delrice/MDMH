<?php

namespace AppBundle\Controller;

use AppBundle\Document\Restaurant;
use AppBundle\Manager\SalesManager;
use AppBundle\Services\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MonthlySalesController
 * @package AppBundle\Controller
 * @Route("/restaurants")
 */
class MonthlySalesController extends BaseController
{
    /**
     * @Route("/track/monthly/{id}", name="restaurant_track_monthlysales")
     */
    public function trackMonthlySalesAction($id, Security $securityService, SalesManager $salesManager)
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

        $trackingMonthlySales = $salesManager->trackMonthlySales();

        return $this->render('restaurants/track_monthlysales.html.twig', [
            'currentMenuActive' => [
                'menu.restaurant.'.$id,
                'menu.restaurant.'.$id.'.track_monthlysales'
            ],
            'restaurant' => $restaurant,
            'elements' => $trackingMonthlySales
        ]);
    }

    /**
     * @Route("/track/globalmonthly", name="restaurant_track_global_monthlysales")
     */
    public function trackGlobalMonthlySalesAction(SalesManager $salesManager)
    {
        $trackingMonthlySales = $salesManager->trackGlobalMonthlySales();

        return $this->render('restaurants/track_global_monthlysales.html.twig', [
            'currentMenuActive' => [
                'menu.supervisor.track_monthlysales'
            ],
            'elements' => $trackingMonthlySales
        ]);
    }
}
