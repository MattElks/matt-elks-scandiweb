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
    }

    public function validateProduct()
    {
        $valid = [];
        //sku 
        if ($this->validateSku()) {
            $valid[] = $this->validateSku();
        }
        //name 
        if ($this->validateName()) {
            $valid[] = $this->validateName();
        }
        //price 
        if ($this->validatePrice()) {
            $valid[] = $this->validatePrice();
        }
        //type 
        if ($this->validateType()) {
            $valid[] = $this->validateType();
        }
        //value 
        if ($this->validateValue()) {
            $valid[] = $this->validateValue();
        }
        return $valid;
    }


    private function validateSku()
    {

        $db = new Database();
        if ($db->getSku($this->productInfo['sku'])) {
            return false;
        } else {
            $this->sku = $this->productInfo['sku'];
            return true;
        }
    }


    private function validateName()
    {
        if (!preg_match("/^[a-zA-Z]+( [a-zA-Z]+)*$/", $this->productInfo['name'])) {
            return false;
        } else {
            $this->name = $this->productInfo['name'];
            return true;
        }
    }
    private function validatePrice()
    {
        if ($this->productInfo['price'] < 0.01) {
            return false;
        } else {
            $this->price = $this->productInfo['price'];
            return true;
        }
    }
    private function validateType()
    {
        $products = ["Book", "DVD", "Furniture"];
        if (!in_array($this->productInfo['type'], $products)) {
            return false;
        } else {
            $this->type = $this->productInfo['type'];
            return true;
        }
    }
    abstract protected function validateValue();
}
