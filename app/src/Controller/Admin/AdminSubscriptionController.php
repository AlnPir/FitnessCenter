<?php

namespace App\Controller\Admin;

use App\Entity\Subscription;
use App\Form\SubscriptionType;
use App\Repository\SubscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSubscriptionController extends AbstractController
{

    /**
     * @var SubscriptionRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;


    public function __construct(SubscriptionRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/abonnements", name="admin.subscription.index")
     * @return Response
     */
    public function index(): Response
    {
        $subscriptions = $this->repository->findAll();
        return $this->render('admin/subscription/index.html.twig', compact('subscriptions'));
    }

    /**
     * @Route("/admin/abonnements/new", name="admin.subscription.new")
     * @return Response
     */
    public function new(Request $request): Response
    {
        $subscription = new Subscription();
        $form = $this->createForm(SubscriptionType::class, $subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($subscription);
            $this->em->flush();
            $this->addFlash('success', 'abonnement créée avec succès');

            return $this->redirectToRoute('admin.subscription.index');
        }

        return $this->render('admin/subscription/new.html.twig', [
            'subscription' => $subscription,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/abonnements/{id}  ", name="admin.subscription.edit", methods="GET|POST")
     * @param Subscription $subscription
     * @param Request $request
     * @return Response
     */
    public function edit(Subscription $subscription, Request $request): Response
    {
        $form = $this->createForm(SubscriptionType::class, $subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'abonnement modifiée avec succès');
            return $this->redirectToRoute('admin.subscription.index');
        }

        return $this->render('admin/subscription/edit.html.twig', [
            'subscription' => $subscription,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/abonnements/{id}  ", name="admin.subscription.delete", methods="DELETE")
     * @param Subscription $subscription
     * @param Request $request
     * @return Response
     */
    public function delete(Subscription $subscription, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $subscription->getId(), $request->get('_token'))) {
            $this->em->remove($subscription);
            $this->em->flush();
            $this->addFlash('success', 'abonnement supprimée avec succès');
            return $this->redirectToRoute('admin.subscription.index');
        }
    }
}