<?php
include './../../../config/constants.php';
// Check if section is set in the GET request
if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $bldg_section = htmlspecialchars($_GET['bldg_section']);

    // Fetch capacities from the database based on the selected section
    // Modify this query according to your database structure
    $query = "SELECT DISTINCT bldg_property_attribute FROM building_billing WHERE bldg_section = :bldg_section";

    // Prepare and execute the query
    $statement = $pdo->prepare($query);
    $statement->bindParam(':bldg_section', $bldg_section);
    $statement->execute();

    // Fetch the capacities
    $bldg_property_attributes = $statement->fetchAll(PDO::FETCH_COLUMN);

    // Prepare the JSON response
    $response = array(
        'bldg_property_attributes' => $bldg_property_attributes
    );

    // Set the content type header
    header('Content-Type: application/json');

    // Send the JSON response
    echo json_encode($response);
} else {
    // Handle the case when section is not set
    // You can return an error response or an empty array
    $response = array(
        'bldg_property_attributes' => []
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}