<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CoursController extends AbstractController
{
    #[Route('/cours/classe/{id}', name: 'cours.index')]
    public function index(int $id, CoursRepository $coursRepository): Response
    {
        // Récupération des cours pour la classe $id
        $cours = $coursRepository->findBy(['classe' => $id]);
        
        return $this->render('cours/index.html.twig', [
            'cours' => $cours,

        ]);
    }

    #[Route('/cours/{id}', name: 'cours.show')]
    public function show(int $id, CoursRepository $coursRepository): Response
    {
        // Récupération du cours $id
        $cours = $coursRepository->find($id);
        return $this->render('cours/show.html.twig', [
            'cours' => $cours,
        ]);
    }

    #[Route('/cours/create', name: 'cours.create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $cours = new Cours();
        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($cours);
            $em->flush();
            return $this->redirectToRoute('cours.index', ['id' => $cours->getClasse()->getId()]);
        }
        // Formulaire de création de cours
        return $this->render('cours/create.html.twig', [
            'form' => $form,
        ]);
    }


}
