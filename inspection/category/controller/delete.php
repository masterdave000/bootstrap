<?php

include './../../../config/constants.php';

//Get the id to be deleted
if (filter_has_var(INPUT_GET, 'category_id')) {
    $clean_id = filter_var($_GET['category_id'], FILTER_SANITIZE_NUMBER_INT);
    $category_id = filter_var($clean_id, FILTER_VALIDATE_INT);

    //SQL query to delete category
    $deletecategoryQuery = "DELETE FROM category_list WHERE category_id = :category_id";
    $deletecategoryStatement = $pdo->prepare($deletecategoryQuery);
    $deletecategoryStatement->bindParam(':category_id', $category_id, PDO::PARAM_INT);

if ($deletecategoryStatement->execute()) {
    //Creating SESSION variable to display message.
    $_SESSION['delete'] = "
    <div class='msgalert alert--success' id='alert'>
        <div class='alert__message'>
            Category Deleted Successfully
        </div>
    </div>
    ";
    //Redirecting to the manage admin page.
    header('location:' . SITEURL . 'inspection/category/');
} else {
    //Creating SESSION variable to display message.
    $_SESSION['delete'] = "
    <div class='msgalert alert--danger' id='alert'>
        <div class='alert__message'>
            Failed to Delete Category, Please try again
        </div>
    </div>

    ";
    //Redirecting to the manage admin page.
    header('location:' . SITEURL . 'inspection/category/');
}
} else {
echo "Id invalid";
}