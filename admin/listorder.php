<?php
  session_start();
  if (!isset($_SESSION['user_role']) || $_SESSION['user_role']!= 'admin'){
    header("Location: ../home.php");
  }
require('./includes/header.php');
?>
<div>
    <h3>THỐNG KÊ ĐƠN HÀNG ĐÃ ĐẶT</h3>
</div>
<!-- kết nối DB -->
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Mã Đơn Hàng</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Giá</th>
                                            <th>Số Lượng</th>
                                            <th>Trạng Thái</th>
                                            <th>Ngày Tạo</th>
                                            <th>Phương Thức Thanh Toán</th>
                                            <th>Tên Khách Hàng</th>
                                            <th>Email Khách Hàng</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Địa Chỉ</th>
                                            <th>Ghi Chú</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php
                                        require_once __DIR__ . '../../config/database.php'; 
                                        $sql = "SELECT * FROM ORDERS";
                                        $result = $conn->query($sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>
                                                <td>
                                            '.$row['id'].'
                                            </td>
                                             <td>
                                            '.$row['order_code'].'
                                            </td>
                                             <td>
                                            '.$row['product_name'].'
                                            </td>
                                             <td>
                                            '.$row['amount'].'
                                            </td>
                                            <td>
                                            '.$row['quantity'].'
                                            </td>
                                            <td>
                                            '.$row['status'].'
                                            </td>
                                            <td>
                                            '.$row['created_at'].'
                                            </td>
                                            <td>
                                            '.$row['payment_method'].'
                                            </td>
                                            <td>
                                            '.$row['customer_name'].'
                                            </td>
                                            <td>
                                            '.$row['customer_email'].'
                                            </td>
                                            <td>
                                            '.$row['customer_phone'].'
                                            </td>
                                            <td>
                                            '.$row['customer_address'].'
                                            </td>
                                            <td>
                                            '.$row['order_note'].'
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