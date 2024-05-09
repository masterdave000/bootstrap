<?php
include './../../../config/constants.php';
// Check if section is set in the POST request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $display_type = htmlspecialchars($_GET['display_type']);
    $sign_type = htmlspecialchars($_GET['sign_type']);

    // Fetch sections from the database based on the selected category
    // Modify this query according to your database structure
    $signageFeeQuery = "SELECT signage_id, signage_fee FROM signage_billing WHERE display_type = :display_type AND sign_type = :sign_type";

    // Prepare and execute the query
    $signageFeeStatement = $pdo->prepare($signageFeeQuery);
    $signageFeeStatement->bindParam(':display_type', $display_type);
    $signageFeeStatement->bindParam(':sign_type', $sign_type);
    $signageFeeStatement->execute();

    // Fetch the capacities
    $signageFee = $signageFeeStatement->fetch(PDO::FETCH_ASSOC);

    // Prepare the JSON response
    $response = array(
        'signage_id' => $signageFee['signage_id'],
        'signage_fee' => number_format($signageFee['signage_fee'], 2)
    );


    // Set the content type header
    header('Content-Type: application/json');

    // Send the JSON response
    echo json_encode($response);
} else {
    // Handle the case when section is not set
    // You can return an error response or an empty array
    $response = array(
        'signage_id' => '',
        'signage_fee' => 0.00,
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}
