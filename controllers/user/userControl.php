
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

            $otp = $userService->createOtp($email,$password,$name,'register');

            $mailService->sendOtp($email,$otp);
            header("Location: verifyOtp.php");
            exit();
        }

        public function forgetPassword($email){
            $userService = new UserService($GLOBALS['conn']);
            $check = $userService->forgetPassword($email);
            if ($check){
                $_SESSION['forget_email'] = $check;
                $mailService =  new MailService();
                $otp = $userService->createOtp($email = $email, null, null, "forgetPassword");
                $mailService->sendOtp($email, $otp);
                header("Location: ./verifyOtp.php");
            }else{
                $toast = new ToastController();
                $toast->showToast('Email không tồn tại!', 'error', 3000);
            }
        }

        public function newPassword($password){
            $userService = new UserService($GLOBALS['conn']);
            $_SESSION['forget_password'] = $password;
            if($userService->newPassword()){
                header('Location: ./login.php');
                unset($_SESSION['action']);
                return true;
            }
            else{
                $toast = new ToastController();
                $toast->showToast('Lỗi! vui lòng thử lại sau!', 'error', 3000);
                header('Location: ./forgetPassword.php');
                return false;
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
        public function changeProfile($email,$new_email, $new_name, $password){
            $toast = new ToastController();
            $userService = new UserService($GLOBALS['conn']);
            $checkLogin = $userService->login($email, $password);
            if ($checkLogin === true){
                $result = $userService->changeProfile($new_email, $new_name);
                if ($result===true){
                    $toast->showToast('Cập nhật thành công', 'success', 3000);
                    return;
                }else{
                    $toast->showToast($result, "error", 3000);
                }
            }else{
                $toast->showToast($checkLogin, "error", 3000);
            }
            return;
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