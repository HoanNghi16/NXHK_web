<?php
    session_start();
    require_once __DIR__."/../config/database.php";
    include '../services/product/productService.php';
    include '../layout/layout.php';
    $layout = new Layout();
    $id = $_GET["id"] ?? null;

    if (!$id) 
    {
        echo "Không tìm thấy sản phẩm";
        exit;
    }
    $p = new ProductService($conn);
    $product = $p->getProductByID($id);
    if (!$product) 
    {
        echo "Sản phẩm không tồn tại";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/product_detail.css">
    <title>Document</title>
</head>
<body>
    <?php
        echo $layout->getHeader();
    ?>
    <div class="ProductNav"></div>
    <div class="PDetailContainer">
        <div class="ProductImage">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSINAxlH0GswSapFnVnJQmXXAH8Ln8ZoffbNIsl8EDaP3GK6Ysdb553le8iUr-ITeb2Gmb3hIOZubfxnn_Cw3a_4osI0W3xdI5ZY1438N7z&s=10" alt="">
        </div>
        <div class="ProductContent">
            <h1 class="product-name">
                <?php echo $product['product_name'] ?? ''; ?>
            </h1>

            <div class="product-price">
                <?php echo isset($product['product_price']) 
                    ? number_format($product['product_price'], 0, ',', '.') . ' đ'
                    : '0 đ'; ?>
            </div>
        </div>
        <div class="ProductDescription"></div>
    </div>
    <?php
        echo $layout->getFooter();
    ?>
</body>
</html>