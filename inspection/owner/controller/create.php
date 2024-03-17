<?php 

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $owner_firstname = htmlspecialchars(trim(ucwords($_POST['owner_firstname'])));
    $owner_midname = htmlspecialchars(trim(ucwords($_POST['owner_midname'])));
    $owner_lastname = htmlspecialchars(trim(ucwords($_POST['owner_lastname'])));
    $owner_suffix = htmlspecialchars(trim(ucwords($_POST['owner_suffix'])));
    $contact_number = trim($_POST['contact_number']);
    $clean_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = strtolower(trim(filter_var($clean_email, FILTER_VALIDATE_EMAIL)));

    $img_name = basename($_FILES['owner_img_url']['name']);
    $temp_name = $_FILES['owner_img_url']['tmp_name'];
    $img_size = $_FILES['owner_img_url']['size'];
    $max_size = 1024 * 1024;

    $img_extension = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    $allowed_types = ['jpeg', 'png', 'jpg'];
    $folder_path = "./../images/";
    $filename = $owner_lastname . '-' . $owner_firstname. '(' . date('m-d-Y') . ').png';

    $owner_img_url = 'default.png';
    
    if ($img_name) {
        if (!in_array($img_extension, $allowed_types)) {
                $_SESSION['error'] = "Only JPEG, JPG, and PNG files are allowed.";
        } elseif ($img_size >= $max_size) {
                $_SESSION['error'] = "File size must be less than 1MB.";
        } else {
                $upload = $filename;
                move_uploaded_file($temp_name, $folder_path . $upload);
                $owner_img_url = $upload;
        }

        // Redirect to the form file with an error message
        if (isset($_SESSION['error'])) {
                header("Location: ../add-owner.php");
                exit();
        }

    }
    
}

$insertOwner = "INSERT INTO owner (
            owner_firstname,
            owner_midname,
            owner_lastname,
            owner_suffix,
            contact_number,
            email,
            owner_img_url
            ) 
            VALUES (
            :owner_firstname,
            :owner_midname,
            :owner_lastname,
            :owner_suffix,
            :contact_number,
            :email,
            :owner_img_url
)";

$ownerStatement = $pdo->prepare($insertOwner);
$ownerStatement->bindParam(':owner_firstname', $owner_firstname);
$ownerStatement->bindParam(':owner_midname', $owner_midname);
$ownerStatement->bindParam(':owner_lastname', $owner_lastname);
$ownerStatement->bindParam(':owner_suffix', $owner_suffix);
$ownerStatement->bindParam(':contact_number', $contact_number);
$ownerStatement->bindParam(':email', $email);
$ownerStatement->bindParam(':owner_img_url', $owner_img_url);

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