
<?php
    require_once __DIR__."/../../config/database.php";
    include(__DIR__.'/../../services/user/userService.php');
    require_once(__DIR__ . "/../../toast/toast.php");
    class userControl{
        public function register($email, $password, $name, $confirmPassword){
            $userService = new UserService($GLOBALS['conn']);
            $toast = new ToastController();
            $result = $userService->register($email, $password, $name, $confirmPassword);
            if ($result === true){
                $toast->showToast("Đăng ký thành công", "success", 3000);
                header("Location: login.php");
                exit();
            } else {
                $toast->showToast($result, "error", 3000);
            }
        }

        public function login( $email, $password){
            $userService = new UserService($GLOBALS['conn']);
            $toast = new ToastController();
            $result = $userService->login($email, $password);
            if ($result === true){
                $toast->showToast("Đăng nhập thành công", "success", 3000);
                header("Location: ../home.php");
                exit();
            } else {
                $toast->showToast($result, "error", 3000);
            }
        }
    }
?>