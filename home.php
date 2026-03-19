<?php
    session_start();
    include('layout/layout.php');
    include('./controllers/product/productControl.php');
    $layout = new Layout();
    $productControl = new productControl();
    $header = $layout->getHeader();
    $footer = $layout->getFooter();
?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeoTech Store</title>

    <link rel="stylesheet" href="./style/home.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <?php
          echo $header;
      ?>
      <section class="hero">

        <div class="hero-content">

          <h1>Công nghệ của thời đại</h1>

          <p>Khám phá thiết bị công nghệ mới nhất của Neo Store</p>
          <form action="./product/products.php">
            <button >Khám phá ngay</button>
          </form>

        </div>

      </section>
      <section class="categories">

        <h2>Danh mục</h2>

        <div class="category-grid">
          <a style="text-decoration: none; color: white;" class="category-card" href="/nxhk_web/product/products.php?cate=laptop">Laptop</a>
          <a style="text-decoration: none; color: white;" class="category-card" href="/nxhk_web/product/products.php?cate=phone">Điện thoại</a>
          <a style="text-decoration: none; color: white;" class="category-card" href="/nxhk_web/product/products.php?cate=gaming">Gaming</a>
          <a style="text-decoration: none; color: white;" class="category-card" href="/nxhk_web/product/products.php?cate=accessories">Phụ kiện</a>
        </div>

      </section>
      <section class="products">

        <h2>Sản ra mắt năm 2026</h2>
        <a class="seeAll" href="./product/products.php" style="color: white; text-decoration: none; position: relative; right: 0; left: 93%; bottom: 20px;">Xem tất cả</a>


        
        <div class="product-home-grid">

            <?php
              $productControl->fetchProducts(null, null, "new", 0, "./product");
            ?>

        </div>

      </section>
      <?php
          echo $footer;
      ?>
    </div>
  </body>
</html>