<?php


namespace Product\Controller;


use Product\Model\Product;
use Product\Model\ProductManager;

class Controller
{
    protected $productManager;

    public function __construct()
    {
        $this->productManager = new ProductManager();
    }

    function viewAllProduct(){
        $products = $this->productManager->getAllProduct();
        include_once 'src/View/list.php';
    }

    function addProduct(){
        if ($_SERVER['REQUEST_METHOD']=="GET"){
            include_once 'src/View/add.php';
        } else {
            $name = $_POST['name'];
            $category = $_POST['category'];
            $price = $_POST['price'];
            $number = $_POST['number'];
            $date = $_POST['date'];
            $description = $_POST['description'];

            $product = new Product($name,$category,$price,$number,$date,$description);
            $this->productManager->addProduct($product);
            header('location:index.php');
        }
    }

    function deleteProduct(){
        if ($_SERVER['REQUEST_METHOD']=='GET'){
            $id = $_REQUEST['id'];
            $this->productManager->deleteProduct($id);
            header('location:index.php');
        }
    }

    function updateProduct(){
        if ($_SERVER['REQUEST_METHOD']=="GET"){
            $id=$_REQUEST['id'];
            $product = $this->productManager->getProductById($id);
            include_once 'src/View/update.php';
        } else {
            $id = $_REQUEST['id'];
            $name = $_POST['name'];
            $category = $_POST['category'];
            $price = $_POST['price'];
            $number = $_POST['number'];
            $date = $_POST['date'];
            $description = $_POST['description'];

            $product = new Product($name,$category,$price,$number,$date,$description);
            $product->setId($id);
            $this->productManager->updateProduct($product);
            header('location:index.php');
        }
    }

    function searchProduct(){
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $keyword = $_POST['keyword'];
            $products = $this->productManager->searchProduct($keyword);
            $this->productManager->searchProduct($products);
            include_once 'src/View/list.php';
        }
    }
}