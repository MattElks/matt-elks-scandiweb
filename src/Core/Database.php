<?php

namespace  App\Core;

class Database
{
    private $mysqli;

    function __construct()
    {
        $this->mysqli = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD);

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }

        $dbName = "scandiweb_db";
        $query = $this->mysqli->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'scandiweb_db';");
        $row = $query->fetch_row();
        if ($row[0] === "0") {

            //Create db
            $sqlDB = "CREATE DATABASE scandiweb_db";
            $this->mysqli->query($sqlDB);

            //Create Table
            $sqlTable = "CREATE TABLE IF NOT EXISTS`" . $dbName . "` . `products` (
                sku varchar(255) COLLATE utf8_bin NOT NULL,
                name varchar(255) COLLATE utf8_bin NOT NULL,
                price int(255) UNSIGNED NOT NULL,
                type varchar(255) COLLATE utf8_bin NOT NULL,
                value varchar(255) COLLATE utf8_bin NOT NULL
            )";
            $this->mysqli->query($sqlTable);

            $useDB = "USE scandiweb_db";
            $this->mysqli->query($useDB);

            //Insert info
            $sqlProducts = "INSERT INTO `products` (sku, name, price, type, value) 
            VALUES
                ('ABC123', 'Pachinko', 10, 'Book', 'Weight: 1 KG'),
                ('DEF456', 'Fast and Furious', 1, 'DVD', 'Size: 500 MB'),
                ('GHI789', 'Deck Chair', 23, 'Furniture', 'Dimensions: 20x20x20 CM');";
            $this->mysqli->query($sqlProducts);
        }
        //if table exists and has no rows insert products
        $useDB = "USE scandiweb_db";
        $this->mysqli->query($useDB);
        $statement = $this->mysqli->query("SELECT COUNT(*) FROM `products`");
        $row = $statement->fetch_row();
        if ($row[0] === "0") {
            //Insert info
            $sqlProducts = "INSERT INTO `products` (sku, name, price, type, value) 
            VALUES
                ('ABC123', 'Pachinko', 10, 'Book', 'Weight: 1 KG'),
                ('DEF456', 'Fast and Furious', 1, 'DVD', 'Size: 500 MB'),
                ('GHI789', 'Deck Chair', 23, 'Furniture', 'Dimensions: 20x20x20 CM');";
            $this->mysqli->query($sqlProducts);
        }
    }


    public function getProducts()
    {
        $useDB = "USE scandiweb_db";
        $this->mysqli->query($useDB);
        $statement = $this->mysqli->query("SELECT * FROM `products`");
        $result = $statement->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getSku($sku)
    {
        $useDB = "USE scandiweb_db";
        $this->mysqli->query($useDB);
        $statement = $this->mysqli->query("SELECT * FROM `products` WHERE sku = '$sku' ");
        $result = $statement->fetch_assoc();

        return $result["sku"];
    }

    public function createProduct($product)
    {
        $useDB = "USE scandiweb_db";
        $this->mysqli->query($useDB);

        $statement = "INSERT INTO `products` (sku, name, price, type, value)
            VALUES ('$product->sku', '$product->name', '$product->price', '$product->type', '$product->value')";
        $this->mysqli->query($statement);
    }

    public function deleteProduct($sku)
    {
        $useDB = "USE scandiweb_db";
        $this->mysqli->query($useDB);
        $statement = ("DELETE FROM `products` WHERE sku = '$sku'");
        return $this->mysqli->query($statement);
    }
}
