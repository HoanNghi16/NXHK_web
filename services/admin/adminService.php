<?php
    class AdminService{
        private $conn;
        public function __construct($conn){
            $this->conn = $conn;
        }
        function loginAdmin($email, $password){
            $sql = "SELECT * FROM USER WHERE EMAIL= '".$email."' && role = 'ADMIN";
        }
    }
?>