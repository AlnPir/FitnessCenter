<?php

namespace App\Controller\Admin;

use App\Entity\Offer;
use App\Form\OfferType;
use App\Repository\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminOfferController extends AbstractController
{

    /**
     * @var OfferRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;


    public function __construct(OfferRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/offres", name="admin.offer.index")
     * @return Response
     */
    public function index(): Response
    {
        $offers = $this->repository->findAll();
        return $this->render('admin/offer/index.html.twig', compact('offers'));
    }

    /**
     * @Route("/admin/offres/new", name="admin.offer.new")
     * @return Response
     */
    public function new(Request $request): Response
    {
        $offer = new Offer();
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($offer);
            $this->em->flush();
            $this->addFlash('success', 'Offre créée avec succès');

            return $this->redirectToRoute('admin.offer.index');
        }

        return $this->render('admin/offer/new.html.twig', [
            'offer' => $offer,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/offres/{id}  ", name="admin.offer.edit", methods="GET|POST")
     * @param Offer $offer
     * @param Request $request
     * @return Response
     */
    public function edit(Offer $offer, Request $request): Response
    {
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Offre modifiée avec succès');
            return $this->redirectToRoute('admin.offer.index');
        }

        return $this->render('admin/offer/edit.html.twig', [
            'offer' => $offer,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/offres/{id}  ", name="admin.offer.delete", methods="DELETE")
     * @param Offer $offer
     * @param Request $request
     * @return Response
     */
    public function delete(Offer $offer, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $offer->getId(), $request->get('_token'))) {
            $this->em->remove($offer);
            $this->em->flush();
            $this->addFlash('success', 'Offre supprimée avec succès');
            return $this->redirectToRoute('admin.offer.index');
        }
    }
}