<?php 
session_start();
include 'layout/header.php'; 

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : []; // chưa có giỏ hàng nên t để tạm cart = []
$final_total = 0;
?>
<div class="container mt-5">
    <form action="controllers/order/OrderController.php?action=checkout" method="POST">
        <div class="row">
            <!-- Thông tin khách hàng -->
            <div class="col-md-7">
                <h4>Thông tin thanh toán</h4>
                <div class="mb-3"><input type="text" name="fullname" class="form-control" placeholder="Họ tên" required></div>
                <div class="mb-3"><input type="text" name="phone" class="form-control" placeholder="Số điện thoại" required></div>
                <div class="mb-3"><textarea name="address" class="form-control" placeholder="Địa chỉ chi tiết" required></textarea></div>
                
                <h5 class="mt-4">Phương thức thanh toán</h5>
                <div class="form-check"><input class="form-check-input" type="radio" name="payment" value="momo" checked> <label>Ví MoMo</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="payment" value="vnpay"> <label>Cổng VNPAY</label></div>
            </div>

            <!-- Danh sách sản phẩm -->
            <div class="col-md-5">
                <div class="card p-3 bg-light">
                    <h5>Đơn hàng của bạn</h5>
                    <?php foreach($cart as $item): 
                        $price_after = $item['p_price'] - ($item['p_price'] * $item['p_discount'] / 100);
                        $subtotal = $price_after * $item['quantity'];
                        $final_total += $subtotal;
                    ?>
                    <div class="d-flex justify-content-between mb-2">
                        <span><?php echo $item['p_name']; ?> (x<?php echo $item['quantity']; ?>)</span>
                        <span><?php echo number_format($subtotal); ?>đ</span>
                    </div>
                    <small class="text-muted">Gốc: <del><?php echo number_format($item['p_price']); ?>đ</del> | Giảm: -<?php echo $item['p_discount']; ?>%</small>
                    <hr>
                    <?php endforeach; ?>
                    <h4 class="text-danger text-end">Tổng: <?php echo number_format($final_total); ?>đ</h4>
                    <button type="submit" class="btn btn-success w-100 mt-3">XÁC NHẬN ĐẶT HÀNG</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php include 'layout/footer.php'; ?>
