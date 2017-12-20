<?php

namespace AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Services\Security;

class LayoutController extends Controller
{
    /**
     * @param $template
     * @param $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sidebarMenuAction($template, Security $securityService, $parameters=[])
    {
        $restaurants = $securityService->getUserRestaurants();

        return $this->render($template, [
            'restaurants' => $restaurants
        ]+$parameters);
    }
}
