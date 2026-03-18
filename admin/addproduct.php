<?php
// require_once __DIR__ . '/../config/database.php'; 
//             $sql = "INSERT INTO product";
//             $result = mysqli_query($conn, $sql);

// // Lấy dữ liệu
$name = $_POST['name'];
$description = $_POST['description'];
$specifications = $_POST['specifications'];
$price= $_POST['price'];
$quantity=$_POST['quantity'];
$danhmuc = $_POST['danhmuc'];

//insert dl

require_once __DIR__ . '/../config/database.php'; 
        
//lay dl tu form 

//cau lenh them vao bang    
$max_id_sql = "SELECT MAX(product_id) AS max_id FROM product";
$result = mysqli_query($conn, $max_id_sql);
$row = mysqli_fetch_assoc($result);
$new_id = $row['max_id'] + 1;


$sql="INSERT INTO product (`product_id`, `category_id`, `product_name`, `price`, `description`, `specifications`, `quantity`) 
VALUES ('".$new_id."','".$danhmuc."','".$name."','".$price."','".$description."','".$specifications."','".$quantity."');";
$result = mysqli_query($conn, $sql);
 
 // xử lý ảnh
$countfiles = count($_FILES['anhs']['name']);
$imgs = '';

for ($i = 0; $i < $countfiles; $i++) {

    $filename = $_FILES['anhs']['name'][$i];
    $location = "uploads/" . uniqid() . "_" . $filename;

    $extension = strtolower(pathinfo($location, PATHINFO_EXTENSION));
    $valid_extensions = ["jpg", "jpeg", "png"];

    if (in_array($extension, $valid_extensions)) {
        if (move_uploaded_file($_FILES['anhs']['tmp_name'][$i], $location)) {
            $imgs .= $location . ";";
        }
    }
}
$imgs = rtrim($imgs, ";");

// redirect
header("Location: listsanpham.php");
exit; 
?>