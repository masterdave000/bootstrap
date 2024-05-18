<?php

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_bus_id = filter_var($_POST['business_id'], FILTER_SANITIZE_NUMBER_INT);
    $bus_id = filter_var($clean_bus_id, FILTER_VALIDATE_INT);

    $schedule_date = $_POST['schedule_date'];
}

$insertScheduleQuery = "INSERT INTO schedule (bus_id, schedule_date) VALUES (:bus_id, :schedule_date)";
$insertScheduleStatement = $pdo->prepare($insertScheduleQuery);

$insertScheduleStatement->bindParam(':bus_id', $bus_id);
$insertScheduleStatement->bindParam(':schedule_date', $schedule_date);
$insertScheduleStatement->execute();

$schedule_id = $pdo->lastInsertId();

$insertInspectorScheduleQuery = "INSERT INTO inspector_schedule (inspector_id, schedule_id) VALUES (:inspector_id, :schedule_id)";
$insertInspectorScheduleStatement = $pdo->prepare($insertInspectorScheduleQuery);

for ($i = 0; $i < count($_POST['inspector_id']); $i++) {
    $insertInspectorScheduleStatement->bindParam(':inspector_id', $_POST['inspector_id'][$i]);
    $insertInspectorScheduleStatement->bindParam(':schedule_id', $schedule_id);
    $insertInspectorScheduleStatement->execute();
}

// Redirect with $_SESSION Message

$_SESSION['add'] = "
    <div class='msgalert alert--success' id='alert'>
        <div class='alert__message'>
            Business Scheduled Created Successfully
    </div>
";

header('location:' . SITEURL . 'inspection/schedule/');
