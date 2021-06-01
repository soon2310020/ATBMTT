<?php
session_start();
if (!isset($_SESSION['username']))
{
    header("location:login.php");
    exit();
}
echo "Đăng nhập thành công tên bạn là:";
echo $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="all.css"/>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css"/>
    <title>Home</title>
</head>
<body>
<br>
<a href="logout.php" class="btn-dark btn">Đăng xuất</a>
</body>
</html>
