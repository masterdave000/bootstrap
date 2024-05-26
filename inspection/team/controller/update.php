<?php

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_team_id = filter_var($_POST['team_id'], FILTER_SANITIZE_NUMBER_INT);
    $team_id = filter_var($clean_team_id, FILTER_VALIDATE_INT);
    $team_member_ids = $_POST['team_member_id'];
    $team_name = trim(ucwords($_POST['team_name']));
    $team_roles = $_POST['role'];
}

if (filter_has_var(INPUT_POST, 'inspector_id')) {
    $inspector_ids = $_POST['inspector_id'];

    // Prepare the IN clause for the SQL query with named parameters
    $inClause = implode(',', array_map(function ($inspector_id, $key) {
        return ":inspector_id$key";
    }, $inspector_ids, array_keys($inspector_ids)));

    $deletedInspectorQuery = "SELECT inspector_id
                          FROM inspector_team_view
                          WHERE team_id = :team_id AND inspector_id NOT IN ($inClause)";
    $deletedInspectorStatement = $pdo->prepare($deletedInspectorQuery);
    $deletedInspectorStatement->bindParam(':team_id', $team_id, PDO::PARAM_INT);

    // Bind each inspector ID individually
    foreach ($inspector_ids as $key => $inspector_id) {
        $paramName = ":inspector_id$key"; // Create unique parameter name
        $deletedInspectorStatement->bindValue($paramName, $inspector_id, PDO::PARAM_INT);
    }

    $deletedInspectorStatement->execute();

    // Fetch the deleted inspectors as an array
    $deleted_inspectors = $deletedInspectorStatement->fetchAll(PDO::FETCH_COLUMN);


    $deleted_inspector_ids_count = $deletedInspectorStatement->rowCount();

    if ($deleted_inspector_ids_count > 0) {

        // DELETE INSPECTOR IN THE TEAM
        $deleteInspectorQuery = "DELETE FROM inspector_team_members WHERE team_id = :team_id AND inspector_id = :inspector_id";
        $deleteInspectorStatement = $pdo->prepare($deleteInspectorQuery);

        foreach ($deleted_inspectors as $key => $deleted_inspector) {
            $deleteInspectorStatement->bindParam(':inspector_id', $deleted_inspectors[$key]);
            $deleteInspectorStatement->bindParam(':team_id', $team_id);
            $deleteInspectorStatement->execute();
        }
    }


    $currentInspectorsQuery = "SELECT inspector_id FROM inspector_team_view WHERE team_id = :team_id";
    $currentInspectorsStatement = $pdo->prepare($currentInspectorsQuery);
    $currentInspectorsStatement->bindParam(':team_id', $team_id);
    $currentInspectorsStatement->execute();
    $current_inspectors = $currentInspectorsStatement->fetchAll(PDO::FETCH_COLUMN);
    $updated_inspectors = is_array($inspector_ids) ? $inspector_ids : [];

    // Compare with updated inspectors
    $new_inspectors = array_diff($updated_inspectors, $current_inspectors);
    // Insert new inspectors
    if (!empty($new_inspectors)) {
        $insertInspectorQuery = "INSERT INTO inspector_team_members (inspector_id, team_id, team_role) VALUES (:inspector_id, :team_id, :team_role)";
        $insertInspectorStatement = $pdo->prepare($insertInspectorQuery);

        foreach ($new_inspectors as $key => $inspector_id) {
            $insertInspectorStatement->bindParam(':inspector_id', $inspector_ids[$key], PDO::PARAM_INT);
            $insertInspectorStatement->bindParam(':team_id', $team_id, PDO::PARAM_INT);
            $insertInspectorStatement->bindParam(':team_role', $team_roles[$key]);
            $insertInspectorStatement->execute();
        }
    } else {
        $updateInspectorQuery = "UPDATE inspector_team_members SET team_role = :team_role WHERE team_member_id = :team_member_id";
        $updateRoleStatement = $pdo->prepare($updateInspectorQuery);

        for ($i = 0; $i < count($team_member_ids); $i++) {

            $updateRoleStatement->bindParam(':team_role', $team_roles[$i], PDO::PARAM_STR);
            $updateRoleStatement->bindParam(':team_member_id', $team_member_ids[$i], PDO::PARAM_INT);
            $updateRoleStatement->execute();
        }
    }

    $teamUpdateQuery = "UPDATE inspector_team_name SET team_name = :team_name WHERE team_id = :team_id";
    $teamUpdateStatement = $pdo->prepare($teamUpdateQuery);
    $teamUpdateStatement->bindParam(':team_id', $team_id);
    $teamUpdateStatement->bindParam(':team_name', $team_name);

    $teamUpdateStatement->execute();


    if ($teamUpdateStatement->execute()) {

        $_SESSION['update'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Inspector Team Updated Successfully
            </div>
        </div>
    ";

        header('location:' . SITEURL . 'inspection/team/');
    } else {
        $_SESSION['update'] = "
			<div class='msgalert alert--danger' id='alert'>
                <div class='alert__message'>	
                    Failed to Update Inspector Team Profile                
                </div>
			</div>
		";

        header('location:' . SITEURL . "inspection/team/update-team.php?team_id='$team_id'");
    }
}
