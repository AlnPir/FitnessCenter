<?php

namespace App\Controller\Admin;

use App\Entity\Equipment;
use App\Form\EquipmentType;
use App\Repository\EquipmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminEquipmentController extends AbstractController
{

    /**
     * @var EquipmentRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;


    public function __construct(EquipmentRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/equipements", name="admin.equipment.index")
     * @return Response
     */
    public function index(): Response
    {
        $equipments = $this->repository->findAll();
        return $this->render('admin/equipment/index.html.twig', compact('equipments'));
    }

    /**
     * @Route("/admin/equipements/new", name="admin.equipment.new")
     * @return Response
     */
    public function new(Request $request): Response
    {
        $equipment = new Equipment();
        $form = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($equipment);
            $this->em->flush();
            $this->addFlash('success', 'equipement créée avec succès');

            return $this->redirectToRoute('admin.equipment.index');
        }

        return $this->render('admin/equipment/new.html.twig', [
            'equipment' => $equipment,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/equipements/{id}  ", name="admin.equipment.edit", methods="GET|POST")
     * @param Equipment $equipment
     * @param Request $request
     * @return Response
     */
    public function edit(Equipment $equipment, Request $request): Response
    {
        $form = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'equipement modifiée avec succès');
            return $this->redirectToRoute('admin.equipment.index');
        }

        return $this->render('admin/equipment/edit.html.twig', [
            'equipment' => $equipment,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/equipements/{id}  ", name="admin.equipment.delete", methods="DELETE")
     * @param Equipment $equipment
     * @param Request $request
     * @return Response
     */
    public function delete(Equipment $equipment, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $equipment->getId(), $request->get('_token'))) {
            $this->em->remove($equipment);
            $this->em->flush();
            $this->addFlash('success', 'equipement supprimée avec succès');
            return $this->redirectToRoute('admin.equipment.index');
        }
    }
}