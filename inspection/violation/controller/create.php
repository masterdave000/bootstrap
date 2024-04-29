<?php 

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = trim(ucfirst($_POST['description']));
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