<?php


namespace App\Controller;

use App\Repository\EnduranceRepository;
use App\Repository\StrenghtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WorkoutController extends AbstractController
{

    /**
     * @Route("/profile/workout", name="profile.workout.index")
     * @param StrenghtRepository $strenghtRepository
     * @param EnduranceRepository $enduranceRepository
     * @return Response
     */
    public function index(StrenghtRepository $strenghtRepository, EnduranceRepository $enduranceRepository): Response
    {
        $user = $this->getUser();
        $strenghts = $strenghtRepository->findAllJoinedToUser($user->getId());
        $endurances = $enduranceRepository->findAllJoinedToUser($user->getId());

        return $this->render('profile/workout/index.html.twig', [
            'user' => $user,
            'strenghts' => $strenghts,
            'endurances' => $endurances
        ]);
    }
}