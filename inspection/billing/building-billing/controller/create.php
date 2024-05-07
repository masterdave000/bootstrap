<?php

include './../../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
                $section - $property_attribute Fee Already Exist
            </div>
        </div>
        
        ";

        header('location:' . SITEURL . 'inspection/billing/building-billing/add-billing.php');
        exit;
    }
}

$billingQuery = "INSERT INTO building_billing (
    bldg_category,
    bldg_section,
    bldg_property_attribute,
    bldg_fee   
) VALUES (
    :category,
    :section,
    :property_attribute,
    :fee 
)";


$billingStatement = $pdo->prepare($billingQuery);
$billingStatement->bindParam(':category', $building_category);
$billingStatement->bindParam(':section', $section);
$billingStatement->bindParam(':property_attribute', $property_attribute);
$billingStatement->bindParam(':fee', $fee);

if ($billingStatement->execute()) {
    $_SESSION['add'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Building Billing Added Successfully
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

    header('location:' . SITEURL . 'inspection/billing/building-billing/add-billing.php');
}
