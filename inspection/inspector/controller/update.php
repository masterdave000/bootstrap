<?php

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_inspector_id = filter_var($_POST['inspector_id'], FILTER_SANITIZE_NUMBER_INT);
    $inspector_id = filter_var($clean_inspector_id, FILTER_VALIDATE_INT);
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

    $inspector_img_url = $_POST['current_img_url'];

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
            header("Location: ../update-inspector.php?inspector_id='$inspector_id'");
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

    header('location:' . SITEURL . "inspection/inspector/add-inspector.php?inspector_id=$inspector_id");
    exit;
}

$updateOwnerQuery = "UPDATE inspector SET
        inspector_firstname = :inspector_firstname,
        inspector_midname = :inspector_midname,
        inspector_lastname = :inspector_lastname,
        inspector_suffix = :inspector_suffix,
        contact_number = :contact_number,
        email = :email,
        inspector_img_url = :inspector_img_url
        WHERE inspector_id = :inspector_id 
";

$updateOwnerStatement = $pdo->prepare($updateOwnerQuery);
$updateOwnerStatement->bindParam(':inspector_id', $inspector_id);
$updateOwnerStatement->bindParam(':inspector_firstname', $inspector_firstname);
$updateOwnerStatement->bindParam(':inspector_midname', $inspector_midname);
$updateOwnerStatement->bindParam(':inspector_lastname', $inspector_lastname);
$updateOwnerStatement->bindParam(':inspector_suffix', $inspector_suffix);
$updateOwnerStatement->bindParam(':contact_number', $contact_number);
$updateOwnerStatement->bindParam(':email', $email);
$updateOwnerStatement->bindParam(':inspector_img_url', $inspector_img_url);


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
