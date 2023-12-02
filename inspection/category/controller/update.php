<?php 
include './../../../config/constants.php';

if (filter_has_var(INPUT_POST, 'category_id')) {
    
    $clean_id = filter_var($_POST['category_id'], FILTER_SANITIZE_NUMBER_INT);
	$category_id = filter_var($clean_id, FILTER_VALIDATE_INT);
    $category_name = htmlspecialchars(ucwords(trim($_POST['category_name'])));
}

$categoryQuery = "UPDATE category SET category_name = :category_name WHERE category_id = :category_id";
$categoryStatement = $pdo->prepare($categoryQuery);
$categoryStatement->bindParam(':category_id', $category_id);
$categoryStatement->bindParam(':category_name', $category_name);

if ($categoryStatement->execute()) {
    $_SESSION['update'] = "
    <div class='msgalert alert--success' id='alert'>
        <div class='alert__message'>
            Category Added Successfully
        </div>
    </div>
    ";

    header('location:' . SITEURL . 'inspection/category/');

} else {
    $_SESSION['update'] = "
    <div class='msgalert alert--danger' id='alert'>
        <div class='alert__message'>
            Failed to Add Category
        </div>
    </div>
    ";

    header('location:' . SITEURL . "inspection/category/update-category.php?category_id=$category_id");
}