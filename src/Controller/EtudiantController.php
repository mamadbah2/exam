<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant/{id}', name: 'etudiant.show')]
    public function show(EtudiantRepository $etudiantRepository, Etudiant $etudiant): Response
    {
        return $this->render('etudiant/index.html.twig', [
            'etudiant' => $etudiant,
        ]);
    }
}
