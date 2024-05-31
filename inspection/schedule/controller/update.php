<?php

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $clean_schedule_id = filter_var($_POST['schedule_id'], FILTER_SANITIZE_NUMBER_INT);
    $schedule_id = filter_var($clean_schedule_id, FILTER_VALIDATE_INT);

    $clean_bus_id = filter_var($_POST['business_id'], FILTER_SANITIZE_NUMBER_INT);
    $bus_id = filter_var($clean_bus_id, FILTER_VALIDATE_INT);

    $clean_team_id = filter_var($_POST['team_id'], FILTER_SANITIZE_NUMBER_INT);
    $team_id = filter_var($clean_team_id, FILTER_VALIDATE_INT);

    $schedule_date = $_POST['schedule_date'];
}

$updateScheduleQuery = "UPDATE schedule SET bus_id = :bus_id, schedule_date = :schedule_date WHERE schedule_id = :schedule_id";
$updateScheduleStatement = $pdo->prepare($updateScheduleQuery);

$updateScheduleStatement->bindParam(':schedule_id', $schedule_id);
$updateScheduleStatement->bindParam(':bus_id', $bus_id);
$updateScheduleStatement->bindParam(':schedule_date', $schedule_date);
$updateScheduleStatement->execute();

$updateInspectorScheduleQuery = "UPDATE inspector_schedule SET team_id = :team_id WHERE schedule_id = :schedule_id";
$updateInspectorScheduleStatement = $pdo->prepare($updateInspectorScheduleQuery);


$updateInspectorScheduleStatement->bindParam(':team_id', $team_id);
$updateInspectorScheduleStatement->bindParam(':schedule_id', $schedule_id);
$updateInspectorScheduleStatement->execute();


// Redirect with $_SESSION Message

$_SESSION['update'] = "
    <div class='msgalert alert--success' id='alert'>
        <div class='alert__message'>
            Business Scheduled Updated Successfully
    </div>
";

header('location:' . SITEURL . 'inspection/schedule/');
