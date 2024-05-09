<?php
include './../../../config/constants.php';
// Check if section is set in the POST request
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $capacity = $_POST['capacity'];

    // Fetch sections from the database based on the selected category
    // Modify this query according to your database structure
    $feeQuery = "SELECT billing_id, fee FROM equipment_billing_view WHERE capacity = :capacity";

    // Prepare and execute the query
    $feeStatement = $pdo->prepare($feeQuery);
    $feeStatement->bindParam(':capacity', $capacity);
    $feeStatement->execute();

    // Fetch the capacities
    $fee = $feeStatement->fetch(PDO::FETCH_ASSOC);

    // Prepare the JSON response
    $response = array(
        'fee' => $fee['fee'],
        'billing_id' => $fee['billing_id']
    );

    // Set the content type header
    header('Content-Type: application/json');

    // Send the JSON response
    echo json_encode($response);
} else {
    // Handle the case when section is not set
    // You can return an error response or an empty array
    $response = array(
        'fee' => 0.00,
        'billing_id' => ''
    );
    
    header('Content-Type: application/json');
    echo json_encode($response);
}