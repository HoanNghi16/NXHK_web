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

    public function fetchProductWithCondition($cate, $price, $sort, $page){
        $sql = "SELECT product_id, product_name, price FROM PRODUCT P JOIN CATEGORIES C ON P.CATEGORY_ID = C.CATEGORY_ID";
        if ($cate) {
            $sql .= " WHERE category_name = '".$cate."'";
        }
        if($price){
            if(strpos($sql, "WHERE") !== false){
                $sql .= " AND ";
            }else{
                $sql .= " WHERE ";
            }
            if($price === "5"){
                $sql .= " price < 5000000";
            }else if($price === "10"){
                $sql .= " price >= 5000000 AND price < 10000000";
            }else if($price === "20"){
                $sql .= " price >= 10000000 AND price < 20000000";
            }else if($price === "more"){
                $sql .= " price >= 20000000";
            }
        }
        if ($sort){
            if ($sort == "up"){
                $sql .= " ORDER BY price ASC";
            }else if ($sort == "down"){
                $sql .= " ORDER BY price DESC";
            }
        }
        $offset = ($page - 1) * 10;
        $sql .= " LIMIT 10 OFFSET ".$offset;
        $stmt = $this->conn->prepare($sql);
        if(!$stmt){
            die("SQL Error: " . $this->conn->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()){
            $products[] = $row;
        }
        return $products;
    }
}
?>