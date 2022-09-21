<?php
include_once "connect.php";

if (isset($_POST['fname'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $check_password = $_POST['check_password'];

    $err = [];
    if ($password != $check_password) {
        $err['check_password'] = '* Again password error';
    }
    if (empty($err)) {
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO nguoidung(Ho,Ten,SDT,Email,TaiKhoan,MatKhau,MaQuyen,TrangThai) VALUE ('$fname','$lname','$number','$email','$username','$pass','1','1')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            header('location: ../views/login.php');
        }
    }
}

?>