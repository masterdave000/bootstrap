<?php

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $character_of_occupancy = htmlspecialchars($_GET['character_of_occupancy']);

    $classificationQuery = "SELECT * FROM occupancy_classification WHERE character_of_occupancy = :character_of_occupancy";

    $classificationStatement = $pdo->prepare($classificationQuery);
    $classificationStatement->bindParam(':character_of_occupancy', $character_of_occupancy);
    $classificationStatement->execute();

    $classification = $classificationStatement->fetch(PDO::FETCH_ASSOC);

    $response = [
        'occupancy_classification_id' => $classification['occupancy_classification_id'],
        'occupancy_group' => $classification['occupancy_group']
    ];


    header('Content-Type: application/json');
    echo json_encode($response);
}
