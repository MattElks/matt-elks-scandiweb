<?php

namespace App\View\AddView;

use Exception;

class ProductAdd
{
    public static function renderAdd()
    {
        //Render header
        try {
            if (file_exists(__DIR__ . "/../templates/add/header_add.html")) {
                include __DIR__ . "/../templates/add/header_add.html";
            } else {
                throw new Exception("header_add.html could not be found");
            }
        } catch (Exception $e) {
            echo "Exception caught: " . $e->getMessage();
        }

        //Render Main
        try {
            if (file_exists(__DIR__ . "/../templates/add/main_add.html")) {
                include __DIR__ . "/../templates/add/main_add.html";
            } else {
                throw new Exception("main_add.html could not be found");
            }
        } catch (Exception $e) {
            echo "Exception caught: " . $e->getMessage();
        }
        //Render Footer
        try {
            if (file_exists(__DIR__ . "/../templates/add/footer.html")) {
                include __DIR__ . "/../templates/add/footer.html";
            } else {
                throw new Exception("footer.html could not be found");
            }
        } catch (Exception $e) {
            echo "Exception caught: " . $e->getMessage();
        }
    }
}
