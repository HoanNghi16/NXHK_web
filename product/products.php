<?php
    session_start();
    include("../layout/layout.php");
    include("../controllers/product/productControl.php");
    $productControl = new ProductControl();
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

                <form method="GET">
                    <ul>
                        <li>
                            <button style="outline: none; background: none; border: none; color: white;"  name="cate" value="">Tất cả</button>
                        </li>
                        <li>
                            <button style="outline: none; background: none; border: none; color: white;"  name="cate" value="laptop">Laptop</button>
                        </li>
                        <li>
                            <button style="outline: none; background: none; border: none; color: white;"  name="cate" value="phone">Điện thoại</button>
                        </li>
                        <li>
                            <button style="outline: none; background: none; border: none; color: white;"  name="cate" value="gaming">Gaming</button>
                        </li>
                        <li>
                            <button style="outline: none; background: none; border: none; color: white;"  name="cate" value="accessories">Phụ kiện</button>
                        </li>
                    </ul>
                <h3>Khoảng giá</h3>
                    <ul>
                        <li>
                            <button style="outline: none; background: none; border: none; color: white;" class="cate_button" name="price" value="5">Dưới 5 triệu</button>
                        </li>
                        <li>
                            <button style="outline: none; background: none; border: none; color: white;" class="cate_button" name="price" value="10">5 - 10 triệu</button>
                        </li>
                        <li>
                            <button style="outline: none; background: none; border: none; color: white;" class="cate_button" name="price" value="20">10 - 20 triệu</button>
                        </li>
                        <li>
                            <button style="outline: none; background: none; border: none; color: white;" class="cate_button" name="price" value="more">Trên 20 triệu</button>
                        </li>
                    </ul>
                </form>
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
                    <?php
                        $productControl->fetchProducts($_GET['cate'] ?? "", $_GET['price'] ?? "", $_GET['sort'] ?? "", $_GET['page'] ?? 1);
                    ?>
                </div>


            </section>

        </div>

    </div>
    <?php
        echo $layout->getFooter();
    ?>
</body>
</html>