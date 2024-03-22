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
    }

}

if (filter_has_var(INPUT_POST, 'inspector_id')) {
    $clean_inspector_id = filter_var($_POST['inspector_id'], FILTER_SANITIZE_NUMBER_INT);
    $inspector_id = filter_var($clean_inspector_id, FILTER_VALIDATE_INT);

    $deleteOwnerQuery = "DELETE FROM inspector WHERE inspector_id = :inspector_id";
    $deleteOwnerStatement = $pdo->prepare($deleteOwnerQuery);
    $deleteOwnerStatement->bindParam(':inspector_id', $inspector_id);

    if ($deleteOwnerStatement->execute()) {
        //Creating SESSION variable to display message.
        $_SESSION['delete'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Owner Deleted Successfully
            </div>
        </div>
        ";
        //Redirecting to the manage inspector page.
        header('location:' . SITEURL . 'inspection/inspector/');
    } else {
        //Creating SESSION variable to display message.
        $_SESSION['delete'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>
                Failed to Delete Owner, Please try again
            </div>
        </div>

        ";
        //Redirecting to the manage inspector page.
        header('location:' . SITEURL . 'inspection/inspector/');
    }
} else {
    $_SESSION['id_not_found'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>
                Inspector ID Not Found
            </div>
        </div>

    ";
    //Redirecting to the manage user page.
    header('location:' . SITEURL . 'inspection/inspector/');
}