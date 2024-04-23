<?php

include './../../../config/constants.php';

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
        header('location:' . SITEURL . 'inspection/business/');
        exit;
    }
    
}

//Get the id to be deleted
if (filter_has_var(INPUT_POST, 'bus_id')) { 
    $clean_id = filter_var($_POST['bus_id'], FILTER_SANITIZE_NUMBER_INT);
    $bus_id = filter_var($clean_id, FILTER_VALIDATE_INT);

    //SQL query to delete category
    $deletecategoryQuery = "DELETE FROM business WHERE bus_id = :bus_id";
    $deletecategoryStatement = $pdo->prepare($deletecategoryQuery);
    $deletecategoryStatement->bindParam(':bus_id', $bus_id, PDO::PARAM_INT);

    if ($deletecategoryStatement->execute()) {
        //Creating SESSION variable to display message.
        $_SESSION['delete'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Business Details Deleted Successfully
            </div>
        </div>
        ";
        //Redirecting to the manage business page.
        header('location:' . SITEURL . 'inspection/business/');
    } else {
        //Creating SESSION variable to display message.
        $_SESSION['delete'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>
                Failed to Delete Business Details, Please try again
            </div>
        </div>

        ";
        //Redirecting to the manage business page.
        header('location:' . SITEURL . 'inspection/business/');
    }
} else {

    $_SESSION['id_not_found'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>
                Business ID Not Found
            </div>
        </div>

        ";
        //Redirecting to the manage business page.
        header('location:' . SITEURL . 'inspection/business/');
}