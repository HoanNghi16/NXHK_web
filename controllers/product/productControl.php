<?php
    require_once __DIR__."/../../config/database.php";
    include '../services/product/productService.php';
    class ProductControl{
        public function fetchProducts($cate, $price, $sort, $page){
            $productService = new ProductService($GLOBALS['conn']);
            if (!$cate) $cate=null;
            if (!$price) $price=null;
            if (!$sort) $sort=null;
            
            $products = $productService->fetchProductWithCondition($cate, $price, $sort, $page);
            // echo json_encode($products);
            foreach ($products as $product => $detail){
                echo '<div class="product-card">
                        <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8">
                        <h4>'.$detail['product_name'].'</h4>
                        <p class="price">'.number_format($detail['price'], 0, ',', '.').'đ</p>
                        <button>Mua ngay</button>
                    </div>';
            }
        }
    }
?>