<?php

namespace AppBundle\Controller;

use AppBundle\Document\MarketRank;
use AppBundle\Document\SouthEst;
use AppBundle\Form\MarketRankType;
use AppBundle\Form\SouthEstType;
use AppBundle\Services\Utils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SupervisorSouthEstController
 * @package AppBundle\Controller
 * @Route("/supervisor")
 */
class SupervisorController extends BaseController
{
    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/south_est/{year}/{id}", name="supervisor_south_est", defaults={"year"=null, "id"=null})
     */
    public function southEstIndexAction(Request $request, $year, $id, Utils $utils)
    {
        if (null === $year)
            $year = strftime('%Y', time());

        $dm = $this->get('doctrine_mongodb')->getManager();
        if (null == $id) {
            $entry = $dm->getRepository(SouthEst::class)->findOneBy([
                'year' => (int)$year
            ]);

            if (!$entry) {
                $entry = new SouthEst();
                $entry->setYear($year);

                for ($i=1; $i<=12; $i++) {
                    $entry->addMonth($i, 0);
                }

                for ($i=1; $i<=52; $i++) {
                    $entry->addWeek($i, 0);
                }

                $dm->persist($entry);
                $dm->flush();
                $dm->refresh($entry);
            }
        } else {
            $entry = $dm->getRepository(SouthEst::class)->find($id);
        }

        $form = $this->createForm(SouthEstType::class, $entry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entry = $form->getData();

            $dm->persist($entry);
            $dm->flush();

            $this->addFlash('success', 'supervisor.south_est.update.success');

            return $this->redirectToRoute('supervisor_south_est', ['id' => $entry->getId(), 'year' => $year]);
        }

        $navigation = $utils->generateYearNavigation('supervisor_south_est', null, $year);

        return $this->render('supervisor/south_est/list.html.twig', [
            'currentMenuActive' => [
                'menu.supervisor.south_est'
            ],
            'navigation' => $navigation,
            'year' => $year,
            'form' => $form->createView(),
            'entry' => $entry
        ]);
    }

    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/market_rank/{year}/{id}", name="supervisor_market_rank", defaults={"year"=null, "id"=null})
     */
    public function marketRankIndexAction(Request $request, $year, $id, Utils $utils)
    {
        if (null === $year)
            $year = strftime('%Y', time());

        $dm = $this->get('doctrine_mongodb')->getManager();
        if (null == $id) {
            $entry = $dm->getRepository(MarketRank::class)->findOneBy([
                'year' => (int)$year
            ]);

            if (!$entry) {
                $entry = new MarketRank();
                $entry->setYear($year);

                for ($i=1; $i<=12; $i++) {
                    $entry->addMonth($i, 0);
                }

                $dm->persist($entry);
                $dm->flush();
                $dm->refresh($entry);
            }
        } else {
            $entry = $dm->getRepository(MarketRank::class)->find($id);
        }

        $form = $this->createForm(MarketRankType::class, $entry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entry = $form->getData();

            $dm->persist($entry);
            $dm->flush();

            $this->addFlash('success', 'supervisor.market_rank.update.success');

            return $this->redirectToRoute('supervisor_market_rank', ['id' => $entry->getId(), 'year' => $year]);
        }

        $navigation = $utils->generateYearNavigation('supervisor_market_rank', null, $year);

        return $this->render('supervisor/market_rank/list.html.twig', [
            'currentMenuActive' => [
                'menu.supervisor.market_rank'
            ],
            'navigation' => $navigation,
            'year' => $year,
            'form' => $form->createView(),
            'entry' => $entry
        ]);
    }
}
