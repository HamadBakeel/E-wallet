<?php
    session_start();

    require_once 'component.php';
    require_once 'createDB.php';
    // require_once '../DBconnection.php';
    // session_start();
    $balance = $_SESSION['balance'];
    $db = new CreateDB('ProductDB','producttb');

    if(isset($_POST['remove'])){
        if($_GET['action']== 'remove'){
            foreach($_SESSION['cart'] as $key => $value):
                if($value['product_id']== $_GET['id'])
                unset($_SESSION['cart'][$key]);
            endforeach;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../assets/bootstrap.css">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/all.min.css">
</head>
<body>
    <?php require_once 'header.php'?>
    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                    <h6>Cart</h6>
                    <hr>
                    <?php
                        $total =0;
                        if(isset($_SESSION['cart'])){
                            $product_ids= array_column($_SESSION['cart'],'product_id');
                            $products = $db->getData();
                            while($product = mysqli_fetch_assoc($products)){
                                foreach ($product_ids as $id):
                                    if($product['id'] == $id){
                                        cartProuct($product['product_image'],$product['product_name'],$product['product_price'],$product['id']);
                                        $total += (int)$product['product_price'];
                                    }
                                endforeach;
                            }
                        }else echo "Cart Is Empty";
                    ?>
                </div>
            </div>
            <div class="col-md-5  border rounded mt-5 h-25 bg-white">
                <div class="pt-4">
                    <h6>PRICE DETAILS</h6>
                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php 
                                if(isset($_SESSION['cart'])){
                                    $count = count($_SESSION['cart']);
                                    echo ("Price ($count items)");
                                }else{
                                    echo ("Price (0 items)");
                                }
                            ?>
                            <h6>Delivery Charges</h6>
                            <hr>
                            <h6>Amount Payable</h6>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-0"><?php echo "$$total";?></h6>
                            <h6 class="mb-0 pb-0 text-success">FREE</h6>
                            <hr>
                            <h6 class="mb-0"><?php echo "$$balance";?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/bootstrap.bundle.js"></script>
</body>
</html>