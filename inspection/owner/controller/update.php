<?php 

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_owner_id = filter_var($_POST['owner_id'], FILTER_SANITIZE_NUMBER_INT);
    $owner_id = filter_var($clean_owner_id, FILTER_VALIDATE_INT);
    $owner_name = htmlspecialchars(trim(ucwords($_POST['owner_name'])));
    $contact_no = trim($_POST['contact_no']);
}

$updateOwnerQuery = "UPDATE owner SET
        owner_name = :owner_name,
        contact_no = :contact_no
        WHERE owner_id = :owner_id 
";

$updateOwnerStatement = $pdo->prepare($updateOwnerQuery);
$updateOwnerStatement->bindParam(':owner_id', $owner_id);
$updateOwnerStatement->bindParam(':owner_name', $owner_name);
$updateOwnerStatement->bindParam(':contact_no', $contact_no);

if ($updateOwnerStatement->execute()) {
    $_SESSION['update'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Owner Updated Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/owner/');
} else {
    $_SESSION['update'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Update Owner
            </div>
        </div>
    ";

    header('location:' . SITEURL . "inspection/owner/update-owner.php?owner_id='$owner_id'");
}