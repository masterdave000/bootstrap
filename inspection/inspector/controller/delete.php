<?php 

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_inspector_id = filter_var($_GET['inspector_id'], FILTER_SANITIZE_NUMBER_INT);
    $inspector_id = filter_var($clean_inspector_id, FILTER_VALIDATE_INT);
}

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