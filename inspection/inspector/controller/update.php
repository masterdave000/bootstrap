<?php 

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_inspector_id = filter_var($_POST['inspector_id'], FILTER_SANITIZE_NUMBER_INT);
    $inspector_id = filter_var($clean_inspector_id, FILTER_VALIDATE_INT);
    $inspector_name = htmlspecialchars(trim(ucwords($_POST['inspector_name'])));
    $contact_no = trim($_POST['contact_no']);
}

$updateOwnerQuery = "UPDATE inspector SET
        inspector_name = :inspector_name,
        contact_no = :contact_no
        WHERE inspector_id = :inspector_id 
";

$updateOwnerStatement = $pdo->prepare($updateOwnerQuery);
$updateOwnerStatement->bindParam(':inspector_id', $inspector_id);
$updateOwnerStatement->bindParam(':inspector_name', $inspector_name);
$updateOwnerStatement->bindParam(':contact_no', $contact_no);

if ($updateOwnerStatement->execute()) {
    $_SESSION['update'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Owner Updated Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/inspector/');
} else {
    $_SESSION['update'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Update Owner
            </div>
        </div>
    ";

    header('location:' . SITEURL . "inspection/inspector/update-inspector.php?inspector_id='$inspector_id'");
}