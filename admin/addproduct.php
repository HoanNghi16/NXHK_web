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

$cate_sql = "SELECT category_name FROM categories WHERE category_id = '".$danhmuc."'";
$cate_result = mysqli_query($conn, $cate_sql);
$cate_name = mysqli_fetch_assoc($cate_result)['category_name']; 

echo $new_id;
echo $cate_name;

$sql="INSERT INTO product (`product_id`, `category_id`, `product_name`, `price`, `description`, `specifications`, `quantity`) 
VALUES ('".$new_id."','".$danhmuc."','".$name."','".$price."','".$description."','".$specifications."','".$quantity."');";
$result = mysqli_query($conn, $sql);
 
 // xử lý ảnh
$countfiles = count($_FILES['anhs']['name']);
$imgs = '';
$target_dir = "../img/product/".$cate_name."/".$new_id."/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
for ($i = 0; $i < $countfiles; $i++) {
    $filename = $_FILES['anhs']['name'][$i];
    $location =  $target_dir . $filename;
    echo $location;
    $extension = strtolower(pathinfo($location, PATHINFO_EXTENSION));
    $valid_extensions = ["jpg", "jpeg", "png"];
    if (in_array($extension, $valid_extensions)) {
        if (move_uploaded_file($_FILES['anhs']['tmp_name'][$i], $location)) {
            echo "đã upload";
            $is_thumb = ($i == 0) ? 1 : 0;
            $sql_img = "INSERT INTO product_images (product_id ,path, is_thumbnail)
                        VALUES ('".$new_id."','/nxhk_web/img/product/".$cate_name."/". $new_id ."/".$filename."', ".$is_thumb.");";
            mysqli_query($conn, $sql_img);
        }
    }
}
$imgs = rtrim($imgs, ";");

// redirect
header("Location: listsanpham.php");
exit; 
?>