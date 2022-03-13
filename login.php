<?php
    require_once 'DBconnection.php';

session_start(); 


// if (isset($_POST['uname']) && isset($_POST['password'])) {
if (isset($_POST['login'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    if (empty($uname)) {
        header("Location: index.php?error=User Name is required");
        exit();
    }else if(empty($pass)){
        header("Location: index.php?error=Password is required");
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
                echo "Logged in!";
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header("Location: index.php");
                // echo "correct credintials";
                exit();
            }else{
                // header("Location: index.php?error=Incorect User name or password");
                echo "incorrect user name or password 1";
                // exit();
            }
        }else{
            // header("Location: index.php?error=Incorect User name or password");
            echo "incorrect user name or password 2";

            // exit();
        }
    }
}else{
    // header("Location: index.php");
    // exit();
}?>
<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

    <form action="login.php" method="post">
        <h2>LOGIN</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>User Name</label>
        <input type="text" name="uname" placeholder="User Name"><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br> 
        <script></script>
        <button type="submit" name="login">Login</button>
    </form>

</body>

</html>