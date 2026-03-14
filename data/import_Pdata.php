<?php
require_once '../config/database.php';
require_once '../services/product/productService.php';

$p=new ProductService($conn);
$products=require_once 'product_data.php';

echo "<h2>Đang đổ dữ liệu từ thư mục Data...</h2>";
$countSuccess = 0;
$countSkip = 0;

if(is_array($products))
    {
        foreach($products as $item)
            {
                if($p->insertProduct($item))
                    {
                        echo "<p style='color: green;'>Thành công: " . $item['product_name'] . "</p>";
                        $countSuccess++;
                    }
                else
                    {
                        echo "<p style='color: red;'>Bỏ qua (đã tồn tại): " . $item['product_name'] . "</p>";
                        $countSkip++;

                    }
            }

    }
echo "<hr>";
echo "<b>Kết quả:</b> Thêm mới ($countSuccess), Bỏ qua ($countSkip).";
echo "<br><br><a href='../home.php'>Quay về trang chủ</a>"; // Link về file home.php ở root
?>