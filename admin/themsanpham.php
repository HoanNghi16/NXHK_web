<?php 
require('./includes/header.php');
?>

<div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">THÊM MỚI SẢN PHẨM</h1>
                            </div>
                            <form class="user" method="post" action="addproduct.php" enctype="multipart/form-data">

    <!-- Tên sản phẩm -->
    <div class="form-group mb-3">
        <label>Tên sản phẩm:</label>
        <input  type="text" name="name" class="form-control form-control-user" placeholder="Nhập tên sản phẩm">
    </div>

    <!-- Danh mục -->
    <div class="form-group mb-3">
        <label>Danh mục:</label>
        <select name="danhmuc" class="form-control">
            <option value="">-- Chọn danh mục --</option>

            <?php
            require_once __DIR__ . '/../config/database.php'; 
            $sql = "SELECT * FROM categories";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <option value="<?= $row['category_id']; ?>">
                    <?= $row['category_name']; ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <!-- Số lượng + giá -->
    <div class="form-group row mb-3">
        <div class="col-sm-6">
            <input type="text" name="quantity" class="form-control" placeholder="Số lượng">
        </div>
        <div class="col-sm-6">
            <input type="text" name="price" class="form-control" placeholder="Giá bán">
        </div>
    </div>

    <!-- Mô tả -->
    <div class="form-group mb-3">
        <label>Mô tả:</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="form-group mb-3">
    <label class="form-label">Thông số kỹ thuật:</label>
    <textarea name="specifications" class="form-control" placeholder="Nhập thông số kỹ thuật"></textarea>
</div>

    <!-- Ảnh -->
    <div class="form-group mb-3">
        <label>Ảnh sản phẩm:</label>
        <input type="file" id="anhs" name="anhs[]" multiple class="form-control">
    </div>

    <!-- Button -->
    <div class="text-center mt-4">
        <button class="btn btn-primary btn-submit">Tạo mới</button>
    </div>

</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>

<?php
require ('./includes/footer.php');  
?>