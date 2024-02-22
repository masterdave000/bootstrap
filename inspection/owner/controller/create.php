<?php 

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $owner_name = htmlspecialchars(trim(ucwords($_POST['owner_name'])));
    $contact_no = trim($_POST['contact_no']);
}

$insertOwner = "INSERT INTO owner (
            owner_name,
            contact_no
            ) 
            VALUES (
            :owner_name,
            :contact_no
)";

$ownerStatement = $pdo->prepare($insertOwner);
$ownerStatement->bindParam(':owner_name', $owner_name);
$ownerStatement->bindParam(':contact_no', $contact_no);

if ($ownerStatement->execute()) {
    $_SESSION['add'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Owner Added Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/owner/');
} else {
    $_SESSION['add'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Add Owner
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/owner/add-owner.php');
}