<?php 

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inspector_name = htmlspecialchars(trim(ucwords($_POST['inspector_name'])));
    $contact_no = trim($_POST['contact_no']);
}

$insertOwner = "INSERT INTO inspector (
            inspector_name,
            contact_no
            ) 
            VALUES (
            :inspector_name,
            :contact_no
)";

$inspectorStatement = $pdo->prepare($insertOwner);
$inspectorStatement->bindParam(':inspector_name', $inspector_name);
$inspectorStatement->bindParam(':contact_no', $contact_no);

if ($inspectorStatement->execute()) {
    $_SESSION['add'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Owner Added Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/inspector/');
} else {
    $_SESSION['add'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Add Owner
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/inspector/add-inspector.php');
}