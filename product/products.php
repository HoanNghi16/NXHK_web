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
            <script src=""></script>
        </head>
        <body>
            <?php
                echo $layout->getHeader();
            ?>
            <div class="productContainer">

                <div class="productLayout">
                    <aside class="filter">
                        <h3>Danh mục</h3>
                        <form method="GET" class="filterForm">
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
                    <section class="productShow">

                        <div class="productHeader">
                            <h2 style="color: white;"><?php echo $title; ?></h2>

                            <select>
                                <option>Sắp xếp</option>
                                <option>Giá thấp → cao</option>
                                <option>Giá cao → thấp</option>
                                <option>Mới nhất</option>
                            </select>
                        </div>

                        <div class="productGrid">
                            <?php
                                $productControl->fetchProducts($_GET['cate'] ?? "", $_GET['price'] ?? "", $_GET['sort'] ?? "", $_GET['page'] ?? 1);
                            ?>
                        </div>

                        <div class="pagination">
                            <button>Trước</button>
                            <input type="number"/>
                            <button>Sau</button>
                        </div>


                    </section>

                </div>

            </div>
            <?php
                echo $layout->getFooter();
            ?>
        </body>
</html>