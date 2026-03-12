<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "nxhk_web_db";

    $conn = new mysqli($host, $user, $password, $database);
    if ($conn->connect_error) {
        die("Kết nối database thất bại: " . $conn->connect_error);
    }

    // set charset utf8
    $conn->set_charset("utf8");

?>