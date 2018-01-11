<?php

namespace AppBundle\Controller;

use AppBundle\Services\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class BaseController extends Controller
{
    /**
     * @param $restaurantId
     * @param Security $securityService
     * @return bool|RedirectResponse
     */
    public function checkUserAccess($restaurantId, Security $securityService)
    {
        try{
            $securityService->checkUserAccessToRestaurant($restaurantId);
        } catch(AccessDeniedException $e) {
            $this->addFlash('error', $e->getMessage());
            return $this->redirectToRoute('homepage');
        }
        return true;
    }
}
