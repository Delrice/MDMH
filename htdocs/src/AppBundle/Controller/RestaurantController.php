<?php

namespace AppBundle\Controller;

use AppBundle\Document\Restaurant;
use AppBundle\Form\RestaurantType;
use AppBundle\Manager\RestaurantManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RestaurantController
 * @package AppBundle\Controller
 * @Route("/restaurants")
 */
class RestaurantController extends BaseController
{
    /**
     * @Route("/", name="restaurant_list")
     */
    public function listAction()
    {
        $restaurantList = $this->get('doctrine_mongodb')
            ->getRepository(Restaurant::class)
            ->findAll();

        return $this->render('restaurants/list.html.twig', [
            'restaurant_list' => $restaurantList,
            'currentMenuActive' => ['administrator.restaurants']
        ]);
    }

    /**
     * @Route("/view/{id}", name="restaurant_view")
     */
    public function viewAction($id, RestaurantManager $restaurantManager)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $restaurant = $dm->getRepository(Restaurant::class)->find($id);

        $restaurantManager->setRestaurant($restaurant);
        $annualBudgets = $restaurantManager->getAllPlannedBudgets();

        return $this->render('restaurants/view.html.twig', [
            'restaurant' => $restaurant,
            'currentMenuActive' => ['menu.restaurant.'.$id],
            'annualBudgets' => $annualBudgets
        ]);
    }

    /**
     * @Route("/edit/{id}", name="restaurant_edit")
     *
     */
    public function editAction(Request $request, $id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $restaurant = $dm->getRepository(Restaurant::class)->find($id);

        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * @var Restaurant $restaurant
             */
            $restaurant = $form->getData();
            $dm->persist($restaurant);
            $dm->flush();

            $this->addFlash('success', 'restaurant.update.success');

            return $this->redirectToRoute('restaurant_list');
        }

        return $this->render('restaurants/edit.html.twig', [
            'form' => $form->createView(),
            'restaurant' => $restaurant,
            'currentMenuActive' => ['administrator.restaurants']
        ]);
    }

    /**
     * @Route("/new", name="restaurant_new")
     */
    public function newAction(Request $request)
    {
        $restaurant = new Restaurant();

        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Restaurant $restaurant
             */
            $restaurant = $form->getData();

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($restaurant);
            $dm->flush();

            $this->addFlash('success', 'restaurant.new.success');

            return $this->redirectToRoute('restaurant_list');
        }

        return $this->render('restaurants/create.html.twig', [
            'form' => $form->createView(),
            'currentMenuActive' => ['administrator.restaurants']
        ]);
    }

    /**
     * @Route("/delete/{id}", name="restaurant_delete")
     */
    public function deleteAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $restaurant = $dm->getRepository(Restaurant::class)->find($id);
        $dm->remove($restaurant);
        $dm->flush();

        $this->addFlash('success', 'restaurant.delete.success');

        return $this->redirectToRoute('restaurant_list');
    }
}
