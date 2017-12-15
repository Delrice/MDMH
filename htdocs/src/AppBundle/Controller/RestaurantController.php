<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

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
        return $this->render('');
    }
}
