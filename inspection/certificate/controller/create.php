<?php

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $clean_bus_id = filter_var($_POST['bus_id'], FILTER_SANITIZE_NUMBER_INT);
    $bus_id = filter_var($clean_bus_id, FILTER_VALIDATE_INT);

    $clean_owner_id = filter_var($_POST['owner_id'], FILTER_SANITIZE_NUMBER_INT);
    $owner_id = filter_var($clean_owner_id, FILTER_VALIDATE_INT);
        
    $bin = trim(strtoupper($_POST['bin']));
    $application_type = trim(strtoupper($_POST['application_type']));
    $character_of_occupancy = trim(strtoupper($_POST['character_occupancy']));
    $bus_group = trim(strtoupper($_POST['bus_group']));
    $occupancy_no = $_POST['occupancy_no'];
    $date_inspected = date('Y-m-d H:i:s');
    $date_complied = $_POST['date_complied'];
    $issued_on = $_POST['issued_on'];
}

$certificateInspectionInsert = "INSERT INTO annual_inspection_certificate (
    bus_id,
    owner_id,
    bin,
    bus_group,
    character_of_occupancy,
    occupancy_no,
    date_complied,
    issued_on,
    date_inspected
) VALUES (
    :bus_id,
    :owner_id,
    :bin,
    :bus_group,
    :character_of_occupancy,
    :occupancy_no,
    :date_complied,
    :issued_on,
    :date_inspected
)";


$certificateInspectionStatement = $pdo->prepare($certificateInspectionInsert);

$certificateInspectionStatement->bindParam(':bus_id', $bus_id);
$certificateInspectionStatement->bindParam(':owner_id', $owner_id);
$certificateInspectionStatement->bindParam(':bin', $bin);
$certificateInspectionStatement->bindParam(':bus_group', $bus_group);
$certificateInspectionStatement->bindParam(':character_of_occupancy', $character_of_occupancy);
$certificateInspectionStatement->bindParam(':occupancy_no', $occupancy_no);
$certificateInspectionStatement->bindParam(':date_complied', $date_complied);
$certificateInspectionStatement->bindParam(':issued_on', $issued_on);
$certificateInspectionStatement->bindParam(':date_inspected', $date_inspected);
$certificateInspectionStatement->execute();

$certificate_id = $pdo->lastInsertId();

$certificateInspectorInsert = "INSERT INTO annual_inspection_certificate_inspector (
    certificate_id,
    inspector_id,
    category,
    date_signed,
    time_in,
    time_out
) VALUES (
    :certificate_id,
    :inspector_id,
    :category,
    :date_signed,
    :time_in,
    :time_out
)";


for ($i = 0; $i < count($_POST['inspectors_id']); $i++) {
    
    $certificateInspectorStatement = $pdo->prepare($certificateInspectorInsert);
    $certificateInspectorStatement->bindParam('certificate_id', $certificate_id);
    $certificateInspectorStatement->bindParam('inspector_id', $_POST['inspectors_id'][$i]);
    $certificateInspectorStatement->bindParam('category', $_POST['categories'][$i]);
    $certificateInspectorStatement->bindParam('date_signed', $_POST['dates_signed'][$i]);
    $certificateInspectorStatement->bindParam('time_in', $_POST['time_ins'][$i]);
    $certificateInspectorStatement->bindParam('time_out', $_POST['time_outs'][$i]);
    $certificateInspectorStatement->execute();
}

// Redirect with $_SESSION Message

$_SESSION['add'] = "
    <div class='msgalert alert--success' id='alert'>
        <div class='alert__message'>
            Annual Certificate Created Successfully
    </div>
";

header('location:' . SITEURL . 'inspection/certificate/');