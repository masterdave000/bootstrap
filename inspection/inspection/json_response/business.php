<?php 
include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_bus_id = filter_var($_GET['bus_id'], FILTER_SANITIZE_NUMBER_INT);
    $bus_id = filter_var($clean_bus_id, FILTER_VALIDATE_INT);
    

    $busQuery = "SELECT owner_id, bus_name, owner_firstname, owner_midname, owner_lastname, owner_suffix, bus_type, bus_address, bus_contact_number, floor_area, signage_area, bus_img_url FROM business_view WHERE bus_id = :bus_id";
    $busStatement = $pdo->prepare($busQuery);
    $busStatement->bindParam(':bus_id', $bus_id);
    $busStatement->execute();

    $business = $busStatement->fetch(PDO::FETCH_ASSOC);

    $owner_id = $business['owner_id'];
    $firstname = htmlspecialchars(ucwords($business['owner_firstname']));
    $midname = htmlspecialchars(ucwords($business['owner_midname'] ? mb_substr($business['owner_midname'], 0, 1, 'UTF-8') . "." : ""));
    $lastname = htmlspecialchars(ucwords($business['owner_lastname']));
    $suffix = htmlspecialchars(ucwords($business['owner_suffix']));
    $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);
    $bus_name = $business['bus_name'];
    $bus_type = $business['bus_type'];
    $bus_address = $business['bus_address'];
    $bus_contact_number = $business['bus_contact_number'];
    $floor_area = $business['floor_area'];
    $signage_area = $business['signage_area'];
    $bus_img_url = $business['bus_img_url'];
}

$response = array(
    'owner_id' => $owner_id,
    'owner_name' => $fullname,
    'bus_name' => $bus_name,
    'bus_type' => $bus_type,
    'bus_address' => $bus_address,
    'bus_contact_number' => $bus_contact_number,
    'floor_area' => $floor_area,
    'signage_area' => $signage_area,
    'bus_img_url' => $bus_img_url
    
);

header('Content-Type: application/json');
echo json_encode($response);