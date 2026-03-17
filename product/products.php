<?php
    session_start();
    include("../layout/layout.php");
    include("../controllers/product/productControl.php");
    $productControl = new ProductControl();
    $layout = new Layout();
    $title = isset($_GET['cate'] ) && $_GET['cate'] !='' ? $_GET['cate'] : 'Tất cả sản phẩm';
    $title = ucfirst($title);  
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Sản phẩm</title>
            <link rel="stylesheet" href="../style/products.css">
            <script src="../js/productUIhandler.js"></script>
        </head>
        <body>
            <?php
                echo $layout->getHeader();
            ?>
            <div class="productContainer">

                <div class="productLayout">
                    <aside class="filter">
                        <h3>Danh mục</h3>
                        <div class="filterForm">
                            <ul>
                                <li>
                                    <button onclick="filterForm(this)" style="outline: none; background: none; border: none; color: white;"  id="cate" value="">Tất cả</button>
                                </li>
                                <li>
                                    <button onclick="filterForm(this)" style="outline: none; background: none; border: none; color: white;"  id="cate" value="laptop">Laptop</button>
                                </li>
                                <li>
                                    <button onclick="filterForm(this)" style="outline: none; background: none; border: none; color: white;"  id="cate" value="phone">Điện thoại</button>
                                </li>
                                <li>
                                    <button onclick="filterForm(this)" style="outline: none; background: none; border: none; color: white;"  id="cate" value="gaming">Gaming</button>
                                </li>
                                <li>
                                    <button onclick="filterForm(this)" style="outline: none; background: none; border: none; color: white;"  id="cate" value="accessories">Phụ kiện</button>
                                </li>
                            </ul>
                        <h3>Khoảng giá</h3>
                            <ul>
                                <li>
                                    <button onclick="filterForm(this)" style="outline: none; background: none; border: none; color: white;" class="cate_button" id="price" value="">Tất cả</button>
                                </li>
                                <li>
                                    <button onclick="filterForm(this)" style="outline: none; background: none; border: none; color: white;" class="cate_button" id="price" value="5">Dưới 5 triệu</button>
                                </li>
                                <li>
                                    <button onclick="filterForm(this)" style="outline: none; background: none; border: none; color: white;" class="cate_button" id="price" value="10">5 - 10 triệu</button>
                                </li>
                                <li>
                                    <button onclick="filterForm(this)" style="outline: none; background: none; border: none; color: white;" class="cate_button" id="price" value="20">10 - 20 triệu</button>
                                </li>
                                <li>
                                    <button onclick="filterForm(this)" style="outline: none; background: none; border: none; color: white;" class="cate_button" id="price" value="more">Trên 20 triệu</button>
                                </li>
                            </ul>
                        </div>
                    </aside>
                    <section class="productShow">

                        <div class="productHeader">
                            <h2 style="color: white;"><?php echo $title; ?></h2>

                            <select id="sort" onchange="sortHandler(this)">
                                <option value="">Sắp xếp</option>
                                <option value="up">Giá thấp → cao</option>
                                <option value="down">Giá cao → thấp</option>
                                <option>Mới nhất</option>
                            </select>
                        </div>

                        <div class="productGrid">
                            <?php
                                $total_pages = $productControl->fetchProducts($_GET['cate'] ?? "", $_GET['price'] ?? "", $_GET['sort'] ?? "", $_GET['page'] ?? 1);
                            ?>
                        </div>

                        <div class="paginationBox">
                            <button id="prev" onclick="changePage(this, <?php echo $total_pages; ?>)">Trước</button>
                            <input id="pageInput" min="1" max="<?php echo $total_pages; ?>" type="number" onchange="changePage(this, this.max)"/><p><?php echo " / ".$total_pages?></p>
                            <button id="next" onclick="changePage(this, <?php echo $total_pages?>)">Sau</button>
                        </div>

                    </section>

                </div>

            </div>
            <?php
                echo $layout->getFooter();
            ?>
        </body>
</html>