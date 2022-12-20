<?php

namespace App\Models\ProductTypes;

use App\Models\ProductTypes\Product;

class DVD extends Product
{
    protected function validateValue()
    {
        $this->value = 'Size: ' . $this->productInfo['size'] . ' MB';
        return true;
    }
}
