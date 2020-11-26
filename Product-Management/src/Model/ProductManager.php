<?php


namespace Product\Model;

use Product\Model\Product;
use Product\Model\DBconnect;

class ProductManager
{
    protected $dataManager;

    public function __construct()
    {
        $this->dataManager = new DBconnect();
    }

    function getAllProduct()
    {
        $sql = "SELECT * FROM `products`";
        $statement = $this->dataManager->connectDB()->query($sql);
        $data = $statement->fetchAll();
        $arr = [];
        foreach ($data as $item) {
            $product = new Product($item['name'], $item['type'], $item['price'], $item['amount'], $item['date'], $item['description']);
            $product->setId($item['id']);
            array_push($arr, $product);
        }
        return $arr;
    }

    function addProduct($product)
    {
        $sql = "INSERT INTO `products`(`productName`, `productType`, `productPrice`, `productAmount`, `description`, `dateCreate`) VALUES (:name,:category,:price,:number,:date,:description)";
        $stmt = $this->dataManager->connectDB()->prepare($sql);
        $stmt->bindParam(":name", $product->getName());
        $stmt->bindParam(":type", $product->getCategory());
        $stmt->bindParam(":price", $product->getPrice());
        $stmt->bindParam(":amount", $product->getNumber());
        $stmt->bindParam(":date", $product->getDate());
        $stmt->bindParam(":description", $product->getDescription());
        $stmt->execute();
    }

    function deleteProduct($id)
    {
        $sql = "DELETE FROM `products` WHERE `id`=:id";
        $statement = $this->dataManager->connectDB()->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
    }

    function updateProduct($product)
    {
        $sql = "UPDATE `products` SET `productName`=:name,`productType`=:type ,`productPrice`=:price,`amount`=:amount,`dateCreate`=:date,`description`=:description WHERE `id`=:id";
        $stmt = $this->dataManager->connectDB()->prepare($sql);
        $stmt->bindParam(':id', $product->getId());
        $stmt->bindParam(":name", $product->getName());
        $stmt->bindParam(":type", $product->getCategory());
        $stmt->bindParam(":price", $product->getPrice());
        $stmt->bindParam(":amount", $product->getNumber());
        $stmt->bindParam(":date", $product->getDate());
        $stmt->bindParam(":description", $product->getDescription());
        $stmt->execute();
    }

    function getProductById($id)
    {
        $sql = "SELECT * FROM `products` WHERE `id`=:id";
        $stmt = $this->dataManager->connectDB()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    function searchProduct($keyword)
    {
        $sql = "SELECT * FROM `products` WHERE `productName` LIKE :keyword";
        $stmt = $this->dataManager->connectDB()->prepare($sql);
        $stmt->bindValue(':keyword', '%' . $keyword . '%');
        $stmt->execute();
        $data = $stmt->fetchAll();
        $arr = [];
        foreach ($data as $item) {
            $product = new Product($item['name'], $item['category'], $item['price'], $item['number'], $item['date'], $item['description']);
            $product->setId($item['id']);
            array_push($arr, $product);
        }
        return $arr;
    }
}