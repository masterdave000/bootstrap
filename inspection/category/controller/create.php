<?php 
include './../../../config/constants.php';

if (filter_has_var(INPUT_POST, 'submit')) {
    $category_name = htmlspecialchars(ucwords(trim($_POST['category_name'])));
}

$categoryQuery = "INSERT INTO category_list(category_name) VALUES (:category_name)";
$categoryStatement = $pdo->prepare($categoryQuery);
$categoryStatement->bindParam(':category_name', $category_name);    

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