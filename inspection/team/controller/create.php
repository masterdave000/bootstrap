<?php

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $team_name = trim(ucwords($_POST['team_name']));
    $roles = $_POST['role']; // Assume this is an array of roles
    $inspector_ids = $_POST['inspector_id']; // Assume this is an array of inspector IDs

    try {
        // Begin transaction
        $pdo->beginTransaction();

        // Insert the team into inspector_team table
        $insertTeamQuery = "INSERT INTO inspector_team_name (team_name) VALUES (:team_name)";
        $insertTeamStatement = $pdo->prepare($insertTeamQuery);
        $insertTeamStatement->bindParam(':team_name', $team_name);
        $insertTeamStatement->execute();

        // Get the last inserted team ID
        $team_id = $pdo->lastInsertId();

        // Prepare the query to insert inspectors into the inspector_team_members table
        $insertInspectorTeamMembersQuery = "INSERT INTO inspector_team_members (team_id, inspector_id, team_role) VALUES (:team_id, :inspector_id, :team_role)";
        $insertInspectorTeamMembersStatement = $pdo->prepare($insertInspectorTeamMembersQuery);

        // Insert each inspector with the same team_id and their respective roles
        for ($i = 0; $i < count($inspector_ids); $i++) {
            $inspector_id = filter_var($inspector_ids[$i], FILTER_SANITIZE_NUMBER_INT);
            $inspector_id = filter_var($inspector_id, FILTER_VALIDATE_INT);
            $team_role = filter_var($roles[$i], FILTER_SANITIZE_STRING);

            $insertInspectorTeamMembersStatement->bindParam(':team_id', $team_id);
            $insertInspectorTeamMembersStatement->bindParam(':inspector_id', $inspector_id);
            $insertInspectorTeamMembersStatement->bindParam(':team_role', $team_role);
            $insertInspectorTeamMembersStatement->execute();
        }

        // Commit transaction
        $pdo->commit();

        // Redirect with success message
        $_SESSION['add'] = "
            <div class='msgalert alert--success' id='alert'>
                <div class='alert__message'>
                    Team Created Successfully
                </div>
            </div>
        ";

        header('location:' . SITEURL . 'inspection/team/');
        exit;
    } catch (Exception $e) {
        // Rollback transaction if something goes wrong
        $pdo->rollBack();

        // Log error (not displayed to user for security reasons)
        error_log($e->getMessage());

        // Redirect with error message
        $_SESSION['add'] = "
            <div class='msgalert alert--danger' id='alert'>
                <div class='alert__message'>
                    Error creating team. Please try again.
                </div>
            </div>
        ";

        header('location:' . SITEURL . 'inspection/team/add-team.php');
        exit;
    }
}
