<?php
include './../../../config/constants.php';
// Check if section is set in the POST request
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $section = $_POST['section'];

    // Fetch capacities from the database based on the selected section
    // Modify this query according to your database structure
    $query = "SELECT DISTINCT capacity FROM equipment_billing_view WHERE section = :section";

    // Prepare and execute the query
    $statement = $pdo->prepare($query);
    $statement->bindParam(':section', $section);
    $statement->execute();

    // Fetch the capacities
    $capacities = $statement->fetchAll(PDO::FETCH_COLUMN);

    // Prepare the JSON response
    $response = array(
        'capacities' => $capacities
    );

    // Set the content type header
    header('Content-Type: application/json');

    // Send the JSON response
    echo json_encode($response);
} else {
    // Handle the case when section is not set
    // You can return an error response or an empty array
    $response = array(
        'capacities' => []
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}