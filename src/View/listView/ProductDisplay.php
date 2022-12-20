<?php

namespace App\View\ListView;

use App\Models\Template\Template;
use Exception;

class ProductDisplay
{
    public static function renderProducts($params)
    {

        try {
            if (file_exists(__DIR__ . "/../templates/list/header_list.html")) {
                include __DIR__ . "/../templates/list/header_list.html";
            } else {
                throw new Exception("header_list.html could not be found");
            }
        } catch (Exception $e) {
            echo "Exception caught: " . $e->getMessage();
        }

        foreach ($params as $product) {

            foreach ($product as $result) {
                $template_body = new Template();
                $template_body->file = __DIR__ . "/../templates/list/main_list.html";
                foreach ($result as $key => $value) {
                    $template_body->set($key, $value);
                }
                $template_body->display();
            }
        }

        try {
            if (file_exists(__DIR__ . "/../templates/list/footer_list.html")) {
                include __DIR__ . "/../templates/list/footer_list.html";
            } else {
                throw new Exception("footer.html could not be found");
            }
        } catch (Exception $e) {
            echo "Exception caught: " . $e->getMessage();
        }
    }
}
