<?php


namespace App\Controller;

 use App\Entity\Offer;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OfferController extends AbstractController
{
    /**
//     * @Route("/offres", name="offer.index")
     * @param OfferRepository $repository
     * @return Response
     */
    public function index(OfferRepository $repository): Response
    {
        $offers = $repository->findAll();
        return $this->render('pages/offer/index.html.twig', [
            'current_menu' => 'offers',
            'offers' => $offers
        ]);
    }

    /**
     * @Route("/offres/{slug}-{id}", name="offer.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Offer $offer
     * @return Response
     */
    public function show(Offer $offer, string $slug): Response
    {
        if ($offer->getSlug() !== $slug) {
            return $this->redirectToRoute('pages/offer/show.html.twig', [
                'id' => $offer->getId(),
                'slug' => $offer->getSlug()
            ], 301);
        }

        return $this->render('pages/offer/show.html.twig', [
            'offer' => $offer,
            'current_menu' => 'offers'
        ]);
    }
}