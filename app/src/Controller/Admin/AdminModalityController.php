<?php

namespace App\Controller\Admin;

use App\Entity\Modality;
use App\Form\ModalityType;
use App\Repository\ModalityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminModalityController extends AbstractController
{

    /**
     * @var ModalityRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;


    public function __construct(ModalityRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/modalites", name="admin.modality.index")
     * @return Response
     */
    public function index(): Response
    {
        $modalities = $this->repository->findAll();
        return $this->render('admin/modality/index.html.twig', compact('modalities'));
    }

    /**
     * @Route("/admin/modalites/new", name="admin.modality.new")
     * @return Response
     */
    public function new(Request $request): Response
    {
        $modality = new Modality();
        $form = $this->createForm(ModalityType::class, $modality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($modality);
            $this->em->flush();
            $this->addFlash('success', 'modalite créée avec succès');

            return $this->redirectToRoute('admin.modality.index');
        }

        return $this->render('admin/modality/new.html.twig', [
            'modality' => $modality,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/modalites/{id}  ", name="admin.modality.edit", methods="GET|POST")
     * @param Modality $modality
     * @param Request $request
     * @return Response
     */
    public function edit(Modality $modality, Request $request): Response
    {
        $form = $this->createForm(ModalityType::class, $modality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'modalite modifiée avec succès');
            return $this->redirectToRoute('admin.modality.index');
        }

        return $this->render('admin/modality/edit.html.twig', [
            'modality' => $modality,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/modalites/{id}  ", name="admin.modality.delete", methods="DELETE")
     * @param Modality $modality
     * @param Request $request
     * @return Response
     */
    public function delete(Modality $modality, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $modality->getId(), $request->get('_token'))) {
            $this->em->remove($modality);
            $this->em->flush();
            $this->addFlash('success', 'modalite supprimée avec succès');
            return $this->redirectToRoute('admin.modality.index');
        }
    }
}