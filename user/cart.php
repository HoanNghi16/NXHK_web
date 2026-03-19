<?php
session_start();
include("../layout/layout.php");
require_once __DIR__."/../config/database.php";
include '../services/cart/cartService.php';
include '../controllers/cart/cartControl.php';

$cartControl = new cartController($conn);
$layout = new Layout();
if (!isset($_SESSION['user_id'])) {
    echo "<p style='text-align:center;margin-top:50px;'>Vui lòng đăng nhập để xem giỏ hàng</p>";
    exit;
}

$user_id = $_SESSION['user_id'];

$cartService = new CartService($conn);

if (isset($_POST['remove'])){
    $cartControl->deleteCart($_POST['remove']);
}

if (isset($_POST['increase']) || isset($_POST['decrease'])){
    $action = isset($_POST['increase'])? 'increase': 'decrease';
    $cartControl->changeCart($action,$_POST['od_quantity'], $_POST['product_id']);
}

$result = $cartService->getCartByUser($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/cart.css">
    <title>Giỏ hàng</title>
</head>
<body>

<?php echo $layout->getHeader(); ?>

<div class="CartContainer">

    <!-- LEFT -->
    <div class="cart-left">
        <h2>Giỏ hàng của bạn</h2>
        <?php
        $totalMoney = 0;
        $totalQuantity = 0;

        if ($result && $result->num_rows > 0):

            while ($row = $result->fetch_assoc()):
                $total = $row['price'] * $row['od_quantity'];
                $totalMoney += $total;
                $totalQuantity += $row['od_quantity'];
        ?>

        <div class="cart-item">

            <input type="checkbox" class="item-check">

            <img src="<?php echo $row['path'] ?? 'default.jpg'; ?>" class="cart-img">

            <div class="cart-info">
                <h4><?php echo $row['product_name']; ?></h4>
                <p class="price">
                    <?php echo number_format($row['price'], 0, ',', '.'); ?> đ
                </p>
            </div>

            <div class="cart-quantity">
                <form method="POST" name="quantity">
                    <input hidden name="product_id" value=<?php echo "'".$row['product_id']."'"?>/>
                    <input hidden name="od_quantity" value=<?php echo "'".$row['od_quantity']."'"?>/>
                    <button name="decrease" value="decrease" class="quantityBtn">-</button>
                    <span><?php echo $row['od_quantity']; ?></span>
                    <button name="increase" value="increase" class="quantityBtn">+</button>
                </form>
            </div>

            <div class="cart-total">
                <?php echo number_format($total, 0, ',', '.') . ' đ'; ?>
            </div>

            <form method="POST">
                <button class="remove-btn" name="remove" value=<?php echo '"'.$row['product_id'].'"'?>>Xóa</button>
            </form>

        </div>

        <?php endwhile; else: ?>

            <p>Giỏ hàng trống</p>

        <?php endif; ?>

    </div>

    <!-- RIGHT -->
    <div class="cart-right">
        <div class="cart-summary">
            <h1>Kết quả đơn hàng</h1>

            <div class="summary-row">
                <span>Tổng sản phẩm:</span>
                <span><?php echo $totalQuantity; ?></span>
            </div>

            <hr>

            <div class="summary-row total">
                <span>Tổng cộng:</span>
                <span style=" color: rgb(184, 41, 41);"><?php echo number_format($totalMoney, 0, ',', '.'); ?> đ</span>
            </div>

            <button class="checkout-btn">Đặt hàng</button>
        </div>
</div>

</div>

<?php echo $layout->getFooter(); ?>

</body>
</html>