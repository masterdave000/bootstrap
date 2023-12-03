<?php 

include './../../../config/constants.php';

if (filter_has_var(INPUT_POST, 'submit')) {
    $owner_name = htmlspecialchars(ucwords(trim($_POST['owner_name'])));
    $business_name = htmlspecialchars(ucwords(trim($_POST['business_name'])));
    $business_desc = trim($_POST['business_desc']);
    $street = ucwords(trim($_POST['street']));
    $purok = ucwords(trim($_POST['purok']));
    $barangay = ucwords(trim($_POST['barangay']));
    $city = ucwords(trim($_POST['city']));
    $contact_no = htmlspecialchars($_POST['contact_number']);
    
}

$ownerQuery = "INSERT INTO owner (owner_name) VALUES (:owner_name)";
$ownerStatement = $pdo->prepare($ownerQuery);
$ownerStatement->bindParam(':owner_name', $owner_name, PDO::PARAM_STR);
$ownerStatement->execute();
$owner_id = $pdo->lastInsertId();

$locationQuery = "INSERT INTO location (
    street,
    purok,
    barangay,
    city
) VALUES (
    :street,
    :purok,
    :barangay,
    :city
)";

$locationStatement = $pdo->prepare($locationQuery);
$locationStatement->bindParam(':street', $street);
$locationStatement->bindParam(':purok', $purok);
$locationStatement->bindParam(':barangay', $barangay);
$locationStatement->bindParam(':city', $purok);
$locationStatement->execute();          
$location_id = $pdo->lastInsertId();

$businessQuery = "INSERT INTO business (
    owner_id, 
    location_id, 
    bus_name, 
    bus_desc, 
    contact_no
) VALUES (
    :owner_id, 
    :location_id, 
    :bus_name, 
    :bus_desc, 
    :contact_no
)";

$businessStatement = $pdo->prepare($businessQuery);
$businessStatement->bindParam(':owner_id', $owner_id);
$businessStatement->bindParam(':location_id', $location_id);
$businessStatement->bindParam(':bus_name', $business_name);
$businessStatement->bindParam(':bus_desc', $business_desc);
$businessStatement->bindParam(':contact_no', $contact_no);

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