<?php
    class UserService {

        private $conn;

        public function __construct($conn){
            $this->conn = $conn;
        }

        public function createOtp($email, $password, $name, $action){

            $otp = rand(100000,999999);
            $_SESSION['action'] =  $action;
            $_SESSION['otp'] = $otp;
            if ($action === "register"){
                $_SESSION['register_email'] = $email;
                $_SESSION['register_password'] = $password;
                $_SESSION['register_name'] = $name;
            }else if ($action === "forgetPassword"){
                $_SESSION['forget_email'] = $email;
            }else{
                return;
            }
            return $otp;
        }

        public function verifyOtp($inputOtp){
            $action = $_SESSION['action'];
            if(!isset($_SESSION['otp'])){
                return "OTP đã hết hạn";
            }

            if($_SESSION['otp'] != $inputOtp){
                return "OTP không đúng";
            }

            if ($action == 'register'){
                $email = $_SESSION['register_email'];
                $password = $_SESSION['register_password'];
                $name = $_SESSION['register_name'];

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $id = uniqid(null,true);
                $role = "customer";

                $stmt = $this->conn->prepare(
                    "INSERT INTO user (email,password,name,id,role) VALUES (?,?,?,?,?)"
                );

                $stmt->bind_param("sssss",$email,$hashedPassword,$name,$id,$role);

                if($stmt->execute()){
                    unset($_SESSION['otp']);
                    return true;
                }

                return "Tạo tài khoản thất bại";
            }else if ($action === 'forgetPassword'){
                header('Location: ./newPassword.php');
                return false;
            }
            return false;
        }
        public function forgetPassword($email){
            $stmt = $this->conn->prepare("SELECT EMAIL FROM USER WHERE EMAIL ='".$email."'");
            if($stmt->execute()){
                return $stmt->get_result()->fetch_assoc();
            }
        }
        public function newPassword(){
                $email = $_SESSION['forget_email'];
                $password = $_SESSION['forget_password'];
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = 'UPDATE USER SET PASSWORD = ? WHERE EMAIL = ? ';
                $stmt = $this->conn->prepare($sql);
                if (!$stmt) {
                    die("SQL Error: " . $this->conn->error);
                }
                $stmt->bind_param("ss",$hashedPassword, $email );
                if( $stmt->execute()){
                    unset($_SESSION['otp']);
                    unset($_SESSION['forget_password']);
                    unset($_SESSION['forget_email']);
                    return true;
                }
                return false;
        }

        public function validationRegister($email, $password, $name, $confirmPassword){
            $stmt = $this->conn->prepare("SELECT id FROM user WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0){
                return "Email đã tồn tại";
            }
            if (
                trim($email) === "" ||
                trim($password) === "" ||
                trim($name) === "" ||
                trim($confirmPassword) === ""
            ){
                return "Vui lòng nhập đầy đủ thông tin";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                return "Email không hợp lệ";
            }

            if ($password !== $confirmPassword){
                return "Mật khẩu xác nhận không khớp";
            }

            if (strlen($password) < 6){
                return "Mật khẩu phải >= 6 ký tự";
            }

            return true;
        }

        public function register($email, $password, $name, $confirmPassword){

            $validation = $this->validationRegister($email, $password, $name, $confirmPassword);

            if ($validation !== true){
                return $validation;
            }

            // kiểm tra email tồn tại

            // hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $id = uniqid();
            $default_role = "customer";
            // insert user
            $stmt = $this->conn->prepare(
                "INSERT INTO user (email, password, name, id, role) VALUES (?, ?, ?, ?, ?)"
            );

            $stmt->bind_param("sssss", $email, $hashedPassword, $name, $id, $default_role);

            if ($stmt->execute()){
                return true;
            }

            return "Đăng ký thất bại";
        }

        public function login($email, $password){
            if ($email === "" || $password === "") {
                return "Vui lòng điền đầy đủ thông tin";
            }

            $stmt = $this->conn->prepare("SELECT id, password, name, role FROM user WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0){
                return "Email không tồn tại";
            }

            $user = $result->fetch_assoc();
    
            if (password_verify($password, $user['password'])){
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_email'] = $email;
                return true;
            } else {
                return "Mật khẩu không đúng";
            }
        }

        public function changeProfile($new_email, $new_name){
            $id = $_SESSION['user_id'];
            if (!$id){
                die('Lỗi!!!!!');
            }
            if ($new_email){
                echo "Đây là new_email".$new_email;
                $sql = "SELECT EMAIL FROM USER WHERE EMAIL ='".$new_email."'";
                $stmt = $this->conn->prepare($sql);
                $checkMail = $stmt->execute();
                $checkMail = $checkMail->get_result();
                if ($checkMail->num_rows > 0){
                    return "Email đã tồn tại";
                }else{
                    $sql = "UPDATE USER SET EMAIL = '".$new_email."' WHERE ID ='".$id."'";
                    $stmt = $this->conn->prepare($sql);
                    if (!$stmt->execute()){
                        return false;
                    }
                }   
                
            }
            if ($new_name){
                echo "Đây là new_name".$new_name;
                $sql = "UPDATE 'user' SET NAME = '".$new_name."' WHERE id ='".$id."'";
                $stmt = $this->conn->prepare($sql);
                if (!$stmt->execute()){
                    return false;
                }
            }
            $stmt = $this->conn->prepare("SELECT * FROM user WHERE id = '".$id."'");
            if(!$stmt->execute()){
                return false;
            }
            $user = $stmt->get_result()->fetch_assoc();
            echo json_encode($user);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_email'] = $user['email'];
            return true;
        }
    }
?>