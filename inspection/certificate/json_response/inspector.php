<?php 
include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_inspector_id = filter_var($_GET['inspector_id'], FILTER_SANITIZE_NUMBER_INT);
    $inspector_id = filter_var($clean_inspector_id, FILTER_VALIDATE_INT);

    $inspectorQuery = "SELECT inspector_id, inspector_firstname, inspector_midname, inspector_lastname, inspector_suffix FROM inspector WHERE inspector_id = :inspector_id";
    $inspectorStatement = $pdo->prepare($inspectorQuery);
    $inspectorStatement->bindParam(':inspector_id', $inspector_id);
    $inspectorStatement->execute();

    $inspector = $inspectorStatement->fetch(PDO::FETCH_ASSOC);
    
    $firstname = htmlspecialchars(ucwords($inspector['inspector_firstname']));
  

    // Split the first name into an array of words
    $words = explode(' ', $firstname);

    // Initialize a variable to store the initials
    $initials = '';

    // Iterate through each word and append the first letter to the initials
    foreach ($words as $word) {
        $initials .= strtoupper(substr($word, 0, 1));
    }
    
    $midname = htmlspecialchars(ucwords($inspector['inspector_midname'] ? mb_substr($inspector['inspector_midname'], 0, 1, 'UTF-8') : ""));
    $lastname = htmlspecialchars(ucwords($inspector['inspector_lastname']));
    $suffix = htmlspecialchars(ucwords($inspector['inspector_suffix']));
    $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);
    $inspector_abbr = trim($initials . $midname . ' ' . $lastname . ' ' . $suffix);
    
    $response = array(
        'inspector_id' => $inspector_id,
        'inspector_name' => $fullname,
        'inspector_abbr' => $inspector_abbr,
        'inspector_lastname' => $lastname
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}