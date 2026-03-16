<?php
require_once __DIR__ . "/config/database.php";
require_once __DIR__ . "/services/product/productService.php";
require_once __DIR__ . "/layout/layout.php"; 

$layout = new Layout();
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$productService = new ProductService($GLOBALS['conn']);
$product = $productService->getProductById($id);

if (!$product) { die("Sản phẩm không tồn tại."); }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thanh toán - <?php echo $product['product_name']; ?></title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .checkout-wrapper { 
            display: flex; 
            gap: 40px; 
            max-width: 1100px; 
            margin: 50px auto 50px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 30px;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        .product-image { flex: 1.2; text-align: center; }
        .product-image img { width: 100%; border-radius: 12px; object-fit: cover; border: 1px solid #eee; }
        
        .checkout-info { flex: 1; display: flex; flex-direction: column; gap: 20px; }
        .checkout-info h1 { margin: 0; font-size: 24px; color: #1a1a1a; }
        .price { color: #d32f2f; font-size: 26px; font-weight: bold; }
        
        .quantity-control { display: flex; align-items: center; gap: 15px; background: #f9f9f9; padding: 10px; border-radius: 8px; width: fit-content; }
        .quantity-control button { 
            width: 32px; height: 32px; border: 1px solid #ddd; 
            background: #fff; cursor: pointer; font-size: 18px; border-radius: 50%;
        }
        .quantity-control input { 
            width: 40px; border: none; background: transparent; text-align: center; font-size: 16px; font-weight: bold;
        }
        
        .total-section { 
            font-size: 18px; margin-top: 10px; padding-top: 15px; 
            border-top: 1px solid #eee; 
        }
        #total-price { display: block; font-size: 32px; color: #d32f2f; margin-top: 5px; }

        .btn-pay { 
            background: #007bff;
            color: white; border: none; padding: 18px; 
            font-size: 18px; font-weight: bold; cursor: pointer; 
            border-radius: 8px; transition: 0.3s; text-transform: uppercase;
        }
        .btn-pay:hover { background: #0056b3; transform: translateY(-2px); }
    </style>

</head>
<body>

<?php echo $layout->getHeader(); ?>

<div class="checkout-wrapper">
    
    <div class="product-image">
        <img src="<?php echo (!empty($product)) ? $product : 'https://images.unsplash.com'; ?>" alt="Product">
    </div>

    <div class="checkout-info">
        <h1><?php echo $product['product_name']; ?></h1>
        <p class="price" id="unit-price" data-price="<?php echo $product['price']; ?>">
            <?php echo number_format($product['price'], 0, ',', '.'); ?>đ
        </p>

        <div class="quantity-control">
            <strong>Số lượng:</strong>
            <button type="button" onclick="updateQty(-1)">-</button>
            <input type="number" id="qty" value="1" readonly>
            <button type="button" onclick="updateQty(1)">+</button>
        </div>

        <div class="total-section">
            <p>Tổng thanh toán: <br>
                <span id="total-price" style="color:#e44d26; font-size: 30px; font-weight:bold;">
                    <?php echo number_format($product['price'], 0, ',', '.'); ?>đ
                </span>
            </p>
        </div>

        <form action="vnpay_php/vnpay_create_payment.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            <input type="hidden" name="amount" id="vnpay-amount" value="<?php echo $product['price']; ?>">
            <input type="hidden" name="quantity" id="vnpay-qty" value="1">
            <input type="hidden" name="order_desc" value="Thanh toan don hang: <?php echo $product['product_name']; ?>">
            
            <button type="submit" name="redirect" class="btn-pay">Thanh toán</button>
        </form>
    </div>
</div>

<script>
    const unitPrice = parseInt(document.getElementById('unit-price').getAttribute('data-price'));
    
    function updateQty(change) {
        let qtyInput = document.getElementById('qty');
        let currentQty = parseInt(qtyInput.value);
        let newQty = currentQty + change;

        if (newQty < 1) newQty = 1;

        qtyInput.value = newQty;
        document.getElementById('vnpay-qty').value = newQty;
        let total = newQty * unitPrice;
        document.getElementById('vnpay-amount').value = total;
        document.getElementById('total-price').innerText = total.toLocaleString('vi-VN') + 'đ';
    }
</script>

<?php echo $layout->getFooter(); ?>

</body>
</html>
