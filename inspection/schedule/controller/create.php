<?php

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_bus_id = filter_var($_POST['business_id'], FILTER_SANITIZE_NUMBER_INT);
    $bus_id = filter_var($clean_bus_id, FILTER_VALIDATE_INT);

    $clean_team_id = filter_var($_POST['team_id'], FILTER_SANITIZE_NUMBER_INT);
    $team_id = filter_var($clean_team_id, FILTER_VALIDATE_INT);

    $schedule_date = $_POST['schedule_date'];
}

$insertScheduleQuery = "INSERT INTO schedule (bus_id, schedule_date) VALUES (:bus_id, :schedule_date)";
$insertScheduleStatement = $pdo->prepare($insertScheduleQuery);

$insertScheduleStatement->bindParam(':bus_id', $bus_id);
$insertScheduleStatement->bindParam(':schedule_date', $schedule_date);
$insertScheduleStatement->execute();

$schedule_id = $pdo->lastInsertId();

$insertInspectorScheduleQuery = "INSERT INTO inspector_schedule (schedule_id, team_id) VALUES (:schedule_id, :team_id)";
$insertInspectorScheduleStatement = $pdo->prepare($insertInspectorScheduleQuery);


$insertInspectorScheduleStatement->bindParam(':schedule_id', $schedule_id);
$insertInspectorScheduleStatement->bindParam(':team_id', $team_id);
$insertInspectorScheduleStatement->execute();


// Redirect with $_SESSION Message

$_SESSION['add'] = "
    <div class='msgalert alert--success' id='alert'>
        <div class='alert__message'>
            Business Scheduled Created Successfully
    </div>
";

header('location:' . SITEURL . 'inspection/schedule/');
