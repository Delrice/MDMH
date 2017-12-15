<?php

namespace AppBundle\Controller;

use AppBundle\Document\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
//        $product = new Product();
//        $product->setName('A Foo Bar');
//        $product->setPrice('19.99');
//
//        $dm = $this->get('doctrine_mongodb')->getManager();
//        $dm->persist($product);
//        $dm->flush();

        // replace this example code with whatever you need
        return $this->render('dashboard/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
