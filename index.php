<?php 
ob_start();
require "./config/constants.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OBOS - Login</title>

    <!-- Custom fonts for this template-->
    <link rel="icon" type="image/x-icon" href="<?php echo SITEURL?>assets/img/lgu_logo.ico">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="./assets/css/style.css" rel="stylesheet">
    <link href="./assets/css/sb-admin-2.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="vh-100 d-flex align-items-center justify-content-center">

            <?php
                if (isset($_SESSION['incorrect-input'])) {
                    echo $_SESSION['incorrect-input'];
                    unset($_SESSION['incorrect-input']);
                }

                if (isset($_SESSION['error_login'])) {
                    echo $_SESSION['error_login'];
                    unset($_SESSION['error_login']);
                }

            ?>

            <div class="col-xl-12 col-lg-8 col-md-9 d-flex justify-content-center align-items-center login-flexgap">
                <div class="col-lg-4 login-image">
                    <img src="./assets/img/lgu_logo.png" class="img-fluid" alt="obos-logo">
                </div>
                <div class="card o-hidden border-0 shadow-lg my-5 col-lg-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
                                        class="user">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="exampleInputusername" aria-describedby="usernameHelp"
                                                placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="Password">
                                        </div>
                                        <input type="submit" name="submit" value="Login"
                                            class="btn btn-primary btn-user btn-block">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/js/main.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>

<?php

    if (filter_has_var(INPUT_POST, 'submit')) {
        $username = htmlspecialchars($_POST['username']);
        $password = md5($_POST['password']);
    
        //2.SQL to check whether the user with username and password exists or not
    
        $userQuery = "SELECT * FROM user_view WHERE username = :username AND password = :password";
        $userStatement = $pdo->prepare($userQuery);
        $userStatement->bindParam(':username', $username);
        $userStatement->bindParam(':password', $password);
        $userStatement->execute();
        $userCount = $userStatement->rowCount();
    
    
        if ($userCount === 1) {
            $user = $userStatement->fetch(PDO::FETCH_ASSOC);
            $_SESSION['login-success'] = "
            <div class='msgalert alert--success' id='alert'>
                <div class='alert__message'>
                    Sign in Successfully
                </div>
            </div>
            ";
    
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['inspector_img_url'] = $user['inspector_img_url'];
            $_SESSION['role'] = $user['role'];

            header('location:'.SITEURL.'inspection/dashboard/');
            
        } else {
            $_SESSION['incorrect-input'] = "
                <div class='msgalert alert--danger' id='alert'>
                    <div class='alert__message'>	
                        Sign in Failed, Please Enter Correct Username and Password.
                    </div>
                </div>
            ";

            header('location:' . SITEURL);
            exit;
        }
    }

    ob_flush();
?>