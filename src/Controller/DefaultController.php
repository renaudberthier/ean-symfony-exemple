<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    #[Route('/contact', name: 'app_contact', methods: 'GET|HEAD')]
    public function contact(): Response
    {
        return $this->render('default/contact.html.twig');
    }

    #[Route('/contact', name: 'app_save_contact', methods: 'POST')]
    public function save_contact(Request $request): Response
    {
        // Récupérer les données en POST
        $mail = $request->request->get('mail');
        $message = $request->request->get('message');
        // $donneeEnGet = $request->query->get('donneeEnGet', 'valeurParDefaut');

        // TODO Sauvegarder en BDD

        // Redirection vers la page d'accueil
        return $this->redirectToRoute('app_default');
    }

    #[Route('/logo', name: 'app_logo', methods: 'GET|HEAD')]
    public function download(): Response
    {
        $path = $this->getParameter('app.uploads_dir') . 'logo_live_campus.png';
        return $this->file($path, 'logo.png', ResponseHeaderBag::DISPOSITION_INLINE);
    }

    #[Route('/upload', name: 'app_upload', methods: 'GET|HEAD')]
    public function upload(): Response
    {
        return $this->render('default/upload.html.twig');
    }

    #[Route('/upload', name: 'app_upload_create', methods: 'POST')]
    public function upload_create(Request $request): Response
    {
        $picture = $request->files->get('picture');
        $uploadsDir = $this->getParameter('app.uploads_dir');
        // $picture->getClientOriginalName() pour avoir le nom du fichier du client
        $fileName = time() . "." . $picture->guessExtension();
        $picture->move($uploadsDir, $fileName);

        // bin2hex(random_bytes(16));
        // uniqid md5
        return $this->file($uploadsDir . $fileName, $picture->getClientOriginalName(), ResponseHeaderBag::DISPOSITION_INLINE);
    }
}
