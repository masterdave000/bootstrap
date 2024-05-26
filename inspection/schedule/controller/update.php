<?php

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_schedule_id = filter_var($_POST['schedule_id'], FILTER_SANITIZE_NUMBER_INT);
    $schedule_id = filter_var($clean_schedule_id, FILTER_VALIDATE_INT);

    $clean_bus_id = filter_var($_POST['business_id'], FILTER_SANITIZE_NUMBER_INT);
    $bus_id = filter_var($clean_bus_id, FILTER_VALIDATE_INT);

    $schedule_date = $_POST['schedule_date'];
}

if (filter_has_var(INPUT_POST, 'inspector_id')) {
    $inspector_ids = $_POST['inspector_id'];

    // Prepare the IN clause for the SQL query with named parameters
    $inClause = implode(',', array_map(function ($inspector_id, $key) {
        return ":inspector_id$key";
    }, $inspector_ids, array_keys($inspector_ids)));

    $deletedInspectorQuery = "SELECT inspector_id
                          FROM inspector_schedule
                          WHERE schedule_id = :schedule_id AND inspector_id NOT IN ($inClause)";
    $deletedInspectorStatement = $pdo->prepare($deletedInspectorQuery);
    $deletedInspectorStatement->bindParam(':schedule_id', $schedule_id, PDO::PARAM_INT);

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

        // DELETE INSPECTOR SCHEDULE
        $deleteInspectorQuery = "DELETE FROM inspector_schedule WHERE schedule_id = :schedule_id AND inspector_id = :inspector_id";
        $deleteInspectorStatement = $pdo->prepare($deleteInspectorQuery);

        foreach ($deleted_inspectors as $key => $deleted_inspector) {
            $deleteInspectorStatement->bindParam(':inspector_id', $deleted_inspectors[$key]);
            $deleteInspectorStatement->bindParam(':schedule_id', $schedule_id);
            $deleteInspectorStatement->execute();
        }
    }


    $currentInspectorsQuery = "SELECT inspector_id FROM inspector_schedule WHERE schedule_id = :schedule_id";
    $currentInspectorsStatement = $pdo->prepare($currentInspectorsQuery);
    $currentInspectorsStatement->bindParam(':schedule_id', $schedule_id);
    $currentInspectorsStatement->execute();
    $current_inspectors = $currentInspectorsStatement->fetchAll(PDO::FETCH_COLUMN);
    $updated_inspectors = is_array($inspector_ids) ? $inspector_ids : [];

    // Compare with updated inspectors
    $new_inspectors = array_diff($updated_inspectors, $current_inspectors);


    // Insert new inspectors
    if (!empty($new_inspectors)) {
        $insertInspectorQuery = "INSERT INTO inspector_schedule (inspector_id, schedule_id) VALUES (:inspector_id, :schedule_id)";
        $insertInspectorStatement = $pdo->prepare($insertInspectorQuery);

        foreach ($new_inspectors as $inspector_id) {
            $insertInspectorStatement->bindParam(':inspector_id', $inspector_id, PDO::PARAM_INT);
            $insertInspectorStatement->bindParam(':schedule_id', $schedule_id, PDO::PARAM_INT);
            $insertInspectorStatement->execute();
        }
    }

    $scheduleUpdateQuery = "UPDATE schedule SET bus_id = :bus_id, schedule_date = :schedule_date WHERE schedule_id =:schedule_id";
    $scheduleUpdateStatement = $pdo->prepare($scheduleUpdateQuery);
    $scheduleUpdateStatement->bindParam(':schedule_id', $schedule_id);
    $scheduleUpdateStatement->bindParam(':bus_id', $bus_id);
    $scheduleUpdateStatement->bindParam(':schedule_date', $schedule_date);
    $scheduleUpdateStatement->execute();


    if ($scheduleUpdateStatement->execute()) {

        $_SESSION['update'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Business Inspection Schedule Updated Successfully
            </div>
        </div>
    ";

        header('location:' . SITEURL . 'inspection/schedule/');
    } else {
        $_SESSION['update'] = "
			<div class='msgalert alert--danger' id='alert'>
                <div class='alert__message'>	
                    Failed to Update Business Inspection Schedule
                </div>
			</div>
		";

        header('location:' . SITEURL . "inspection/schedule/update-schedule.php?schedule_id='$schedule_id'");
    }
}
