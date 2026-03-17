<?php
    require_once __DIR__."/../../config/database.php";
    include '../services/product/productService.php';
    class ProductControl{
        public function fetchProducts($cate, $price, $sort, $page){
            $productService = new ProductService($GLOBALS['conn']);
            if (!$cate) $cate=null;
            if (!$price) $price=null;
            if (!$sort) $sort=null;
            
            $result = $productService->fetchProductWithCondition($cate, $price, $sort, $page);
            $products = $result['products'];
            $total_pages = $result['total_pages'];
            foreach ($products as $product => $detail){
                echo '<a style="text-decoration: none; color: black;" href="./product_detail.php?id='.$detail['product_id'].'" class="productCard">
                        <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8">
                        <h4>'.$detail['product_name'].'</h4>
                        <p class="price">'.number_format($detail['price'], 0, ',', '.').'đ</p>
                        <button>Mua ngay</button>
                    </a>';
            }
            return $total_pages;
        }
    }
?>