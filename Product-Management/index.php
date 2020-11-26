
<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Management</title>
</head>
<body>
<h1> Final Exam Module 2 - Product Management</h1>
<button
>Hiển thị danh sách hàng hoá </button> <br>
<button>Kết quả tìm kiếm mặt hàng theo tên hàng:</button><br>
<button>Nhập thông tin một mặt hàng</button><br>
<button>Chỉnh sửa thông tin một mặt hàng</button><br>
<button>Xoá một mặt hàng</button><br>
</body>
</html>

<?php
require __DIR__."/vendor/autoload.php";

$controller = new \Product\Controller\Controller();
$page = isset($_REQUEST['page'])?$_REQUEST['page']: NULL;
switch ($page) {
    case 'list':
        $controller->viewAllProduct();
        break;
    case 'add':
        $controller->addProduct();
        break;
    case 'delete':
        $controller->deleteProduct();
        break;
    case 'update':
        $controller->updateProduct();
        break;
    case 'search':
        $controller->searchProduct();
        break;
    default:
        $controller->viewAllProduct();
}
?>
