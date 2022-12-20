<?php

namespace App\Models\ProductTypes;

use App\Models\ProductTypes\Product;

class Furniture extends Product
{
    protected function validateValue()
    {
        $this->value = 'Dimensions: ' . $this->productInfo['height'] . 'x' . $this->productInfo['width'] . 'x' . $this->productInfo['length'] . ' CM';
        return true;
    }
}
