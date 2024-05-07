<?php

include './../../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_signage_id = filter_var($_POST['signage_id'], FILTER_SANITIZE_NUMBER_INT);
    $signage_id = filter_var($clean_signage_id, FILTER_VALIDATE_INT);
    $display_type = trim(ucwords($_POST['display_type']));
    $sign_type = trim(ucfirst($_POST['sign_type']));
    $fee = $_POST['fee'];

    $fetchBilling = "SELECT signage_id FROM signage_billing WHERE display_type = :display_type AND sign_type = :sign_type AND signage_id != :signage_id";
    $fetchBillingStatement = $pdo->prepare($fetchBilling);
    $fetchBillingStatement->bindParam(':signage_id', $signage_id);
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

        header('location:' . SITEURL . "inspection/billing/signage-billing/update-billing.php?signage_id=$signage_id");
        exit;
    }
}

$billingQuery = "UPDATE signage_billing SET 
    display_type = :display_type,
    sign_type = :sign_type,
    signage_fee = :signage_fee 
    WHERE signage_id = :signage_id
";


$billingStatement = $pdo->prepare($billingQuery);
$billingStatement->bindParam(':signage_id', $signage_id);
$billingStatement->bindParam(':display_type', $display_type);
$billingStatement->bindParam(':sign_type', $sign_type);
$billingStatement->bindParam(':signage_fee', $signage_fee);

if ($billingStatement->execute()) {
    $_SESSION['add'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Signage Billing Updated Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/billing/signage-billing/');
} else {
    $_SESSION['add'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Update Signage Billing
            </div>
        </div>
    ";

    header('location:' . SITEURL . "inspection/billing/signage-billing/update-billing.php?sigange_id=$signage_id");
}
