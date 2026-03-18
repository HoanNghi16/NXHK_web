<?php
require_once __DIR__."/../../config/database.php";
require_once __DIR__."/../../services/cart/cartService.php";
require_once __DIR__."/../../toast/toast.php";

class CartController
{
    private $conn;
    private $toast;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->toast = new ToastController();
    }

    public function addToCart()
    {
        
        if (!isset($_SESSION['user_id'])) {
            $this->toast->showToast("Vui lòng đăng nhập!", "error", 3000);
            return;
        }

        $user_id = $_SESSION['user_id'];

        // lấy data
        $product_id = $_POST['product_id'] ?? null;
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

        // validate
        if (!$product_id || $quantity <= 0) {
            $this->toast->showToast("Dữ liệu không hợp lệ!", "error", 3000);
            return;
        }

        // gọi service
        $cartService = new CartService($this->conn);
        $result = $cartService->addToCart($user_id, $product_id, $quantity);

        // thông báo
        if ($result) {
            $this->toast->showToast("Thêm vào giỏ hàng thành công!", "success", 2000);
        } else {
            $this->toast->showToast("Thêm vào giỏ hàng thất bại!", "error", 2000);
        }
    }

    public function changeCart($action, $quantity, $product_id){
        $toast = new ToastController();
        $cartService = new cartService($GLOBALS['conn']);
        if (!$action || $action == ''){
            $toast->showToast('Đã xảy ra lỗi!', "error", 3000);
        }
        if ($action == "increase"){
            $result = $cartService->changeCartQuantity($quantity + 1);
            if ($result === true){
                return;
            }
            else{
                $toast->showToast($result, "error", 3000);
            }
        }
        else{
            $result = $cartService->changeCart($quantity - 1);
            if ($result === true){
                return;
            }
            else{
                $toast->showToast($result, "error", 3000);
            }
        }
    }
}


