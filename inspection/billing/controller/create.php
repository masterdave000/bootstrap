<?php

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $clean_category_id = filter_var($_POST['category_id'], FILTER_SANITIZE_NUMBER_INT);
    $category_id = filter_var($clean_category_id, FILTER_VALIDATE_INT);
    $section = $_POST['section'];
    $capacity = $_POST['capacity'];
    $fee = $_POST['fee'];

    $fetchBilling = "SELECT billing_id FROM equipment_billing_view WHERE section = :section AND capacity = :capacity";
    $fetchBillingStatement = $pdo->prepare($fetchBilling);
    $fetchBillingStatement->bindParam(':section', $section);
    $fetchBillingStatement->bindParam(':capacity', $capacity);
    $fetchBillingStatement->execute();

    $billingRecordCount = $fetchBillingStatement->rowCount();
    if ($billingRecordCount > 0) {

        $_SESSION['duplicate'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                $section Fee Already Exist
            </div>
        </div>
        
        ";

        header('location:' . SITEURL . 'inspection/billing/add-billing.php');
        exit;
    }
}

$billingQuery = "INSERT INTO equipment_billing (
    category_id,
    section,
    capacity,
    fee   
) VALUES (
    :category_id,
    :section,
    :capacity,
    :fee 
)";


$billingStatement = $pdo->prepare($billingQuery);
$billingStatement->bindParam(':category_id', $category_id);
$billingStatement->bindParam(':section', $section);
$billingStatement->bindParam(':capacity', $capacity);
$billingStatement->bindParam(':fee', $fee);

if ($billingStatement->execute()) {
    $_SESSION['add'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Billing Added Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/billing/');
} else {
    $_SESSION['add'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Add Billing
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/billing/add-billing.php');
}
