<?php
class CartService
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn=$conn;
    }

    public function addToCart($user_id,$product_id,$quantity)
    {
        $sql="SELECT od_quantity FROM cart_details WHERE user_id=? AND product_id=?";
        $stmt=$this->conn->prepare($sql);
        if (!$stmt){
            die($this->conn->error);
        }
        $stmt->bind_param("si", $user_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        

        if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $new_quantity = $row['od_quantity'] + $quantity;

                $updateSql = "UPDATE cart_details SET od_quantity = ? WHERE user_id = ? AND product_id = ?";
                $updateStmt = $this->conn->prepare($updateSql);
                $updateStmt->bind_param("isi", $new_quantity, $user_id, $product_id);
                if ($updateStmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $insertSql = "INSERT INTO cart_details (user_id, product_id, od_quantity) VALUES (?, ?, ?)";
                $insertStmt = $this->conn->prepare($insertSql);
                $insertStmt->bind_param("sii", $user_id, $product_id, $quantity);
                if ($insertStmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            }

    }


    public function changeCartQuantity($quantity, $product_id){
        $id = $_SESSION['user_id'];
        if (!$id){
            return "Vui lòng đăng nhập";
        }
        $sql = "UPDATE CART_DETAILS 
                SET OD_QUANTITY = ? 
                WHERE PRODUCT_ID = ? AND USER_ID = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt){
            die($this->conn->error);
        }
        $stmt->bind_param("iii", $quantity, $product_id, $id);
        if ($stmt->execute()){
            if ($stmt->affected_rows > 0){
                return true;
            } else {
                return "Không tìm thấy sản phẩm trong giỏ";
            }
        }
        return "Lỗi khi cập nhật";
    }

    public function deleteCartDetail($product_id){
        $id = $_SESSION['user_id'];
        if (!$id){
            return "Vui lòng đăng nhập!";
        }

        $sql = "DELETE FROM CART_DETAILS WHERE PRODUCT_ID = ? AND USER_ID = ? ";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt){
            die($this->conn->error);
        }
        $stmt->bind_param('is', $product_id, $id);
        if ($stmt->execute()){
            return true;
        }else{
            return "Xóa sản phẩm thất bại";
        }
    }

    public function getCartByUser($user_id)
        {
            $sql = "SELECT c.user_id, c.product_id, c.od_quantity, 
                        p.product_name, p.price, pi.path
                    FROM cart_details c
                    JOIN product p ON c.product_id = p.product_id
                    LEFT JOIN product_images pi 
                        ON c.product_id = pi.product_id AND pi.is_thumbnail=1
                    WHERE c.user_id = ?";

            $stmt = $this->conn->prepare($sql);
            if (!$stmt) return false;

            $stmt->bind_param("s", $user_id);
            $stmt->execute();

            return $stmt->get_result();
        }

}   
?>