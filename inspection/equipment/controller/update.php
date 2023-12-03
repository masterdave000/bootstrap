<?php 
include './../../../config/constants.php';

if (filter_has_var(INPUT_POST, 'equipment_id')) {
    $clean_equipment_id = filter_var($_POST['equipment_id'], FILTER_SANITIZE_NUMBER_INT);
    $equipment_id = filter_var($clean_equipment_id, FILTER_VALIDATE_INT);
    
    $clean_category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $category_id = filter_var($clean_category_id, FILTER_VALIDATE_INT);

    $equipment_name = htmlspecialchars(ucwords(trim($_POST['equipment_name'])));
}

$equipmentQuery = "UPDATE equipment SET
    category_id = :category_id,
    equipment_name = :equipment_name  
    WHERE equipment_id = :equipment_id  
";

$equipmentStatement = $pdo->prepare($equipmentQuery);
$equipmentStatement->bindParam(':equipment_id', $equipment_id, PDO::PARAM_INT);
$equipmentStatement->bindParam(':category_id', $category_id, PDO::PARAM_INT);
$equipmentStatement->bindParam(':equipment_name', $equipment_name);


if ($equipmentStatement->execute()) {
    $_SESSION['update'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Equipment Updated Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/equipment/');
} else {
    $_SESSION['update'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Update Equipment
            </div>
        </div>
    ";
    header('location:' . SITEURL . 'inspection/equipment/update-equipment.php');
}