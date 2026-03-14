<?php
    session_start();
    require_once __DIR__."/../config/database.php";
    include '../services/product/productService.php';
    include '../layout/layout.php';
    $layout = new Layout();

    $product_id = $_GET['id'];
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