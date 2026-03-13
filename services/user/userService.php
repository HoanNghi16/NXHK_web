<?php
    class UserService {

        private $conn;

        public function __construct($conn){
            $this->conn = $conn;
        }

        public function createOtp($email, $password, $name){

            $otp = rand(100000,999999);

            $_SESSION['otp'] = $otp;
            $_SESSION['register_email'] = $email;
            $_SESSION['register_password'] = $password;
            $_SESSION['register_name'] = $name;

            return $otp;
        }

        public function verifyOtp($inputOtp){

            if(!isset($_SESSION['otp'])){
                return "OTP đã hết hạn";
            }

            if($_SESSION['otp'] != $inputOtp){
                return "OTP không đúng";
            }

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
    }
?>