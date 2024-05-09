<?php
include './../../../config/constants.php';
// Check if section is set in the POST request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $bldg_section = htmlspecialchars($_GET['bldg_section']);
    $bldg_property_attribute = htmlspecialchars($_GET['bldg_property_attribute']);

    // Fetch sections from the database based on the selected category
    // Modify this query according to your database structure
    $buildingFeeQuery = "SELECT bldg_billing_id, bldg_fee FROM building_billing WHERE bldg_section = :bldg_section AND bldg_property_attribute = :bldg_property_attribute";

    // Prepare and execute the query
    $buildingFeeStatement = $pdo->prepare($buildingFeeQuery);
    $buildingFeeStatement->bindParam(':bldg_section', $bldg_section);
    $buildingFeeStatement->bindParam(':bldg_property_attribute', $bldg_property_attribute);
    $buildingFeeStatement->execute();

    // Fetch the capacities
    $buildingFee = $buildingFeeStatement->fetch(PDO::FETCH_ASSOC);

    if ($buildingFee) {
        // Prepare the JSON response
        $response = array(
            'bldg_billing_id' => $buildingFee['bldg_billing_id'],
            'bldg_fee' => $buildingFee['bldg_fee']
        );

        // Set the content type header
        header('Content-Type: application/json');

        // Send the JSON response
        echo json_encode($response);
    }
} else {
    // Handle the case when section is not set
    // You can return an error response or an empty array
    $response = array(
        'bldg_building_id' => '',
        'bldg_fee' => 0.00
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}
