<?php

include './../../../config/constants.php';

//Get the id to be deleted
if (filter_has_var(INPUT_POST, 'password')) {

    $password = md5($_POST['password']);

    $checkUser = "SELECT * FROM user_view WHERE password = :password";
    $checkStatement = $pdo->prepare($checkUser);
    $checkStatement->bindParam(':password', $password);
    $checkStatement->execute();

    if ($checkStatement->rowCount() === 0) {
        $_SESSION['invalid_password'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>
                Incorrect Password, Please try again
            </div>
        </div>

        ";
        //Redirecting to the manage schedule page.
        header('location:' . SITEURL . 'inspection/schedule/');
        exit;
    }
}

if (filter_has_var(INPUT_POST, 'schedule_id')) {
    $clean_id = filter_var($_POST['schedule_id'], FILTER_SANITIZE_NUMBER_INT);
    $schedule_id = filter_var($clean_id, FILTER_VALIDATE_INT);

    $deleteInspectorScheduleQuery = "DELETE FROM inspector_schedule WHERE schedule_id = :schedule_id";
    $deleteInspectorScheduleStatement = $pdo->prepare($deleteInspectorScheduleQuery);
    $deleteInspectorScheduleStatement->bindParam(':schedule_id', $schedule_id, PDO::PARAM_INT);
    $deleteInspectorScheduleStatement->execute();

    //SQL query to delete user
    $deletescheduleQuery = "DELETE FROM schedule WHERE schedule_id = :schedule_id";
    $deletescheduleStatement = $pdo->prepare($deletescheduleQuery);
    $deletescheduleStatement->bindParam(':schedule_id', $schedule_id, PDO::PARAM_INT);

    if ($deletescheduleStatement->execute()) {
        //Creating SESSION variable to display message.
        $_SESSION['delete'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Schedule Record Deleted Successfully
            </div>
        </div>
        ";
        //Redirecting to the manage schedule page.
        header('location:' . SITEURL . 'inspection/schedule/');
    } else {
        //Creating SESSION variable to display message.
        $_SESSION['delete'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>
                Failed to Delete Schedule Record, Please try again
            </div>
        </div>

        ";
        //Redirecting to the manage schedule page.
        header('location:' . SITEURL . 'inspection/schedule/');
    }
} else {

    $_SESSION['id_not_found'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>
                Schedule ID Not Found
            </div>
        </div>

    ";
    //Redirecting to the manage schedule page.
    header('location:' . SITEURL . 'inspection/schedule/');
}
