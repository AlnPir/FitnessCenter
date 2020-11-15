<?php


namespace App\Controller;

use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SubscriptionController extends AbstractController
{
    /**
     * @Route("/profile/subscriptions", name="profile.subscription.index")
     * @param SubscriptionRepository $subscriptionRepository
     * @return Response
     */
    public function index(SubscriptionRepository $subscriptionRepository): Response
    {
        $user = $this->getUser();
        $subscriptions = $subscriptionRepository->findAllJoinedToUser($user->getId());

        return $this->render('profile/subscription/index.html.twig', [
            'user' => $user,
            'subscriptions' => $subscriptions
        ]);
    }
}