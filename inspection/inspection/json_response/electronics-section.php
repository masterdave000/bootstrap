<?php
include './../../../config/constants.php';
// Check if section is set in the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Fetch capacities from the database based on the selected section
    // Modify this query according to your database structure
    $query = "SELECT electronics_section FROM electronics_billing";

    $statement = $pdo->query($query);
    // Fetch the capacities
    $sections = $statement->fetchAll(PDO::FETCH_COLUMN);

    // Prepare the JSON response
    $response = array(
        'sections' => $sections
    );

    // Set the content type header
    header('Content-Type: application/json');

    // Send the JSON response
    echo json_encode($response);
} else {
    // Handle the case when section is not set
    // You can return an error response or an empty array
    $response = array(
        'sections' => []
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}
