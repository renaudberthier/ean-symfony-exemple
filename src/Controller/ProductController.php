<?php

namespace App\Controller;

use App\Repository\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        //$products = Products::getAllProducts();

        $products = [
            [
                "name" => "Une table",
                "price" => 20.05,
                "slug" => "une-table"
            ],
            [
                "name" => "Une autre table",
                "price" => 40.12,
                "slug" => "une-autre-table"
            ]
        ];
        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/product/{index}-{slug}', name: 'app_product_single')]
    public function view(int $index, string $slug) : Response {
        $products = [
            [
                "name" => "Une table",
                "price" => 20.05,
                "slug" => "une-table"
            ],
            [
                "name" => "Une autre table",
                "price" => 40.12,
                "slug" => "une-autre-table"
            ]
        ];


        $product = $products[$index] ?? null;
        if(!$product) {
            throw $this->createNotFoundException();
        }
        return $this->render('product/single.html.twig', [
            'product' => $product,
        ]);
    }
}
