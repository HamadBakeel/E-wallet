<?php
    require_once('php/component.php');
    require_once('php/createDB.php');

    // create instance of CreateDB class
    $database = new CreateDB("ProductDB","producttb");

    session_start();

    if(isset($_POST['add'])){
        if(isset($_SESSION['cart'])){
            $item_array_id = array_column($_SESSION['cart'],"product_id");
            // print_r($item_array_id);

            if(in_array($_POST['product_id'],$item_array_id)){
                echo "<script>alert('This item has already been added to the cart')</script>";
                echo "<script>window.location = 'shop.php'</script>";
            }else{
                $count = count($_SESSION['cart']);
                $item_array = array('product_id' => $_POST['product_id']);
                $_SESSION['cart'][$count] = $item_array;
                // print_r($_SESSION['cart']);
            }

        }else{
            $item_array = array('product_id'=> $_POST['product_id']);
            // create a new session variable
            $_SESSION['cart'][0]=$item_array;
        }
    }
    // session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/all.min.css">
</head>
<body>
    <?php require_once 'php/header.php'?>
    <div class="container">
        <div class="row text-center py-5">
            <?php 
                $products = $database->getData();
                while($product = mysqli_fetch_assoc($products)){
                    component($product['product_name'],$product['product_price'],$product['product_image'],$product['id']);
                }
            ?>
        </div>
    </div>
    <script src="assets/bootstrap.bundle.js"></script>
</body>
</html>