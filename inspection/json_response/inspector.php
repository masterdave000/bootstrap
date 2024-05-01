<?php 
include './../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_inspector_id = filter_var($_GET['inspector_id'], FILTER_SANITIZE_NUMBER_INT);
    $inspector_id = filter_var($clean_inspector_id, FILTER_VALIDATE_INT);

    $inspectorQuery = "SELECT inspector_id, inspector_firstname, inspector_midname, inspector_lastname, inspector_suffix FROM inspector WHERE inspector_id = :inspector_id";
    $inspectorStatement = $pdo->prepare($inspectorQuery);
    $inspectorStatement->bindParam(':inspector_id', $inspector_id);
    $inspectorStatement->execute();

    $inspector = $inspectorStatement->fetch(PDO::FETCH_ASSOC);
    
    $firstname = htmlspecialchars(ucwords($inspector['inspector_firstname']));
    $midname = htmlspecialchars(ucwords($inspector['inspector_midname'] ? mb_substr($inspector['inspector_midname'], 0, 1, 'UTF-8') . "." : ""));
    $lastname = htmlspecialchars(ucwords($inspector['inspector_lastname']));
    $suffix = htmlspecialchars(ucwords($inspector['inspector_suffix']));
    $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);
    
    $response = array(
        'inspector_id' => $inspector_id,
        'inspector_name' => $fullname
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}