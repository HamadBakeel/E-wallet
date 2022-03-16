<?php
    session_start();

    require_once 'component.php';
    require_once 'createDB.php';
    require_once '../DBconnection.php';
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

$balance = $_SESSION['balance'];
    $paymentError = false ;
    $db = new CreateDB('ProductDB','producttb');

    if(isset($_POST['remove'])){
            foreach($_SESSION['cart'] as $key => $value):
                if($value['product_id']== $_POST['productid'])
                unset($_SESSION['cart'][$key]);
            endforeach;
    }
    if(isset($_POST['pay'])){
        $total = $_SESSION['total'];
        if($total > $balance){
            $paymentError = true;
        }else{
            $withdrawalAmount = $balance - $total;
            $id = $_SESSION['id'];
            $sql = "UPDATE wallets SET balance =$withdrawalAmount WHERE user_id = $id";
            foreach($_SESSION['cart'] as $key => $value):
                unset($_SESSION['cart'][$key]);
            endforeach;
            if(!mysqli_query($conn,$sql)){
                echo "Failed To Withdraw: ".mysqli_error();
            }
            echo "<script>window.location = '../shop.php'</script>";
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
                                        $_SESSION['total'] = $total;
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
                            <h6>Payable Amount</h6>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-0"><?php echo "$$total";?></h6>
                            <h6 class="mb-0 pb-0 text-success">FREE</h6>
                            <hr>
                            <h6 class="mb-0"><?php echo "$$balance";?></h6>
                        </div>
                        <div class="col-md-6 d-flex flex-column align-items-center justify-content-center w-100">
                            <?php if($paymentError){
                                echo "
                                <div class=\"alert alert-danger d-flex align-items-center\" role=\"alert\">
                                    <svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Danger:\"><use xlink:href=\"#exclamation-triangle-fill\"/></svg>
                                    <div>
                                        Invalid operation: Not Enough Balance
                                    </div>
                                </div>
                                </br>";
                            }
                            ?>
                            <form action="cart.php" method="post">
                                <button class="btn rounded-pill px-4 fw-bold my-2 btn-success" name="pay" type="submit">Pay <i class="fa-solid fa-hand-holding-dollar"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/bootstrap.bundle.js"></script>
</body>
</html>

<?php
}else{
    header("Location: ../login.php");
    exit();
}
?>