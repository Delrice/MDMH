<?php

namespace AppBundle\Controller;

use AppBundle\Document\MarketRank;
use AppBundle\Document\Restaurant;
use AppBundle\Form\MarketRankType;
use AppBundle\Services\Utils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MarketRankController
 * @package AppBundle\Controller
 */
class MarketRankController extends BaseController
{
    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/restaurants/market_rank/{id}/{year}/{mrId}", name="restaurant_market_rank", defaults={"year"=null, "mrId"=null})
     */
    public function marketRankIndexAction(Request $request, $id, $year, $mrId, Utils $utils)
    {
        if (null === $year)
            $year = strftime('%Y', time());

        $dm = $this->get('doctrine_mongodb')->getManager();

        $restaurant = $dm->getRepository(Restaurant::class)->find($id);

        if (null == $mrId) {
            $entry = $dm->getRepository(MarketRank::class)->findOneBy([
                'year' => (int)$year,
                'restaurant' => $restaurant
            ]);

            if (!$entry) {
                $entry = new MarketRank($restaurant);
                $entry->setYear($year);

                for ($i=1; $i<=12; $i++) {
                    $entry->addMonth($i, 0);
                }

                $dm->persist($entry);
                $dm->flush();
                $dm->refresh($entry);
            }
        } else {
            $entry = $dm->getRepository(MarketRank::class)->find($mrId);
        }

        $form = $this->createForm(MarketRankType::class, $entry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entry = $form->getData();

            $dm->persist($entry);
            $dm->flush();

            $this->addFlash('success', 'restaurant.market_rank.update.success');

            return $this->redirectToRoute('restaurant_market_rank', ['id' => $id, 'year' => $year, 'mrId' => $entry->getId()]);
        }

        $navigation = $utils->generateYearNavigation('restaurant_market_rank', $id, $year);

        return $this->render('restaurants/market_rank/list.html.twig', [
            'currentMenuActive' => [
                'menu.restaurant.'.$id,
                'menu.restaurant.'.$id.'.market_rank'
            ],
            'navigation' => $navigation,
            'year' => $year,
            'form' => $form->createView(),
            'entry' => $entry,
            'restaurant' => $restaurant
        ]);
    }
}
