<?php
require('./includes/header.php');
?>
<div>
    <h3>DANH SÁCH SẢN PHẨM</h3>
</div>

<!-- kết nối DB -->

<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã Sản Phẩm</th>
                                            <th>Loại Sản Phẩm</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Giá</th>
                                            <th>Mô Tả</th>
                                            <th>Số Lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php
                                        require_once __DIR__ . '../../config/database.php'; 
                                        $sql = "SELECT * FROM product P join CATEGORIES C ON P.CATEGORY_ID = C.CATEGORY_ID ORDER BY product_id ASC";
                                        $result = $conn->query($sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>
                                                <td>
                                            '.$row['product_id'].'
                                            </td>
                                             <td>
                                            '.$row['category_name'].'
                                            </td>
                                             <td>
                                            '.$row['product_name'].'
                                            </td>
                                             <td>
                                            '.$row['price'].'
                                            </td>
                                            <td>
                                            '.$row['description'].'
                                            </td>
                                            <td>
                                            '.$row['quantity'].'
                                            </td>
                                            </tr>'; 
                                        }
                                        ?>   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

<?php
require('./includes/footer.php');
?>