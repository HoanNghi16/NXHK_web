<?php
session_start();
include("../layout/layout.php");
require_once __DIR__."/../config/database.php";
include '../services/cart/cartService.php';

$layout = new Layout();
if (!isset($_SESSION['user_id'])) {
    echo "<p style='text-align:center;margin-top:50px;'>Vui lòng đăng nhập để xem giỏ hàng</p>";
    exit;
}

$user_id = $_SESSION['user_id'];

$cartService = new CartService($conn);
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

        <div class="cart-select-all">
            <input type="checkbox"> Chọn tất cả
        </div>

        <?php
        $totalMoney = 0;

        if ($result && $result->num_rows > 0):

            while ($row = $result->fetch_assoc()):
                $total = $row['price'] * $row['od_quantity'];
                $totalMoney += $total;
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
                <form action="../controller/cartController.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="action" value="decrease">
                    <button>-</button>
                </form>

                <span><?php echo $row['od_quantity']; ?></span>

                <form action="../controller/cartController.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="action" value="increase">
                    <button>+</button>
                </form>
            </div>

            <div class="cart-total">
                <?php echo number_format($total, 0, ',', '.') . ' đ'; ?>
            </div>

            <form action="../controller/cartController.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <input type="hidden" name="action" value="remove">
                <button class="remove-btn">Xóa</button>
            </form>

        </div>

        <?php endwhile; else: ?>

            <p>Giỏ hàng trống</p>

        <?php endif; ?>

    </div>

    <!-- RIGHT -->
    <div class="cart-right">
        <div class="cart-summary">
            <p>Tổng tiền:</p>
            <h3><?php echo number_format($totalMoney, 0, ',', '.'); ?> đ</h3>
            <button class="checkout-btn">Thanh toán</button>
        </div>
    </div>

</div>

<?php echo $layout->getFooter(); ?>

</body>
</html>