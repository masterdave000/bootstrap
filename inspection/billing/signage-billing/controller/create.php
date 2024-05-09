<?php

include './../../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $display_type = trim(ucwords($_POST['display_type']));
    $sign_type = trim(ucfirst($_POST['sign_type']));
    $fee = $_POST['fee'];

    $fetchBilling = "SELECT signage_id FROM signage_billing WHERE display_type = :display_type AND sign_type = :sign_type";
    $fetchBillingStatement = $pdo->prepare($fetchBilling);
    $fetchBillingStatement->bindParam(':display_type', $display_type);
    $fetchBillingStatement->bindParam(':sign_type', $sign_type);
    $fetchBillingStatement->execute();

    $billingRecordCount = $fetchBillingStatement->rowCount();
    if ($billingRecordCount > 0) {

        $_SESSION['duplicate'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                $display_type - $sign_type Fee Already Exist
            </div>
        </div>
        
        ";

        header('location:' . SITEURL . 'inspection/billing/signage-billing/add-billing.php');
        exit;
    }
}

$billingQuery = "INSERT INTO signage_billing (
    display_type,
    sign_type,
    signage_fee   
) VALUES (
    :display_type,
    :sign_type,
    :signage_fee 
)";


$billingStatement = $pdo->prepare($billingQuery);
$billingStatement->bindParam(':display_type', $display_type);
$billingStatement->bindParam(':sign_type', $sign_type);
$billingStatement->bindParam(':signage_fee', $fee);

if ($billingStatement->execute()) {
    $_SESSION['add'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Signage Billing Added Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/billing/signage-billing/');
} else {
    $_SESSION['add'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Add Signage Billing
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/billing/signage-billing/add-billing.php');
}
