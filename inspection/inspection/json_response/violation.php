<?php 
include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_violation_id = filter_var($_GET['violation_id'], FILTER_SANITIZE_NUMBER_INT);
    $violation_id = filter_var($clean_violation_id, FILTER_VALIDATE_INT);

    $violationQuery = "SELECT violation_id, description FROM violation WHERE violation_id = :violation_id";
    $violationStatement = $pdo->prepare($violationQuery);
    $violationStatement->bindParam(':violation_id', $violation_id);
    $violationStatement->execute();

    $violation = $violationStatement->fetch(PDO::FETCH_ASSOC);
    
    $description = $violation['description'];
    
    $response = array(
        'violation_id' => $violation_id,
        'description' => $description
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}