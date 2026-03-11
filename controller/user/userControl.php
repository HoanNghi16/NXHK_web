
<?php
    require_once(__DIR__ . "/../../toast/toast.php");
    class userControl{
        public function register($email, $password){
            // code đăng ký
        }

        public function login( $email, $password){
            $toast = new ToastController();
            if ($email === "" || $password === "") {
                $toast->showToast("Vui lòng điền đầy đủ thông tin", "error", 3000);
                return;
            }
        }

        private function validationRegister($formData){
            $data = [
                "name" => $formData["name"],
                "email" => $formData["email"],
                "password" => $formData["password"],
                "confirmPassword" => $formData["confirmPassword"]
            ];
        }
    }
?>