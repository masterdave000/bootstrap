<?php

include './../../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_billing_id = filter_var($_POST['billing_id'], FILTER_SANITIZE_NUMBER_INT);
    $billing_id = filter_var($clean_billing_id, FILTER_VALIDATE_INT);
    $clean_category_id = filter_var($_POST['category_id'], FILTER_SANITIZE_NUMBER_INT);
    $category_id = filter_var($clean_category_id, FILTER_VALIDATE_INT);
    $section = $_POST['section'];
    $capacity = $_POST['capacity'];
    $fee = $_POST['fee'];
}


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
                $section - $capacity Fee Already Exist
            </div>
        </div>
        
        ";

    header('location:' . SITEURL . "inspection/billing/equipment-billing/update-billing.php?billing_id=$billing_id");
    exit;
}


$billingQuery = "UPDATE equipment_billing SET
    category_id = :category_id,
    section = :section,
    capacity = :capacity,
    fee = :fee 
    WHERE billing_id = :billing_id
";

$billingStatement = $pdo->prepare($billingQuery);
$billingStatement->bindParam(':billing_id', $billing_id);
$billingStatement->bindParam(':category_id', $category_id);
$billingStatement->bindParam(':section', $section);
$billingStatement->bindParam(':capacity', $capacity);
$billingStatement->bindParam(':fee', $fee);

if ($billingStatement->execute()) {
    $_SESSION['update'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Billing Updated Equipment Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/billing/equipment-billing/');
} else {
    $_SESSION['update'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Update Equipment Billing
            </div>
        </div>
    ";

    header('location:' . SITEURL . "inspection/billing/equipment-billing/update-billing.php?billing_id='$billing_id'");
}
