<?php

namespace App\Models\ProductTypes;

use App\Models\ProductTypes\Product;

class Book extends Product
{
    protected function setValue()
    {
        $this->value = 'Weight: ' . $this->productInfo['weight'] . ' KG';
        return "";
    }
};
