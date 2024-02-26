<?php 

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_owner_id = filter_var($_GET['owner_id'], FILTER_SANITIZE_NUMBER_INT);
    $owner_id = filter_var($clean_owner_id, FILTER_VALIDATE_INT);
}

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