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
        //Redirecting to the manage team page.
        header('location:' . SITEURL . 'inspection/team/');
        exit;
    }
}

if (filter_has_var(INPUT_POST, 'team_id')) {
    $clean_id = filter_var($_POST['team_id'], FILTER_SANITIZE_NUMBER_INT);
    $team_id = filter_var($clean_id, FILTER_VALIDATE_INT);

    $deleteTeamQuery = "DELETE FROM inspector_team_members WHERE team_id = :team_id";
    $deleteTeamStatement = $pdo->prepare($deleteTeamQuery);
    $deleteTeamStatement->bindParam(':team_id', $team_id, PDO::PARAM_INT);
    $deleteTeamStatement->execute();

    //SQL query to delete user
    $deleteTeamNameQuery = "DELETE FROM inspector_team_name WHERE team_id = :team_id";
    $deleteTeamNameStatement = $pdo->prepare($deleteTeamNameQuery);
    $deleteTeamNameStatement->bindParam(':team_id', $team_id, PDO::PARAM_INT);

    if ($deleteTeamNameStatement->execute()) {
        //Creating SESSION variable to display message.
        $_SESSION['delete'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Team Profile Deleted Successfully
            </div>
        </div>
        ";
        //Redirecting to the manage team page.
        header('location:' . SITEURL . 'inspection/team/');
    } else {
        //Creating SESSION variable to display message.
        $_SESSION['delete'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>
                Failed to Delete Team Profile, Please try again
            </div>
        </div>

        ";
        //Redirecting to the manage team page.
        header('location:' . SITEURL . 'inspection/team/');
    }
} else {

    $_SESSION['id_not_found'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>
                Team ID Not Found
            </div>
        </div>

    ";
    //Redirecting to the manage team page.
    header('location:' . SITEURL . 'inspection/team/');
}
