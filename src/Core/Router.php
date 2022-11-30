<?php

namespace App\Core;

use App\Core\Database;

class Router
{


    private array $getRoutes = [];
    private array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {

        /*  echo "getRoutes: <br>";
        echo var_dump($this->getRoutes) . "<br>"; */

        $url = $_SERVER['REQUEST_URI'] ?? '/';

        /*  echo "url: <br>";
        echo var_dump($url) . "<br>"; */

        if (strpos($url, '?')) {

            $url = substr($url, 0, strpos($url, '?'));
        }

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        /*  echo "method: <br>";
        echo var_dump($method) . "<br>"; */

        if ($method === 'get') {
            $fn = $this->getRoutes[$url] ?? null;

            /* echo "func: <br>";
            echo var_dump($fn) . "<br>"; */
        } else {
            $fn = $this->postRoutes[$url] ?? null;
        }
        if ($fn) {
            call_user_func($fn);
        } else {
            echo "Page Not Found";
        }
    }
}
