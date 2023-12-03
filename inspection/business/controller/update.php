<?php 

include './../../../config/constants.php';

if (filter_has_var(INPUT_POST, 'bus_id') && filter_has_var(INPUT_POST, 'owner_id') && filter_has_var(INPUT_POST, 'location_id')) {
    $clean_bus_id = filter_var($_POST['bus_id'], FILTER_SANITIZE_NUMBER_INT);
    $bus_id = filter_var($clean_bus_id, FILTER_VALIDATE_INT);

    $clean_owner_id = filter_var($_POST['owner_id'], FILTER_SANITIZE_NUMBER_INT);
    $owner_id = filter_var($clean_owner_id, FILTER_VALIDATE_INT);

    $clean_location_id = filter_var($_POST['location_id'], FILTER_SANITIZE_NUMBER_INT);
    $location_id = filter_var($clean_location_id, FILTER_VALIDATE_INT);

    $owner_name = htmlspecialchars(ucwords(trim($_POST['owner_name'])));
    $business_name = htmlspecialchars(ucwords(trim($_POST['business_name'])));
    $business_desc = trim($_POST['business_desc']);
    $street = ucwords(trim($_POST['street']));
    $purok = ucwords(trim($_POST['purok']));
    $barangay = ucwords(trim($_POST['barangay']));
    $city = ucwords(trim($_POST['city']));
    $contact_no = htmlspecialchars($_POST['contact_number']);
    
}

$ownerQuery = "UPDATE owner SET owner_name = :owner_name WHERE owner_id = :owner_id";
$ownerStatement = $pdo->prepare($ownerQuery);
$ownerStatement->bindParam(':owner_id', $owner_id, PDO::PARAM_INT);
$ownerStatement->bindParam(':owner_name', $owner_name, PDO::PARAM_STR);
$ownerStatement->execute();

$locationQuery = "UPDATE location SET
    street = :street,
    purok = :purok,
    barangay = :barangay,
    city = :city
    WHERE location_id = :location_id
";

$locationStatement = $pdo->prepare($locationQuery);
$locationStatement->bindParam(':location_id', $location_id, PDO::PARAM_INT);
$locationStatement->bindParam(':street', $street);
$locationStatement->bindParam(':purok', $purok);
$locationStatement->bindParam(':barangay', $barangay);
$locationStatement->bindParam(':city', $purok);
$locationStatement->execute();          

$businessQuery = "UPDATE business SET
    owner_id = :owner_id, 
    location_id = :location_id, 
    bus_name = :bus_name, 
    bus_desc = :bus_desc,
    contact_no = :contact_no
    WHERE bus_id = :bus_id

";

$businessStatement = $pdo->prepare($businessQuery);
$businessStatement->bindParam(':bus_id', $bus_id, PDO::PARAM_INT);
$businessStatement->bindParam(':owner_id', $owner_id, PDO::PARAM_INT);
$businessStatement->bindParam(':location_id', $location_id, PDO::PARAM_INT);
$businessStatement->bindParam(':bus_name', $business_name);
$businessStatement->bindParam(':bus_desc', $business_desc);
$businessStatement->bindParam(':contact_no', $contact_no);

if ($businessStatement->execute()) {
    $_SESSION['update'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Business Updated Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/business/');
} else {
    $_SESSION['update'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Update Business
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/business/update-business.php');
}