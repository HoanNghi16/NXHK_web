<?php

    $host = "sql211.iceiy.com";
    $user = "icei_41428851";
    $password = "vyYwneBg4sUu";
    $database = "icei_41428851_nxhk_web_db";

    $conn = new mysqli($host, $user, $password, $database);
    if ($conn->connect_error) {
        die("Kết nối database thất bại: " . $conn->connect_error);
    }

    // set charset utf8
    $conn->set_charset("utf8");

?>