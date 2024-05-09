<?php
include './../../../config/constants.php';
// Check if section is set in the GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $display_type = htmlspecialchars($_GET['display_type']);

    // Fetch capacities from the database based on the selected section
    // Modify this query according to your database structure
    $query = "SELECT DISTINCT sign_type FROM signage_billing WHERE display_type = :display_type";

    // Prepare and execute the query
    $statement = $pdo->prepare($query);
    $statement->bindParam(':display_type', $display_type);
    $statement->execute();

    // Fetch the capacities
    $sign_types = $statement->fetchAll(PDO::FETCH_COLUMN);

    // Prepare the JSON response
    $response = array(
        'sign_types' => $sign_types
    );

    // Set the content type header
    header('Content-Type: application/json');

    // Send the JSON response
    echo json_encode($response);
} else {
    // Handle the case when section is not set
    // You can return an error response or an empty array
    $response = array(
        'sign_types' => []
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}
