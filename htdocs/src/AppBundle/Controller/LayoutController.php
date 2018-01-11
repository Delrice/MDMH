<?php

namespace AppBundle\Controller;

use AppBundle\Services\Security;

class LayoutController extends BaseController
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
