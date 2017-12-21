<?php

namespace AppBundle\Controller;

use AppBundle\Document\User;
use AppBundle\Form\UserCreationType;
use AppBundle\Form\UserEditionType;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserController
 * @package AppBundle\Controller
 * @Route("/users")
 */
class UserController extends Controller
{
    /**
     * @Route("/profile/{id}", name="user_profile", defaults={"id": null})
     *
     */
    public function profileAction(Request $request, $id, UserPasswordEncoderInterface $encoder)
    {
        if (null === $id) {
            $user = $this->getUser();
        } else {
            $user = $this->get('doctrine_mongodb')->getManager()->getRepository(User::class)->find($id);
        }

        $form = $this->createForm(UserEditionType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * @var User $user
             */
            $user = $form->getData();
            if (!empty($user->getPlainPassword()))
                $user->setPassword($encoder->encodePassword($user, $user->getPlainPassword()));

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($user);
            $dm->flush();

            $this->addFlash('success', 'user.update.success');

            return $this->redirectToRoute('user_list');
        }

        return $this->render('users/edit.html.twig', [
            'form' => $form->createView(),
            'currentMenuActive' => ['administrator.users']
        ]);
    }

    /**
     * @Route("/", name="user_list")
     */
    public function listAction(Request $request)
    {
        $userList = $this->get('doctrine_mongodb')
            ->getRepository(User::class)
            ->findAll();

        return $this->render('users/list.html.twig', [
            'user_list' => $userList,
            'currentMenuActive' => ['administrator.users']
        ]);
    }

    /**
     * @Route("/new", name="user_new")
     */
    public function newAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(UserCreationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var User $user
             */
            $user = $form->getData();

            $user->setPassword($encoder->encodePassword($user, $user->getPlainPassword()));

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($user);
            $dm->flush();

            $this->addFlash('success', 'user.new.success');

            return $this->redirectToRoute('user_list');
        }

        return $this->render('users/create.html.twig', [
            'form' => $form->createView(),
            'currentMenuActive' => ['administrator.users']
        ]);
    }

    /**
     * @Route("/delete/{id}", name="user_delete")
     */
    public function deleteAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $user = $dm->getRepository(User::class)->find($id);
        $dm->remove($user);
        $dm->flush();

        $this->addFlash('success', 'user.delete.success');

        return $this->redirectToRoute('user_list');
    }
}
