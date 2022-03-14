<?php 
session_start();
require_once "DBconnection.php";
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM wallets WHERE user_id = $id";
    $result = mysqli_query($conn,$sql);
    $wallet = mysqli_fetch_assoc($result);
    $balance = $wallet['balance'];
    $_SESSION['balance'] = $balance;
    if(isset($_POST['deposition'])){
        $depostionAmount = $_POST['depositionAmount']+$balance;
        $sql = "UPDATE wallets SET balance =$depostionAmount WHERE user_id = $id";
        if(!mysqli_query($conn,$sql)){
            echo "Depostion Failed: ".mysqli_error();
        }

        echo "<script>window.location = 'index.php'</script>";
    }   
    if(isset($_POST['withdraw'])){
        if($_POST['withdrawalAmount'] > $balance){
            echo "  <script>
        $(`<div class=\"alert alert-danger d-flex align-items-center\" role=\"alert\">
            <svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Danger:\"><use xlink:href=\"#exclamation-triangle-fill\"/></svg>
            <div>
                Invalid operation: Not Enough Balance
            </div>
        </div>`).insertBefore('.modal input');
        </script>";
        }else{
            $withdrawalAmount = $balance - $_POST['withdrawalAmount'];
            $sql = "UPDATE wallets SET balance =$withdrawalAmount WHERE user_id = $id";
            if(!mysqli_query($conn,$sql)){
                echo "Deposition Failed: ".mysqli_error();
            }
        }
        echo "<script>window.location = 'index.php'</script>";
    }

        $sql = "SELECT * FROM wallets WHERE user_id = $id";
        $result = mysqli_query($conn,$sql);
        $wallet = mysqli_fetch_assoc($result);
        $balance = $wallet['balance'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/all.min.css">
</head>
<body class="d-flex justigy-content-center flex-column px-3 ">
    <h1>Hello, <?php echo $_SESSION['name']; ?></h1>
    <h2>Balance: <?php echo "$".$balance ?></h2>
    <div class = "mt-4">
        <button type="button" class="btn btn-primary depositionButton" style="width: fit-content" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Deposit <i class="fa-solid fa-circle-dollar-to-slot"></i>
        </button>
        <button type="button" class="btn btn-warning withdrawButton" style="width: fit-content" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Withdraw <i class="fa-solid fa-hand-holding-dollar"></i>
        </button>
    </div>
    <div class="mt-4 d-flex flex-column gap-3 ">
        <a href="shop.php" class="btn btn-secondary" style="width: fit-content" >Go Shopping <i class="fa-solid fa-shopping-basket"></i></a>
        <a href="logout.php" class="btn btn-danger" style="width: fit-content">Logout <i class="fa-solid fa-right-from-bracket"></i></a>
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Insert an amount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="index.php" method="post">
                <div class="modal-body">
                    <input type="number"  name="withdrawalAmount" id="" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="withdraw" class="btn btn-primary">Withdraw</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script src="assets/bootstrap.bundle.js"></script>
    <script src="assets/jQuery.min.js"></script>
    <script>
        $('.depositionButton').click(function(){
            $('.modal').html(`
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Insert an amount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="depositionForm" action="index.php" method="post">
                <div class="modal-body">
                    <input type="number" name="depositionAmount" id="" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="deposition" class="btn btn-primary">Deposite</button>
                </div>
            </form>
            </div>
        </div>`);
        })
        $
    </script>
  
</body>
</html>
<?php 
}else{
    header("Location: login.php");
    exit();
}?>