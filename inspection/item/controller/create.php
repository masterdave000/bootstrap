<?php 
include './../../../config/constants.php';

if (filter_has_var(INPUT_POST, 'category')) {
    $clean_category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $category_id = filter_var($clean_category_id, FILTER_VALIDATE_INT);

    $equipment_name = htmlspecialchars(ucwords(trim($_POST['equipment_name'])));
}

$equipmentQuery = "INSERT INTO equipment (
    category_id,
    equipment_name
) VALUES (
    :category_id,
    :equipment_name   
)";

$equipmentStatement = $pdo->prepare($equipmentQuery);
$equipmentStatement->bindParam(':category_id', $category_id);
$equipmentStatement->bindParam(':equipment_name', $equipment_name);


if ($equipmentStatement->execute()) {
    $_SESSION['add'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Food Added Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/equipment/');
} else {
    $_SESSION['add'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Add Food
            </div>
        </div>
    ";
    header('location:' . SITEURL . 'inspection/equipment/add-equipment.php');
}