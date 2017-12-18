<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Services\Security;

class LayoutController extends Controller
{
    /**
     * @param $template
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sidebarMenuAction($template, Security $securityService)
    {
        $restaurants = $securityService->getUserRestaurants();

        return $this->render($template, [
            'restaurants' => $restaurants
        ]);
    }
}
