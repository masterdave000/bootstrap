<?php

include './../../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_bldg_billing_id = filter_var($_POST['bldg_billing_id'], FILTER_SANITIZE_NUMBER_INT);
    $bldg_billing_id = filter_var($clean_bldg_billing_id, FILTER_VALIDATE_INT);

    $building_category = trim(ucwords($_POST['building_category']));
    $section = trim($_POST['section']);
    $property_attribute = trim(ucfirst($_POST['property_attribute']));
    $fee = $_POST['fee'];

    $fetchBilling = "SELECT bldg_billing_id FROM building_billing WHERE bldg_section = :section AND bldg_property_attribute = :property_attribute";
    $fetchBillingStatement = $pdo->prepare($fetchBilling);
    $fetchBillingStatement->bindParam(':section', $section);
    $fetchBillingStatement->bindParam(':property_attribute', $property_attribute);
    $fetchBillingStatement->execute();

    $billingRecordCount = $fetchBillingStatement->rowCount();
    if ($billingRecordCount > 0) {

        $_SESSION['duplicate'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                $section - $property_attribute Billing Already Exist
            </div>
        </div>
        
        ";

        header('location:' . SITEURL . "inspection/billing/building-billing/update-billing.php?bldg_billing_id=$bldg_billing_id");
        exit;
    }
}

$billingQuery = "UPDATE building_billing SET
    bldg_category = :category,
    bldg_section = :section,
    bldg_property_attribute = :property_attribute,
    bldg_fee = :fee
    WHERE bldg_billing_id = :bldg_billing_id
";

$billingStatement = $pdo->prepare($billingQuery);
$billingStatement->bindParam(':bldg_billing_id', $bldg_billing_id);
$billingStatement->bindParam(':category', $building_category);
$billingStatement->bindParam(':section', $section);
$billingStatement->bindParam(':property_attribute', $property_attribute);
$billingStatement->bindParam(':fee', $fee);

if ($billingStatement->execute()) {
    $_SESSION['add'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Building Billing Updated Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/billing/building-billing/');
} else {
    $_SESSION['add'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Add Building Billing
            </div>
        </div>
    ";

    header('location:' . SITEURL . "inspection/billing/building-billing/update-billing.php?bldg_billing_id=$bldg_billing_id");
}
