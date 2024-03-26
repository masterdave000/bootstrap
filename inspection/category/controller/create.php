<?php 
include './../../../config/constants.php';

if (filter_has_var(INPUT_POST, 'submit')) {
    $category_name = htmlspecialchars(ucwords(trim($_POST['category_name'])));

    $img_name = basename($_FILES['category_img']['name']);
    $temp_name = $_FILES['category_img']['tmp_name'];
    $img_size = $_FILES['category_img']['size'];
    $max_size = 1024 * 1024;

    $img_extension = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    $allowed_types = ['jpeg', 'png', 'jpg'];
    $folder_path = "./../images/";
    $filename = $category_name . '(' . date('m-d-Y') . ').png';

    $category_img_url = 'default-image.png';
    
    if ($img_name) {
        if (!in_array($img_extension, $allowed_types)) {
                $_SESSION['error'] = "Only JPEG, JPG, and PNG files are allowed.";
        } elseif ($img_size >= $max_size) {
                $_SESSION['error'] = "File size must be less than 1MB.";
        } else {
                $upload = $filename;
                move_uploaded_file($temp_name, $folder_path . $upload);
                $category_img_url = $upload;
        }

        // Redirect to the form file with an error message
        if (isset($_SESSION['error'])) {
                header("Location: ../add-category.php");
                exit();
        }

    }
}

$categoryQuery = "INSERT INTO category_list(
    category_name,
    category_img_url
    ) VALUES (
    :category_name,
    :category_img_url
    )";
    
$categoryStatement = $pdo->prepare($categoryQuery);
$categoryStatement->bindParam(':category_name', $category_name);    
$categoryStatement->bindParam(':category_img_url', $category_img_url);    

if ($categoryStatement->execute()) {
    $_SESSION['add'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Category Added Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/category/');
} else {
    $_SESSION['add'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Add Category
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/category/add-category.php');
}