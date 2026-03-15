<?php include 'layout/header.php'; ?>

<?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
<div class="alert alert-success alert-dismissible fade show text-center container mt-3" role="alert">
  <strong>Thành công!</strong> Đơn hàng của bạn đã được hệ thống ghi nhận.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<div class="container mt-5">
    <div class="card shadow border-0 p-5 text-center">
        <h2 class="fw-bold text-primary mb-4">TIẾN ĐỘ GIAO HÀNG</h2>
        <div class="row mt-4">
            <div class="col-3">
                <div class="rounded-circle bg-primary text-white d-inline-block p-3 mb-2"><i class="fas fa-file-invoice fa-2x"></i></div>
                <p class="fw-bold">Đã đặt hàng</p>
                <small class="text-muted">10:30 - Hôm nay</small>
            </div>
            <div class="col-3">
                <div class="rounded-circle bg-light text-muted d-inline-block p-3 mb-2"><i class="fas fa-box fa-2x"></i></div>
                <p>Đang chuẩn bị</p>
            </div>
            <div class="col-3">
                <div class="rounded-circle bg-light text-muted d-inline-block p-3 mb-2"><i class="fas fa-shipping-fast fa-2x"></i></div>
                <p>Đang vận chuyển</p>
            </div>
            <div class="col-3">
                <div class="rounded-circle bg-light text-muted d-inline-block p-3 mb-2"><i class="fas fa-check-double fa-2x"></i></div>
                <p>Giao thành công</p>
            </div>
        </div>
        
        <div class="mt-5">
            <a href="home.php" class="btn btn-outline-secondary">Quay lại trang chủ</a>
            <button class="btn btn-primary px-4" onclick="location.reload()">Cập nhật trạng thái</button>
        </div>
    </div>
</div>
<?php include 'layout/footer.php'; ?>
