<?php

include './../../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $section = trim($_POST['section']);
    $fee = $_POST['fee'];

    $fetchBilling = "SELECT electronics_id FROM electronics_billing WHERE electronics_section = :section";
    $fetchBillingStatement = $pdo->prepare($fetchBilling);
    $fetchBillingStatement->bindParam(':section', $section);
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

        header('location:' . SITEURL . 'inspection/billing/electronics-billing/add-billing.php');
        exit;
    }
}

$billingQuery = "INSERT INTO electronics_billing (
    electronics_section,
    electronics_fee   
) VALUES (
    :section,
    :fee 
)";


$billingStatement = $pdo->prepare($billingQuery);
$billingStatement->bindParam(':section', $section);
$billingStatement->bindParam(':fee', $fee);

if ($billingStatement->execute()) {
    $_SESSION['add'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Electronics Billing Added Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/billing/electronics-billing/');
} else {
    $_SESSION['add'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Add Electronics Billing
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/billing/electronics-billing/add-billing.php');
}
