<?php

namespace App\View\ListView;

use App\Models\Template\Template;
use Exception;

class ProductDisplay
{
    public static function renderProducts($params = [])
    {
        //Render header
        try {
            if (file_exists(__DIR__ . "/../templates/list/header_list.html")) {
                include __DIR__ . "/../templates/list/header_list.html";
            } else {
                throw new Exception("header_list.html could not be found");
            }
        } catch (Exception $e) {
            echo "Exception caught: " . $e->getMessage();
        }

        //Render Main
        $template_body = new Template();
        try {
            if (file_exists(__DIR__ . "/../templates/list/main_list.html")) {
                $template_body->file = __DIR__ . "/../templates/list/main_list.html";
            } else {
                throw new Exception("main_list.html could not be found");
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
            if (file_exists(__DIR__ . "/../templates/list/footer.html")) {
                include __DIR__ . "/../templates/list/footer.html";
            } else {
                throw new Exception("footer.html could not be found");
            }
        } catch (Exception $e) {
            echo "Exception caught: " . $e->getMessage();
        }
    }
}