<?php

namespace AppBundle\Services;

use AppBundle\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class Security
{
    /**
     * @var DocumentManager
     */
    private $dm;
    /**
     * @var AuthorizationCheckerInterface
     */
    private $checker;
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * Security constructor.
     * @param DocumentManager $dm
     * @param AuthorizationCheckerInterface $checker
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(DocumentManager $dm, AuthorizationCheckerInterface $checker, TokenStorageInterface $tokenStorage)
    {
        $this->dm = $dm;
        $this->checker = $checker;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return \AppBundle\Document\Restaurant[]|array
     */
    public function getUserRestaurants()
    {
        // Get if possible, restaurants that the current user belong to
        $user = $this->getUser();
        if (empty($user))
            return [];

        if ($this->checker->isGranted('ROLE_SUPERVISOR') || !$user instanceof User) {
            $restaurants = $this->dm->getRepository('AppBundle:Restaurant')
                ->findBy(
                    [],
                    ['name' => 'ASC']
                );
        } else {
            $restaurants = $user->getRestaurants();
        }

        return $restaurants;
    }

    /**
     * @param $restaurantId
     * @return bool|AccessDeniedException
     */
    public function checkUserAccessToRestaurant($restaurantId)
    {
        $userRestaurants = $this->getUserRestaurants();
        foreach ($userRestaurants as $restaurant) {
            if ($restaurant->getId() == $restaurantId)
                return true;
        }
        throw new AccessDeniedException('exception.access.restaurant');
    }

    /**
     * @return User|null
     */
    private function getUser()
    {
        if (null === $token = $this->tokenStorage->getToken()) {
            return null;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return null;
        }

        return $user;
    }
}