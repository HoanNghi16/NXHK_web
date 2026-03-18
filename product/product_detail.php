<?php
    session_start();
    require_once __DIR__."/../config/database.php";
    include '../services/product/productService.php';
    include '../layout/layout.php';
    include '../controllers/cart/cartControl.php';
    $layout = new Layout();
    $id = $_GET["id"] ?? null;

    if (!$id) 
    {
        echo "Không tìm thấy sản phẩm";
        exit;
    }
    $p = new ProductService($conn);
    $result = $p->getProductByID($id);
    if (!$result){
        header("Location: ./products.php");
        exit;
    }
    $product = $result['product'];
    $images = $result['images'];
    if (!$product) 
    {
        echo "Sản phẩm không tồn tại";
        exit;
    }

    $controller = new CartController($conn);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->addToCart();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/product_detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Document</title>
    <script src="../js/productDetailHandler.js"></script>
</head>
<body>
    <?php
        echo $layout->getHeader();
    ?>
    <div class="ProductNav">
        <a href="../home.php">Trang chủ</a> /
        <a href="./products.php">Sản phẩm</a> /
        <a href="./products.php?cate=<?php echo $product['category_name']; ?>">
            <?php echo $product['category_name']; ?>
        </a> /

        <span><?php echo $product['product_name']; ?></span>
        
    </div>
    <hr>
    <div class="PDetailContainer">
        
        <div style="margin-bottom: 40px; display: flex">
            <div class="ProductImage">
                <img src="<?php echo $images[0]['path']?>" alt="" id="onShow">
                <div class="previewList">
                    <?php
                        foreach($images as $image){
                            echo '<img class="preview" src="'.$image['path'].'" onmouseenter="changePreview(this)"></img>';
                        }
                    ?>
                </div>
            </div>
            <div class="ProductContent">
                <h1 class="product-name">
                    <?php echo $product['product_name'] ?? ''; ?>
                </h1>
    
                <div class="product-price">
                    <?php 
                    echo 'Giá: ';
                    echo isset($product['price']) 
                    ? number_format($product['price'], 0, ',', '.') . ' VNĐ'
                    : '0 đ'; ?>
                </div>
                <?php
                    echo '<p class="productDescription">'.$product['description'].'</p>';
                ?>
                <div class="product-button">

                    <!-- Thêm vào giỏ -->
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="action" value="add">

                        <button type="submit" id="btn-add-to-cart">
                            Thêm vào giỏ hàng <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </form>

                    <!-- Mua ngay -->
                    <form action="../checkout.php" method="GET">
                        <input type="hidden" name="btn-buy-now" value="<?php echo $product['product_id']; ?>">

                        <button type="submit" id="btn-buy-now">
                            Mua ngay!
                        </button>
                    </form>

                </div>
       
            </div>
        </div>
        <hr>
        <div class="ProductDescription">
            <h1 style="margin-left: 20px;">Thông số kỹ thuật</h1>
            <br>

            <?php
                if (!empty($product['specs'])) {

                    echo '<table class="specs-table">';

                    foreach ($product['specs'] as $key => $value) {
                        echo '
                            <tr>
                                <td class="spec-name" style="padding-left:20px;">'.$key.'</td>
                                <td class="spec-value" style="padding-left:20px;">'.$value.'</td>
                            </tr>
                        ';
                    }

                    echo '</table>';

                } else {
                    echo '<p>Chưa có thông số kỹ thuật</p>';
                }
            ?>
          <br>
        </div>
    </div>
    <?php
        echo $layout->getFooter();
    ?>
</body>
</html>