<?php

namespace App\Models\ProductTypes;

use App\Models\ProductTypes\Product;

class Book extends Product
{
    protected function validateValue()
    {
        $this->value = 'Weight: ' . $this->productInfo['weight'] . ' KG';
        return true;
    }
};
