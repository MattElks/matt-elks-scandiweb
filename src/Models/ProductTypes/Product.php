<?php

namespace App\Models\ProductTypes;

use App\Core\Database;

abstract class Product
{
    public $sku;
    public $name;
    public $price;
    public $type;
    public $value;
    public $productInfo = [];

    public function __construct($input)
    {
        $this->productInfo = $input;
        $this->name = $this->productInfo['name'];
        $this->price = $this->productInfo['price'];
        $this->type = $this->productInfo['type'];
    }

    public function validateProduct()
    {
        $this->validateSku();
        $this->setValue();
    }

    private function validateSku()
    {
        //create in db
        $db = new Database();
        if ($db->getSku($this->productInfo['sku'])) {
            return "SKU already taken!";
        } else {
            $this->sku = $this->productInfo['sku'];
        }
        return "";
    }

    abstract protected function setValue();
}
