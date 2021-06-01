<?php
require_once 'connection.php';
session_start();
$con = new Connection();
$conn = $con->getConnection();
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
if (isset($_SESSION['username']))
{
    header("location:home.php");
    exit();
}
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $error = "";
    $success = "";
    if (empty($username)) {
        $error = "Vui lòng nhập tên đăng nhập";

    } else if (empty($password)) {
        $error = "Vui lòng nhập mật khẩu";


    }
    else
    {
        $password=md5($password);
        //code lỗi
        $obj_select = $conn
            ->prepare("SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1");
        $obj_select->execute();
        //hết code lỗi
        //code sửa lỗi
//        $username=htmlspecialchars($username);
//        $obj_select = $conn
//            ->prepare("SELECT * FROM users WHERE username=:username AND password=:password LIMIT 1");
//        $arr_select = [
//            ':username' => $username,
//            ':password' => $password,
//        ];
//        $obj_select->execute($arr_select);
        //hết sửa lỗi
        $user = $obj_select->fetch(PDO::FETCH_ASSOC);
        if(!empty($user))
        {
            $_SESSION['username']=$user['username'];
            header("location:home.php");
            exit();
        }
        else {
            $error = "Sai tên hoặc mật khẩu";
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="all.css"/>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css"/>
    <title>Login</title>
    <style>
        :root {
            --input-padding-x: 1.5rem;
            --input-padding-y: .75rem;
        }

        body {
            background: #007bff;
            background: linear-gradient(to right, #0062E6, #33AEFF);
        }

        .card-signin {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        }

        .card-signin .card-title {
            margin-bottom: 2rem;
            font-weight: 300;
            font-size: 1.5rem;
        }

        .card-signin .card-body {
            padding: 2rem;
        }

        .form-signin {
            width: 100%;
        }

        .form-signin .btn {
            font-size: 80%;
            border-radius: 5rem;
            letter-spacing: .1rem;
            font-weight: bold;
            padding: 1rem;
            transition: all 0.2s;
        }

        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-label-group input {
            height: auto;
            border-radius: 2rem;
        }

        .form-label-group > input,
        .form-label-group > label {
            padding: var(--input-padding-y) var(--input-padding-x);
        }

        .form-label-group > label {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            margin-bottom: 0;
            /* Override default `<label>` margin */
            line-height: 1.5;
            color: #495057;
            border: 1px solid transparent;
            border-radius: .25rem;
            transition: all .1s ease-in-out;
        }

        .form-label-group input::-webkit-input-placeholder {
            color: transparent;
        }

        .form-label-group input:-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-moz-placeholder {
            color: transparent;
        }

        .form-label-group input::placeholder {
            color: transparent;
        }

        .form-label-group input:not(:placeholder-shown) {
            padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
            padding-bottom: calc(var(--input-padding-y) / 3);
        }

        .form-label-group input:not(:placeholder-shown) ~ label {
            padding-top: calc(var(--input-padding-y) / 3);
            padding-bottom: calc(var(--input-padding-y) / 3);
            font-size: 12px;
            color: #777;
        }

        .btn-google {
            color: white;
            background-color: #ea4335;
        }

        .btn-facebook {
            color: white;
            background-color: #3b5998;
        }

        /* Fallback for Edge
        -------------------------------------------------- */

        @supports (-ms-ime-align: auto) {
            .form-label-group > label {
                display: none;
            }

            .form-label-group input::-ms-input-placeholder {
                color: #777;
            }
        }

        /* Fallback for IE
        -------------------------------------------------- */

        @media all and (-ms-high-contrast: none),
        (-ms-high-contrast: active) {
            .form-label-group > label {
                display: none;
            }

            .form-label-group input:-ms-input-placeholder {
                color: #777;
            }
        }
    </style>

</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Đăng Nhập</h5>

                    <?php if (!empty($error)) {
                        echo "<div class='alert alert-danger'>$error </div>";
                    } ?>
                    <?php

                    ?>
                    <form class="form-signin" action="" method="post">
                        <div class="form-label-group">
                            <input type="text" id="inputEmail" class="form-control" placeholder="Tên ĐĂng Nhập"
                                   name="username" value="<?php if (!empty($username)) {
                                echo htmlspecialchars($username);
                            } ?>">
                            <label for="inputEmail">Tên Đăng Nhập</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="inputPassword" class="form-control" placeholder="Mật Khẩu"
                                   name="password"/>

                            <label for="inputPassword">Mật Khẩu</label>
                        </div>

                       <div class="form-group row" >
                           <button class="btn  btn-primary col-6" type="submit" name="login">
                               Đăng nhập
                           </button>
                           <a class="btn btn-google col-6"  href="Register.php">
                               Đăng ký
                           </a>
                       </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="jquery.min.js"/>
<script type="text/javascript" src="jquery-ui.min.js"/>
<script type="text/javascript" src="bootstrap.min.js"/>
<script>
</script>
</html>