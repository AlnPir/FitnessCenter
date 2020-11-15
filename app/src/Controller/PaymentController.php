<?php


namespace App\Controller;

use App\Repository\BankTransferRepository;
use App\Repository\CreditCardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{

    /**
     * @Route("/profile/payment", name="profile.payment.index")
     * @param CreditCardRepository $creditCardRepository
     * @param BankTransferRepository $bankTransferRepository
     * @return Response
     */
    public function index(CreditCardRepository $creditCardRepository, BankTransferRepository $bankTransferRepository): Response
    {
        $user = $this->getUser();
        $creditCards = $creditCardRepository->findAllJoinedToUser($user->getId());
        $bankTransfers = $bankTransferRepository->findAllJoinedToUser($user->getId());

        return $this->render('profile/payment/index.html.twig', [
            'user' => $user,
            'creditCards' => $creditCards,
            'bankTransfers' => $bankTransfers
        ]);
    }
}