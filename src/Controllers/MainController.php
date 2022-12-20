<?php

namespace App\Controllers;

use App\Core\Database;
use App\View\AddView\ProductAdd;
use App\View\ListView\ProductDisplay;

class MainController
{

    public static function index()
    {
        $db = new Database();
        ProductDisplay::renderProducts([

            'products' => $db->getProducts()
        ]);
    }

    public static function create()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productInfo = [];
            foreach ($_POST as $key => $value) {
                $productInfo[$key] = $value;
            }

            // is equal to a class > Book, DVD, Furniture. 
            $className = "App\\Models\\ProductTypes\\" . $_POST['type'];
            if (class_exists($className)) {
                $newProduct = new $className($productInfo);
            }
            $valid = $newProduct->validateProduct();
            if (!in_array(false, $valid)) {
                $db = new Database();
                $db->createProduct($newProduct);
                header('Location: /');
                exit;
            }
        }
        ProductAdd::renderAdd();
    }


    public static function read()
    {
        header('Content-Type: application/json');
        $db = new Database();
        echo json_encode($db->getProducts());
    }

    public static function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $db = new Database();

            $productInfo = [];
            foreach ($_POST as $key => $value) {
                $productInfo[$key] = $value;
            }
            foreach ($_POST as $key => $value) {

                $db->deleteProduct($key);
            }
        }
        header('Location: /');
    }
}
