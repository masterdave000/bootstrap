<?php

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = trim(ucfirst($_POST['description']));
}

$violationDuplicate = "SELECT violation_id FROM violation WHERE description = :description";
$violationStatement = $pdo->prepare($violationDuplicate);
$violationStatement->bindParam(':description', $description);
$violationStatement->execute();

$violationCount = $violationStatement->rowCount();

if ($violationCount > 0) {
    $_SESSION['duplicate'] = "
    <div class='msgalert alert--danger' id='alert'>
        <div class='alert__message'>	
            Violation Record Already Exist
        </div>
    </div>
    
    ";

    header('location:' . SITEURL . 'inspection/violation/add-violation.php');
    exit;
}


$violationInsert = "INSERT INTO violation(description) VALUES (:description)";
$violationStatement = $pdo->prepare($violationInsert);
$violationStatement->bindParam(':description', $description);


if ($violationStatement->execute()) {
    $_SESSION['add'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Violation Record Added Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/violation/');
} else {
    $_SESSION['add'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Add Violation Record
            </div>
        </div>
    ";
    header('location:' . SITEURL . 'inspection/item/add-violation.php');
}
