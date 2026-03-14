<?php
    session_start();
    include '../controllers/product/productControl.php';
    include '../layout/layout.php';
    $layout = new Layout();

    $product_id = $_GET['id'];
    $productService = new ProductService();
    $product = $productService->fetchById($product_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        echo $product_id;
    ?>
</body>
</html>