<?php
include './../../../config/constants.php';
// Check if section is set in the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $section = htmlspecialchars($_POST['section']);

    // Fetch sections from the database based on the selected category
    // Modify this query according to your database structure
    $feeQuery = "SELECT electronics_id, electronics_fee FROM electronics_billing WHERE electronics_section = :section";

    // Prepare and execute the query
    $feeStatement = $pdo->prepare($feeQuery);
    $feeStatement->bindParam(':section', $section);
    $feeStatement->execute();

    // Fetch the capacities
    $fee = $feeStatement->fetch(PDO::FETCH_ASSOC);

    // Prepare the JSON response
    $response = array(
        'electronics_id' => $fee['electronics_id'],
        'electronics_fee' => $fee['electronics_fee']
    );

    // Set the content type header
    header('Content-Type: application/json');

    // Send the JSON response
    echo json_encode($response);
} else {
    // Handle the case when section is not set
    // You can return an error response or an empty array
    $response = array(
        'electronics_id' => '',
        'electronics_fee' => 0.00
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}
