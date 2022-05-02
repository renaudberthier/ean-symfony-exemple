<?php

namespace App\Controller;
// Espace de noms
// "Dossier virtuel" pour votre fichier
// Signifie que ce fichier (donc la classe HelloWorldController)
// est placé dans App\Controller
// Son nom complet est donc App\Controller\HelloWorldController

// Importer des classes dans d'autres namespaces
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController extends AbstractController
{
    #[Route('/toto', name: 'app_hello_world')]
    public function index(): Response
    {
        // Imaginons qu'on récupère ça de la BDD
        $toto = [
            "firstname" => "John",
            "lastname" => "Doe"
        ];
        return $this->render('hello_world/index.html.twig', [
            "user" => $toto
        ]);
    }
}
