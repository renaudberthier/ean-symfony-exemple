<?php

namespace App\Controller;

use App\Repository\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    // Route : Tout lister
    // Route : Afficher un produit
    // Route : Ajouter un produit
    // Route : Mettre à jour un produit
    // Route : Supprimer un produit
    // Bonus : Route : Rechercher un produit

    #[Route('/products', name: 'app_product')]
    public function index(): Response
    {
        $products = Products::getAllProducts();
        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/products/sub', name: 'app_product_sub')]
    public function index_sub(): Response
    {
        $products = Products::getAllProducts();
        return $this->render('product/index_sub.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/product/{index}-{slug}', name: 'app_product_single')]
    public function view(int $index, string $slug) : Response {
        $product = Products::getProduct($index);
        if(!$product) {
            throw $this->createNotFoundException();
        }
        return $this->render('product/single.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/product/add', name: 'app_product_add', methods:'GET|HEAD')]
    public function add() : Response {
        return $this->render('product/add.html.twig');
    }

    #[Route('/product/add', name: 'app_product_create', methods:'POST')]
    public function create(Request $request) : Response {
        $name = $request->request->get('name');
        $price = $request->request->get('price');
        $slug = $request->request->get('slug');

        Products::addProduct([
            "name" => $name,
            "price" => $price,
            "slug" => $slug
        ]);
        return $this->redirectToRoute('app_product');
    }
}
