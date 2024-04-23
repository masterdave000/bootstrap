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
        //Redirecting to the manage owner page.
        header('location:' . SITEURL . 'inspection/owner/');
        exit;
    }

}

$clean_owner_id = filter_var($_POST['owner_id'], FILTER_SANITIZE_NUMBER_INT);
$owner_id = filter_var($clean_owner_id, FILTER_VALIDATE_INT);


if (filter_has_var(INPUT_POST, 'owner_id')) { 

    $deleteOwnerQuery = "DELETE FROM owner WHERE owner_id = :owner_id";
    $deleteOwnerStatement = $pdo->prepare($deleteOwnerQuery);
    $deleteOwnerStatement->bindParam(':owner_id', $owner_id);

    if ($deleteOwnerStatement->execute()) {
        //Creating SESSION variable to display message.
        $_SESSION['delete'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Owner Deleted Successfully
            </div>
        </div>
        ";
        //Redirecting to the manage owner page.
        header('location:' . SITEURL . 'inspection/owner/');
    } else {
        //Creating SESSION variable to display message.
        $_SESSION['delete'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>
                Failed to Delete Owner, Please try again
            </div>
        </div>

        ";
        //Redirecting to the manage owner page.
        header('location:' . SITEURL . 'inspection/owner/');
    }
    
} else {
    $_SESSION['id_not_found'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>
                Owner ID Not Found
            </div>
        </div>

    ";
    //Redirecting to the manage user page.
    header('location:' . SITEURL . 'inspection/owner/');
}