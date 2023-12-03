<?php

include './../../../config/constants.php';

//Get the id to be deleted
if (filter_has_var(INPUT_GET, 'equipment_id')) {
    $clean_id = filter_var($_GET['equipment_id'], FILTER_SANITIZE_NUMBER_INT);
    $equipment_id = filter_var($clean_id, FILTER_VALIDATE_INT);

    //SQL query to delete equipment
    $deleteequipmentQuery = "DELETE FROM equipment WHERE equipment_id = :equipment_id";
    $deleteequipmentStatement = $pdo->prepare($deleteequipmentQuery);
    $deleteequipmentStatement->bindParam(':equipment_id', $equipment_id, PDO::PARAM_INT);

if ($deleteequipmentStatement->execute()) {
    //Creating SESSION variable to display message.
    $_SESSION['delete'] = "
    <div class='msgalert alert--success' id='alert'>
        <div class='alert__message'>
            Equipment Details Deleted Successfully
        </div>
    </div>
    ";
    //Redirecting to the manage equipment page.
    header('location:' . SITEURL . 'inspection/equipment/');
} else {
    //Creating SESSION variable to display message.
    $_SESSION['delete'] = "
    <div class='msgalert alert--danger' id='alert'>
        <div class='alert__message'>
            Failed to Delete Equipment Details, Please try again
        </div>
    </div>

    ";
    //Redirecting to the manage equipment page.
    header('location:' . SITEURL . 'inspection/equipment/');
}
} else {
echo "Id invalid";
}