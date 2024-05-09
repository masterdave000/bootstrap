<?php
include './../../../config/constants.php';
// Check if section is set in the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $section = htmlspecialchars($_POST['section']);

    // Fetch sections from the database based on the selected category
    // Modify this query according to your database structure
    $feeQuery = "SELECT billing_id, fee FROM equipment_billing_view WHERE section = :section";

    // Prepare and execute the query
    $feeStatement = $pdo->prepare($feeQuery);
    $feeStatement->bindParam(':section', $section);
    $feeStatement->execute();

    // Fetch the capacities
    $fee = $feeStatement->fetch(PDO::FETCH_ASSOC);

    $billing_id = $fee['billing_id'];
    // Prepare the JSON response
    $response = array(
        'billing_id' => $billing_id,
        'fee' => $fee['fee']
    );


    // Set the content type header
    header('Content-Type: application/json');
    // Send the JSON response
    echo json_encode($response);
} else {
    // Handle the case when section is not set
    // You can return an error response or an empty array
    $response = array(
        'billing_id' => '',
        'fee' => 0.00
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}
