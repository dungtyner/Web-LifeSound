<?php
include_once "connect.php";
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM nguoidung WHERE Taikhoan = '$username'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);
    $checkUser = mysqli_num_rows($query);
    if ($checkUser == 1) {

        // Save session
        $_SESSION['user'] = $data;
        header('location: ../index.php');
    }
    else {
     
        setcookie('msg', "Username doesn't exist.", time() + 2);
        header('Location:  ../views/login.php');
    }
    // Start Cookie
// if(isset($_POST['remember'])){
//     setcookie("username", $username);
//     setcookie("password", $password);
// }
// $username ="";
// $password ="";
// $checkRemember = false;
// if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
//     $username = $_COOKIE['username'];
//     $password = $_COOKIE['password'];
//     $checkRemember= true;
// }
if(!empty($_POST["remember"]) and ($_POST['remember']=="on")) {
	setcookie ("username",$_POST["username"],time()+ 3600);
	setcookie ("password",$_POST["password"],time()+ 3600);
} else {
	setcookie("username","");
	setcookie("password","");
}
}

?>