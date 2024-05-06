<?php

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inspector_firstname = htmlspecialchars(trim(ucwords($_POST['inspector_firstname'])));
    $inspector_midname = htmlspecialchars(trim(ucwords($_POST['inspector_midname'])));
    $inspector_lastname = htmlspecialchars(trim(ucwords($_POST['inspector_lastname'])));
    $inspector_suffix = htmlspecialchars(trim(ucwords($_POST['inspector_suffix'])));
    $fullname = trim($inspector_firstname . ' ' . $inspector_midname . ' ' . $inspector_lastname . ' ' . $inspector_suffix);
    $contact_number = trim($_POST['contact_number']);
    $clean_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = strtolower(trim(filter_var($clean_email, FILTER_VALIDATE_EMAIL)));

    $img_name = basename($_FILES['inspector_img_url']['name']);
    $temp_name = $_FILES['inspector_img_url']['tmp_name'];
    $img_size = $_FILES['inspector_img_url']['size'];
    $max_size = 1024 * 1024;

    $img_extension = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    $allowed_types = ['jpeg', 'png', 'jpg'];
    $folder_path = "./../images/";
    $filename = $inspector_lastname . '-' . $inspector_firstname . '(' . date('m-d-Y') . ').png';

    $inspector_img_url = 'default.png';

    if ($img_name) {
        if (!in_array($img_extension, $allowed_types)) {
            $_SESSION['error'] = "Only JPEG, JPG, and PNG files are allowed.";
        } elseif ($img_size >= $max_size) {
            $_SESSION['error'] = "File size must be less than 1MB.";
        } else {
            $upload = $filename;
            move_uploaded_file($temp_name, $folder_path . $upload);
            $inspector_img_url = $upload;
        }

        // Redirect to the form file with an error message
        if (isset($_SESSION['error'])) {
            header("Location: ../add-inspector.php");
            exit();
        }
    }
}

$inspectorDuplicate = "SELECT inspector_id FROM inspector WHERE inspector_firstname = :inspector_firstname AND inspector_midname = :inspector_midname AND inspector_lastname = :inspector_lastname AND inspector_suffix = :inspector_suffix";
$inspectorStatement = $pdo->prepare($inspectorDuplicate);
$inspectorStatement->bindParam(':inspector_firstname', $inspector_firstname);
$inspectorStatement->bindParam(':inspector_midname', $inspector_midname);
$inspectorStatement->bindParam(':inspector_lastname', $inspector_lastname);
$inspectorStatement->bindParam(':inspector_suffix', $inspector_suffix);
$inspectorStatement->execute();

$inspectorCount = $inspectorStatement->rowCount();

if ($inspectorCount > 0) {
    $_SESSION['duplicate'] = "
    <div class='msgalert alert--danger' id='alert'>
        <div class='alert__message'>	
            $fullname Record Already Exist
        </div>
    </div>
    
    ";

    header('location:' . SITEURL . 'inspection/inspector/add-inspector.php');
    exit;
}

$insertOwner = "INSERT INTO inspector (
            inspector_firstname,
            inspector_midname,
            inspector_lastname,
            inspector_suffix,
            contact_number,
            email,
            inspector_img_url
            ) 
            VALUES (
            :inspector_firstname,
            :inspector_midname,
            :inspector_lastname,
            :inspector_suffix,
            :contact_number,
            :email,
            :inspector_img_url
)";

$inspectorStatement = $pdo->prepare($insertOwner);
$inspectorStatement->bindParam(':inspector_firstname', $inspector_firstname);
$inspectorStatement->bindParam(':inspector_midname', $inspector_midname);
$inspectorStatement->bindParam(':inspector_lastname', $inspector_lastname);
$inspectorStatement->bindParam(':inspector_suffix', $inspector_suffix);
$inspectorStatement->bindParam(':contact_number', $contact_number);
$inspectorStatement->bindParam(':email', $email);
$inspectorStatement->bindParam(':inspector_img_url', $inspector_img_url);

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
