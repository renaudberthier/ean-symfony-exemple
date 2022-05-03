<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(UserRepository $userRepository): Response
    {
        // Get all users
        $users = $userRepository->findAll();
        return $this->render('user/index.html.twig', [
            "users" => $users
        ]);
    }

    #[Route('/user/{id}', name: 'app_user_single')]
    public function show(int $id, UserRepository $userRepository): Response
    {
        // Get a single user
        return new Response('TODO: ' . $id);
    }

    #[Route('/user/add', name: 'app_user_add', methods:'GET|HEAD')]
    public function add(): Response
    {
        return $this->render('user/add.html.twig');
    }

    #[Route('/user/add', name: 'app_user_create', methods:'POST')]
    public function create(Request $request, UserRepository $userRepository): Response
    {
        $firstname = $request->request->get('firstname');
        $lastname = $request->request->get('lastname');
        $age = $request->request->get('age');
        $birthDate = $request->request->get('birthDate');

        $user = new User();
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setAge($age);
        $user->setBirthDate(\DateTime::createFromFormat('Y-m-d', $birthDate));

        $userRepository->add($user);

        return $this->redirectToRoute('app_user');
    }
}
