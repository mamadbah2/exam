<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'classe.index')]
    public function index(ClasseRepository $classeRepository): Response
    {
        $classes = $classeRepository->findAll();
        return $this->render('classe/index.html.twig', [
            'classes' => $classes,
        ]);
    }

    #[Route('/classe/create', name: 'classe.create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($classe);
            $em->flush();
            return $this->redirectToRoute('classe.index');
        }
        return $this->render('classe/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
