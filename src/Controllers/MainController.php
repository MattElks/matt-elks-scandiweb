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

    public static function addProduct()
    {

        ProductAdd::renderAdd();
    }

    /* public static function create()
    {
        //because POST is a superGlobal, it is accessable anywhere
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //create assoc array like this!!
            $productData = [];
            foreach ($_POST as $key => $value) {
                // assoc array created from POST method
                $productData[$key] = $value;
            }
            // is equal to a class > Book, DVD, Furniture. 
            // Uses namespace convention??
            $className = "app\\Models\\ProductTypes\\" . $_POST['type'];
            if (class_exists($className)) {
                //$cname refers to the exact class we want to instantiate
                //this way we can create a new object without knowing what it is beforehand

                //assoc array passed to new object
                $product = new $className($productData);
            }

            //$errors = $product->validateData();
            //data in the product has been been validated.
            // if (!$errors) {
            $db = new Database();
            //object passed to db
            //create product takes info
            $db->createProduct($product);
            //returns you to home page
            header('Location: /');
            exit;
            //}
        }

        ProductAdd::renderAdd();
    } */
}
