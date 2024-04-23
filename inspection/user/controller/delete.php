<?php

include './../../../config/constants.php';

//Get the id to be deleted
if (filter_has_var(INPUT_POST, 'password')) {

    $password = md5($_POST['password']);

    $checkUser = "SELECT * FROM user_view WHERE password = :password";
    $checkStatement = $pdo->prepare($checkUser);
    $checkStatement->bindParam(':password', $password);
    $checkStatement->execute();

    if ($checkStatement->rowCount() === 0) {
        $_SESSION['invalid_password'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>
                Incorrect Password, Please try again
            </div>
        </div>

        ";
        //Redirecting to the manage user page.
        header('location:' . SITEURL . 'inspection/user/');
        exit;
    }
    
}

if (filter_has_var(INPUT_POST, 'user_id')) {
    $clean_id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
    $user_id = filter_var($clean_id, FILTER_VALIDATE_INT);

    //SQL query to delete user
    $deleteuserQuery = "DELETE FROM users WHERE user_id = :user_id";
    $deleteuserStatement = $pdo->prepare($deleteuserQuery);
    $deleteuserStatement->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($deleteuserStatement->execute()) {
        //Creating SESSION variable to display message.
        $_SESSION['delete'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                User Account Deleted Successfully
            </div>
        </div>
        ";
    //Redirecting to the manage user page.
    header('location:' . SITEURL . 'inspection/user/');
    } else {
        //Creating SESSION variable to display message.
        $_SESSION['delete'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>
                Failed to Delete User Account, Please try again
            </div>
        </div>

        ";
    //Redirecting to the manage user page.
    header('location:' . SITEURL . 'inspection/user/');
    }
} else {

    $_SESSION['id_not_found'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>
                User ID Not Found
            </div>
        </div>

    ";
    //Redirecting to the manage user page.
    header('location:' . SITEURL . 'inspection/user/');
}