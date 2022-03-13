<?php 
session_start();
require_once "DBconnection.php";
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM wallets WHERE id = $id";
    $result = mysqli_query($conn,$sql);
    $wallet = mysqli_fetch_assoc($result);
    echo "<pre>";
    print_r($wallet);
    echo "</pre>";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>HOME</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>
    <h1>Hello, <?php echo $_SESSION['name']; ?></h1>
    <h2>Balance: <?php echo "$".$wallet['balance'] ?></h2>
    <a href="logout.php">Logout</a>
</body>
</html>
<?php 

}else{

    header("Location: login.php");

    exit();

}

?>