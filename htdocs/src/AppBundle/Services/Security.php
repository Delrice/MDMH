<?php

namespace AppBundle\Services;

use AppBundle\Document\Restaurant;
use AppBundle\Document\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
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
     * @return ArrayCollection
     */
    public function getUserRestaurants()
    {
        // Get if possible, restaurants that the current user belong to
        $user = $this->getUser();
        if (empty($user))
            return new ArrayCollection();

        if ($this->checker->isGranted('ROLE_SUPERVISOR') || !$user instanceof User) {
            $collection = new ArrayCollection($this->dm->getRepository(Restaurant::class)->findAll());
        } else {
            $collection = new ArrayCollection($user->getRestaurants()->toArray());
        }
        /**
         * Sort all returned Restaurant[] in an ArrayCollection by "name"
         */
        $sort = Criteria::create();
        $sort->orderBy([
            'name' => Criteria::ASC
        ]);
        $restaurants = $collection->matching($sort);

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