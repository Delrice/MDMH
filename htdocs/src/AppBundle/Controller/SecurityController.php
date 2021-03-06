<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends BaseController
{
    /**
     * @Route("/login", name="security_login")
     */
    public function loginAction(AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/login_check", name="security_login_check")
     * @throws AccessDeniedHttpException
     */
    public function loginCheckAction()
    {
        throw new AccessDeniedHttpException('May not be viewable !');
    }

    /**
     * @Route("/logout", name="security_logout")
     * @throws AccessDeniedHttpException
     */
    public function logoutAction()
    {
        throw new AccessDeniedHttpException('May not be viewable !');
    }
}
