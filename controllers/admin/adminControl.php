<?php
    require_once '../../config/database.php';
    include ('../../services/admin/adminService.php');
    class AdminControl{
        function login($email, $password){
            $adminService = new AdminService($GLOBALS['conn']);
            $admin = $adminService->loginAdmin($email, $password);
            if($admin){
                session_start();
                $_SESSION["user"] = $admin;
                return true;

        }
    }
    }
?>