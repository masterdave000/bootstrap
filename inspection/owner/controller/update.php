<?php 

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_owner_id = filter_var($_POST['owner_id'], FILTER_SANITIZE_NUMBER_INT);
    $owner_id = filter_var($clean_owner_id, FILTER_VALIDATE_INT);
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

    $owner_img_url = $_POST['current_img_url'];
    
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

$updateOwnerQuery = "UPDATE owner SET
        owner_firstname = :owner_firstname,
        owner_lastname = :owner_lastname,
        owner_midname = :owner_midname,
        owner_suffix = :owner_suffix,
        contact_number = :contact_number,
        email = :email,
        owner_img_url = :owner_img_url
        WHERE owner_id = :owner_id 
";

$updateOwnerStatement = $pdo->prepare($updateOwnerQuery);
$updateOwnerStatement->bindParam(':owner_id', $owner_id);
$updateOwnerStatement->bindParam(':owner_firstname', $owner_firstname);
$updateOwnerStatement->bindParam(':owner_midname', $owner_midname);
$updateOwnerStatement->bindParam(':owner_lastname', $owner_lastname);
$updateOwnerStatement->bindParam(':owner_suffix', $owner_suffix);
$updateOwnerStatement->bindParam(':contact_number', $contact_number);
$updateOwnerStatement->bindParam(':email', $email);
$updateOwnerStatement->bindParam(':owner_img_url', $owner_img_url);

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