<?php
    session_start();
    include("../layout/layout.php");
    $layout = new Layout();
    $title = $_GET['cate'] ?? "Tất cả sản phẩm";
    $title = ucfirst($title);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/products.css">
</head>
<body>
    <?php
        echo $layout->getHeader();
    ?>
    <div class="product_container">

        <div class="products-layout">

            <!-- sidebar filter -->
            <aside class="filter">
                <h3>Danh mục</h3>

                <ul>
                    <li><a href="?cate=">Tất cả</a></li>
                    <li><a href="?cate=laptop">Laptop</a></li>
                    <li><a href="?cate=phone">Điện thoại</a></li>
                    <li><a href="?cate=gaming">Gaming</a></li>
                    <li><a href="?cate=accessories">Phụ kiện</a></li>
                </ul>

                <h3>Khoảng giá</h3>

                <ul>
                    <li><a href="?price=5">Dưới 5 triệu</a></li>
                    <li><a href="?price=10">5 - 10 triệu</a></li>
                    <li><a href="?price=20">10 - 20 triệu</a></li>
                    <li><a href="?price=more">Trên 20 triệu</a></li>
                </ul>
            </aside>

            <!-- product grid -->
            <section class="products-show">

                <div class="products-header">
                    <h2 style="color: white;"><?php echo $title; ?></h2>

                    <select>
                        <option>Sắp xếp</option>
                        <option>Giá thấp → cao</option>
                        <option>Giá cao → thấp</option>
                        <option>Mới nhất</option>
                    </select>
                </div>

                <div class="product-grid">

                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8">
                        <h4>Macbook Pro M3</h4>
                        <p class="price">42.000.000đ</p>
                        <button>Mua ngay</button>
                    </div>

                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9">
                        <h4>iPhone 15 Pro</h4>
                        <p class="price">29.000.000đ</p>
                        <button>Mua ngay</button>
                    </div>

                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1587202372775-989f1d1e5b9e">
                        <h4>Gaming Mouse</h4>
                        <p class="price">1.200.000đ</p>
                        <button>Mua ngay</button>
                    </div>

                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1580910051074-3eb694886505">
                        <h4>Airpods Pro</h4>
                        <p class="price">6.500.000đ</p>
                        <button>Mua ngay</button>
                    </div>

                </div>

            </section>

        </div>

    </div>
    <?php
        echo $layout->getFooter();
    ?>
</body>
</html>