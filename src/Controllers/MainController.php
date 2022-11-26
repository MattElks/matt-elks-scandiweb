<?php

namespace App\Controllers;

use App\Core\Database;
use App\View\ListView\ProductDisplay;

class MainController
{
    //displays products from db and html temps
    public static function index()
    {
        $db = new Database();
        ProductDisplay::renderProducts([

            'products' => $db->getProducts()
        ]);
    }
}
