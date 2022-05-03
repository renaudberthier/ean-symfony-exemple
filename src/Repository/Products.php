<?php
namespace App\Repository;

class Products {
    private static $products = [
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

    public static function getAllProducts() {
        return self::$products;
    }

    public static function getProduct($index) {
        return self::$products[$index] ?? null;
    }

    public static function addProduct($product) {
        self::$products[] = $product;
    }

    public static function updateProduct($index, $product) {
        if(isset(self::$products[$index])) {
            self::$products[$index] = $product;
        }
    }

    public static function removeProduct($index) {
        if(isset(self::$products[$index])) {
            unset(self::$products[$index]);
        }
    }

    public static function searchProducts($search) {
        $results = [];
        foreach(self::$products as $product) {
            if(str_contains($product['name'], $search)) {
                $results[] = $product;
            }
        }
        return $results;
    }
}