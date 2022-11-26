<?php

namespace App\View\listView;

use App\Models\Template\Template;
use Exception;

class ProductAdd
{
    public static function renderProducts($params = [])
    {
        //Render header
        try {
            if (file_exists("src/View/templates/add/header_add.html")) {
                include "src/View/templates/add/header_add.html";
            } else {
                throw new Exception("header_add.html could not be found");
            }
        } catch (Exception $e) {
            echo "Exception caught: " . $e->getMessage();
        }

        //Render Main
        try {
            if (file_exists("src/View/templates/add/main_add.html")) {
                include "src/View/templates/add/main_add.html";
            } else {
                throw new Exception("main_add.html could not be found");
            }
        } catch (Exception $e) {
            echo "Exception caught: " . $e->getMessage();
        }
        foreach ($params as $key => $value) {
            $template_body->set($key, $value);
        }
        $template_body->display();

        //ob_start();

        try {
            if (file_exists("src/View/templates/add/footer.html")) {
                include "src/View/templates/add/footer.html";
            } else {
                throw new Exception("footer.html could not be found");
            }
        } catch (Exception $e) {
            echo "Exception caught: " . $e->getMessage();
        }
    }
}
