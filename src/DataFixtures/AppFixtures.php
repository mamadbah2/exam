<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use App\Entity\Cours;
use App\Entity\Etudiant;
use App\Entity\Professeur;
use App\Entity\Session;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création des professeurs
        $professeur1 = new Professeur();
        $professeur1->setNom('Dupont');
        $manager->persist($professeur1);

        $professeur2 = new Professeur();
        $professeur2->setNom('Martin');
        $manager->persist($professeur2);

        // Création des classes
        $classe1 = new Classe();
        $classe1->setIdClasse(1);
        $classe1->setNom('L2 INFO');
        $classe1->setNiveau('Licence');
        $manager->persist($classe1);

        $classe2 = new Classe();
        $classe2->setIdClasse(2);
        $classe2->setNom('L3 INFO');
        $classe2->setNiveau('Licence');
        $manager->persist($classe2);

        // Création des cours
        $cours1 = new Cours();
        $cours1->setProfesseurs($professeur1);
        $cours1->setModule('Programmation Web');
        $cours1->setClasse($classe1);
        $manager->persist($cours1);

        $cours2 = new Cours();
        $cours2->setProfesseurs($professeur2);
        $cours2->setModule('Base de données');
        $cours2->setClasse($classe2);
        $manager->persist($cours2);

        // Création des sessions
        $session1 = new Session();
        $session1->setDate(new DateTime('2024-01-15'));
        $session1->setHeureDebut(new DateTime('2024-01-15 08:00:00'));
        $session1->setHeureFin(new DateTime('2024-01-15 10:00:00'));
        $session1->setCours($cours1);
        $manager->persist($session1);

        $session2 = new Session();
        $session2->setDate(new DateTime('2024-01-16'));
        $session2->setHeureDebut(new DateTime('2024-01-16 14:00:00'));
        $session2->setHeureFin(new DateTime('2024-01-16 16:00:00'));
        $session2->setCours($cours1);
        $manager->persist($session2);

        // Création des étudiants
        $etudiant1 = new Etudiant();
        $etudiant1->setNom('Doe');
        $etudiant1->setClass($classe1);
        $manager->persist($etudiant1);

        $etudiant2 = new Etudiant();
        $etudiant2->setNom('Smith');
        $etudiant2->setClass($classe2);
        $manager->persist($etudiant2);

        $manager->flush();
    }
}