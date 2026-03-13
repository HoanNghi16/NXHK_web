<?php
    session_start();
    include("../layout/layout.php");
    $layout = new Layout();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/products.css">
</head>
<body>
    <?php
        echo $layout->getHeader();
    ?>
    <div class="container">

    </div>
    <?php
        echo $layout->getFooter();
    ?>
</body>
</html>