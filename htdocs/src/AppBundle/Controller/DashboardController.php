<?php

namespace AppBundle\Controller;

use AppBundle\Document\Product;
use AppBundle\Services\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('dashboard/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    public function dailySalesAction(Request $request, Security $securityService)
    {
        $restaurants = $securityService->getUserRestaurants();
        return new Response();
        dump($restaurants);
        return $this->render('widgets/dailysales.html.twig', [
            'restaurants' => $restaurants
        ]);
    }
}
