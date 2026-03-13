
<?php
    require_once __DIR__."/../../config/database.php";
    include(__DIR__.'/../../services/user/userService.php');
    require_once(__DIR__ . "/../../toast/toast.php");
    include(__DIR__.'/../../services/mail/mailService.php');
    
    class userControl{
        
        public function register($email, $password, $name, $confirmPassword){
            $userService = new UserService($GLOBALS['conn']);
            $toast = new ToastController();
            $mailService = new MailService();

            $validation = $userService->validationRegister($email,$password,$name,$confirmPassword);

            if($validation !== true){
                $toast->showToast($validation,"error",3000);
                return;
            }

            $otp = $userService->createOtp($email,$password,$name);

            $mailService->sendOtp($email,$otp);

            header("Location: verifyOtp.php");
            exit();
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

    if (isset($_SERVER['REQUEST_METHOD']) && isset($_POST['logout'])){
        session_start();
        if (isset($_SESSION['user_id'])){
            session_destroy();
            header("Location: ../../home.php");
            exit();
        }
        else{
            $toast = new ToastController();
            $toast->showToast("Bạn chưa đăng nhập", "error", 3000);
        }
    }
?>