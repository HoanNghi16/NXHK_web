<?php
    session_start();
    include('layout/layout.php');
    $layout = new Layout();
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

          <h1>Công nghệ của tương lai</h1>

          <p>Khám phá thiết bị công nghệ mới nhất với hiệu năng vượt trội</p>

          <button>Khám phá ngay</button>

        </div>

      </section>
      <section class="categories">

        <h2>Danh mục</h2>

        <div class="category-grid">

          <div class="category-card">Laptop</div>
          <div class="category-card">Điện thoại</div>
          <div class="category-card">Gaming</div>
          <div class="category-card">Phụ kiện</div>

        </div>

      </section>
      <section class="products">

        <h2>Sản phẩm nổi bật</h2>

        <div class="product-grid">

          <div class="product-card">
            <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8">
            <h3>Macbook Pro M3</h3>
            <p class="price">42.000.000đ</p>
            <button>Mua ngay</button>
          </div>

          <div class="product-card">
            <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9">
            <h3>iPhone 15 Pro</h3>
            <p class="price">29.000.000đ</p>
            <button>Mua ngay</button>
          </div>

          <div class="product-card">
            <img src="https://images.unsplash.com/photo-1587202372775-989f1d1e5b9e">
            <h3>Gaming Mouse</h3>
            <p class="price">1.200.000đ</p>
            <button>Mua ngay</button>
          </div>

          <div class="product-card">
            <img src="https://images.unsplash.com/photo-1580910051074-3eb694886505">
            <h3>Airpods Pro</h3>
            <p class="price">6.500.000đ</p>
            <button>Mua ngay</button>
          </div>

        </div>

      </section>
      <section class="promo">

        <h2>Giảm giá đến 40%</h2>

        <p>Dành cho tất cả thiết bị gaming</p>

        <button>Xem ngay</button>

      </section>
      <?php
          echo $footer;
      ?>
    </div>
  </body>
</html>