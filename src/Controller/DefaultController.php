<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    #[Route('/contact', name: 'app_contact', methods:'GET|HEAD')]
    public function contact(): Response
    {
        return $this->render('default/contact.html.twig');
    }

    #[Route('/contact', name: 'app_save_contact', methods: 'POST')]
    public function save_contact(Request $request) : Response {
        // Récupérer les données en POST
        $mail = $request->request->get('mail');
        $message = $request->request->get('message');
        // $donneeEnGet = $request->query->get('donneeEnGet', 'valeurParDefaut');

        // TODO Sauvegarder en BDD

        // Redirection vers la page d'accueil
        return $this->redirectToRoute('app_default');
    }
}
