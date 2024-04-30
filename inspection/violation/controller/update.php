<?php 

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_violation_id = filter_var($_POST['violation_id'], FILTER_SANITIZE_NUMBER_INT);
    $violation_id = filter_var($clean_violation_id, FILTER_VALIDATE_INT);

    $description = trim(ucfirst($_POST['description']));
}


$updateViolation = "UPDATE violation SET description = :description WHERE violation_id = :violation_id";
$violationStatement = $pdo->prepare($updateViolation);
$violationStatement->bindParam(':description', $description);
$violationStatement->bindParam(':violation_id', $violation_id);

if ($violationStatement->execute()) {
    $_SESSION['update'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Violation Record Updated Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/violation/');
} else {
    $_SESSION['update'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Update Violation Record
            </div>
        </div>s
    ";
    header("location:" . SITEURL . "inspection/violation/update-violation.php?violation_id='$violation_id'");
}