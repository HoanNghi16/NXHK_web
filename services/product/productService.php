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

    public function getProductByID($id)
    {
        $sql = "SELECT * FROM product p
                JOIN categories c ON p.category_id = c.category_id
                WHERE p.product_id = ? AND quantity > 0";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) 
        {
            return null; // lỗi prepare
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $product = $result->fetch_assoc();

            // kiểm tra tồn tại trước khi decode
            if (isset($product['specifications'])) {
                $product['specs'] = json_decode($product['specifications'], true);
            }
            $stmt->prepare("SELECT * FROM PRODUCT_IMAGES WHERE PRODUCT_ID = ?");
            $stmt->bind_param('s', $product['product_id']);
            if($stmt->execute()){
                $result = $stmt->get_result();
                $images = [];
                while ($row = $result->fetch_assoc()){
                    $images[] = $row;
                }
            }else{
                $images = "Không có ảnh nào để hiển thị";
            }
            return ['product'=> $product, 'images'=>$images];
        }

        return null; // không tìm thấy
    }

    public function fetchProductWithCondition($cate, $price, $sort, $page){
        $sql = "SELECT P.product_id, product_name, price, path FROM PRODUCT P 
        JOIN CATEGORIES C ON P.CATEGORY_ID = C.CATEGORY_ID 
        JOIN PRODUCT_IMAGES P_I ON P.PRODUCT_ID = P_I.PRODUCT_ID";
        $pageSql = "SELECT COUNT(*) as total FROM PRODUCT P JOIN CATEGORIES C ON P.CATEGORY_ID = C.CATEGORY_ID JOIN PRODUCT_IMAGES P_I ON P.PRODUCT_ID = P_I.PRODUCT_ID ";
        $condition = " WHERE P_I.IS_THUMBNAIL = 1 AND P.quantity > 0";
        if ($cate) {
            $condition .= " AND category_name = '".$cate."' ";
        }
        if($price){
            $condition .= " AND ";
            switch($price){
                case "5":
                    $condition .= " price < 5000000 ";
                    break;
                case "10":
                    $condition .= " price >= 5000000 AND price < 10000000 ";
                    break;
                case "20":
                    $condition .= " price >= 10000000 AND price < 20000000 ";
                    break;
                default:
                    $condition .= " price >= 20000000 ";
            }
        }
        if ($sort){
            if ($sort == "up"){
                $condition .= " ORDER BY price ASC ";
            }else if ($sort == "down"){
                $condition .= " ORDER BY price DESC ";
            }
        }
        $offset = ($page - 1) * 12;
        $sql .= $condition . " LIMIT 12 OFFSET ".$offset;
        $stmt = $this->conn->prepare($sql);
        if(!$stmt){
            die("SQL Error: " . $this->conn->error.$sql);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()){
            $products[] = $row;
        }

        $this->conn;
        $stmt = $this->conn->prepare($pageSql . $condition);
        if(!$stmt){
            die("SQL Error: " . $this->conn->error);
        }
        $stmt->execute();
        $pageResult = $stmt->get_result();
        $total_pages = ceil($pageResult->fetch_assoc()['total'] / 12);
        return ["products" => $products, "total_pages" => $total_pages];
    }


}
?>