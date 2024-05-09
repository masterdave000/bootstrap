<?php

include './../../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_electronics_id = filter_var($_POST['electronics_id'], FILTER_SANITIZE_NUMBER_INT);
    $electronics_id = filter_var($clean_electronics_id, FILTER_VALIDATE_INT);

    $section = trim(htmlspecialchars($_POST['section']));
    $fee = $_POST['fee'];

    $fetchBilling = "SELECT electronics_id FROM electronics_billing WHERE electronics_section = :section AND electronics_id != :electronics_id";
    $fetchBillingStatement = $pdo->prepare($fetchBilling);
    $fetchBillingStatement->bindParam(':electronics_id', $electronics_id);
    $fetchBillingStatement->bindParam(':section', $section);
    $fetchBillingStatement->execute();

    $billingRecordCount = $fetchBillingStatement->rowCount();
    if ($billingRecordCount > 0) {

        $_SESSION['duplicate'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                $section Billing Already Exist
            </div>
        </div>
        
        ";

        header('location:' . SITEURL . "inspection/billing/electronics-billing/update-billing.php?electronics_id=$electronics_id");
        exit;
    }
}

$billingQuery = "UPDATE electronics_billing SET
    electronics_section = :section,
    electronics_fee = :fee
    WHERE electronics_id = :electronics_id
";

$billingStatement = $pdo->prepare($billingQuery);
$billingStatement->bindParam(':electronics_id', $electronics_id);
$billingStatement->bindParam(':section', $section);
$billingStatement->bindParam(':fee', $fee);

if ($billingStatement->execute()) {
    $_SESSION['update'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Electronics Billing Updated Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/billing/electronics-billing/');
} else {
    $_SESSION['update'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Update Electronics Billing
            </div>
        </div>
    ";

    header('location:' . SITEURL . "inspection/billing/electronics-billing/update-billing.php?electronics_id=$electronics_id");
}
