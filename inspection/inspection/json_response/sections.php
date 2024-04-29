<?php
include './../../../config/constants.php';
// Check if section is set in the POST request
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category'];

    // Fetch sections from the database based on the selected category
    // Modify this query according to your database structure
    $sectionQuery = "SELECT DISTINCT section FROM equipment_billing_view WHERE category_name = :category_name";

    // Prepare and execute the query
    $sectionStatement = $pdo->prepare($sectionQuery);
    $sectionStatement->bindParam(':category_name', $category_name);
    $sectionStatement->execute();

    // Fetch the capacities
    $sections = $sectionStatement->fetchAll(PDO::FETCH_COLUMN);

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