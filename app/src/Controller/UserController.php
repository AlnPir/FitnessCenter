<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\EnduranceRepository;
use App\Repository\StrenghtRepository;
use App\Repository\SubscriptionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;


    public function __construct(UserRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/profile", name="profile.home")
     * @return Response
     */
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('profile/home.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/newUser  ", name="pages.newUser")
     * @return Response
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success', 'Property created with success');

            return $this->redirectToRoute('login');
        }

        return $this->render('pages/newUser.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

}