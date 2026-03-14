<?php
class ProductService
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn=$conn;
    }

    public function insertProduct($data)
    {
        // KIỂM TRA SẢN PHẨM ĐÃ TỒN TẠI CHƯA ---
        // kiểm tra 'product_name'
        $checkSql = "SELECT product_id FROM product WHERE product_name = ? LIMIT 1";
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->bind_param("s", $data['product_name']);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            // Nếu đã tồn tại sản phẩm trùng tên, đóng stmt và trả về false (hoặc báo lỗi)
            $checkStmt->close();
            return false; 
        }
        $checkStmt->close();


        // 1. Mã hóa mảng specs thành chuỗi JSON để lưu vào database
        $jsonSpecs=json_encode($data['specs'], JSON_UNESCAPED_UNICODE);
        $sql="INSERT INTO product (category_id, product_name, price, description, specifications) VALUES (?, ?, ?, ?,?)";
        $stmt=$this->conn->prepare($sql);

        if($stmt)
        {

        $stmt->bind_param("isdss",
                            $data['category_id'],
                            $data['product_name'],
                            $data['price'],
                            $data['description'],
                            $jsonSpecs);
                            
                            $result=$stmt->execute();
                            $stmt->close();
                            return $result;
        }
        return false;
    }
}
?>