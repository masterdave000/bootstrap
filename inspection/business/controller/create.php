<?php

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_id = filter_var($_POST['occupancy_classification_id'], FILTER_SANITIZE_NUMBER_INT);
    $occupancy_classification_id = filter_var($clean_id, FILTER_VALIDATE_INT);

    $clean_owner_id = filter_var($_POST['owner_id'], FILTER_SANITIZE_NUMBER_INT);
    $owner_id = filter_var($clean_owner_id, FILTER_VALIDATE_INT);

    $bus_name = htmlspecialchars(trim(ucwords($_POST['bus_name'])));
    $bus_address = htmlspecialchars(trim(ucwords($_POST['bus_address'])));
    $bus_type = htmlspecialchars(trim(ucwords($_POST['bus_type'])));
    $contact_number = htmlspecialchars($_POST['contact_number']);
    $floor_area = htmlspecialchars($_POST['floor_area']);
    $signage_area = htmlspecialchars($_POST['signage_area']);
    $clean_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = strtolower(trim(filter_var($clean_email, FILTER_VALIDATE_EMAIL)));

    $img_name = basename($_FILES['bus_img']['name']);
    $temp_name = $_FILES['bus_img']['tmp_name'];
    $img_size = $_FILES['bus_img']['size'];
    $max_size = 1024 * 1024;

    $img_extension = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    $allowed_types = ['jpeg', 'png', 'jpg'];
    $folder_path = "./../images/";
    $filename = $bus_name . '(' . date('m-d-Y') . ').png';

    $bus_img_url = 'no-image.png';

    if ($img_name) {
        if (!in_array($img_extension, $allowed_types)) {
            $_SESSION['error'] = "Only JPEG, JPG, and PNG files are allowed.";
        } elseif ($img_size >= $max_size) {
            $_SESSION['error'] = "File size must be less than 1MB.";
        } else {
            $upload = $filename;
            move_uploaded_file($temp_name, $folder_path . $upload);
            $bus_img_url = $upload;
        }

        // Redirect to the form file with an error message
        if (isset($_SESSION['error'])) {
            header("Location: ../add-business.php");
            exit();
        }
    }
}

$businessDuplicate = "SELECT bus_id FROM business WHERE bus_name = :bus_name";
$businessStatement = $pdo->prepare($businessDuplicate);
$businessStatement->bindParam(':bus_name', $bus_name);
$businessStatement->execute();

$businessCount = $businessStatement->rowCount();

if ($businessCount > 0) {
    $_SESSION['duplicate'] = "
    <div class='msgalert alert--danger' id='alert'>
        <div class='alert__message'>	
            $bus_name Record Already Exist
        </div>
    </div>
    
    ";

    header('location:' . SITEURL . 'inspection/business/add-business.php');
    exit;
}


$businessQuery = "INSERT INTO business (
    owner_id, 
    occupancy_classification_id,
    bus_name, 
    bus_address,
    bus_type,
    bus_contact_number,
    email,
    floor_area,
    signage_area,
    bus_img_url
) VALUES (
    :owner_id, 
    :occupancy_classification_id,
    :bus_name, 
    :bus_address,
    :bus_type,
    :bus_contact_number,
    :email,
    :floor_area,
    :signage_area,
    :bus_img_url
)";

$businessStatement = $pdo->prepare($businessQuery);
$businessStatement->bindParam(':owner_id', $owner_id);
$businessStatement->bindParam(':occupancy_classification_id', $occupancy_classification_id);
$businessStatement->bindParam(':bus_name', $bus_name);
$businessStatement->bindParam(':bus_address', $bus_address);
$businessStatement->bindParam(':bus_type', $bus_type);
$businessStatement->bindParam(':bus_contact_number', $contact_number);
$businessStatement->bindParam(':email', $email);
$businessStatement->bindParam(':floor_area', $floor_area);
$businessStatement->bindParam(':signage_area', $signage_area);
$businessStatement->bindParam(':bus_img_url', $bus_img_url);

if ($businessStatement->execute()) {
    $_SESSION['add'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Business Added Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/business/');
} else {
    $_SESSION['add'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Add Business
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/business/add-business.php');
}
