<?php
include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_team_id = filter_var($_GET['team_id'], FILTER_SANITIZE_NUMBER_INT);
    $team_id = filter_var($clean_team_id, FILTER_VALIDATE_INT);

    // Query to get all inspectors for the given team_id
    $teamQuery = "
        SELECT 
            team_id, 
            inspector_firstname, 
            inspector_midname, 
            inspector_lastname, 
            inspector_suffix,
            team_role
        FROM 
            inspector_team_view 
        WHERE 
            team_id = :team_id
    ";
    $teamStatement = $pdo->prepare($teamQuery);
    $teamStatement->bindParam(':team_id', $team_id);
    $teamStatement->execute();

    $inspectors = $teamStatement->fetchAll(PDO::FETCH_ASSOC);

    $response = array();
    
    foreach ($inspectors as $team) {
        $firstname = htmlspecialchars(ucwords($team['inspector_firstname']));
        $midname = htmlspecialchars(ucwords($team['inspector_midname'] ? mb_substr($team['inspector_midname'], 0, 1, 'UTF-8') . "." : ""));
        $lastname = htmlspecialchars(ucwords($team['inspector_lastname']));
        $suffix = htmlspecialchars(ucwords($team['inspector_suffix']));
        $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);
        $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);

        $team_role = $team['team_role'];
        $response[] = array(
            'team_id' => $team_id,
            'inspector_name' => $fullname,
            'team_role' => $team_role
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
