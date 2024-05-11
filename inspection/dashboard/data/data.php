<?php

$totalInspectedBusinessQuery = "SELECT count(DISTINCT inspection_id) AS total_business_inspected FROM inspection_view";
$totalInspectedBusinessStatement = $pdo->query($totalInspectedBusinessQuery);
$totalInspectedBusiness = $totalInspectedBusinessStatement->fetch(PDO::FETCH_ASSOC);

$totalInspectedBusinessWithViolationQuery = "SELECT count(DISTINCT inspection_id) AS total_business_with_violation FROM inspection_view WHERE remarks = :remarks";
$totalInspectedBusinessWithViolationStatement = $pdo->prepare($totalInspectedBusinessWithViolationQuery);
$totalInspectedBusinessWithViolationStatement->bindValue(':remarks', 'With Violation');
$totalInspectedBusinessWithViolationStatement->execute();
$totalInspectedBusinessWithViolation = $totalInspectedBusinessWithViolationStatement->fetch(PDO::FETCH_ASSOC);

$totalInspectedBusinessWithoutViolationQuery = "SELECT count(DISTINCT inspection_id) AS total_business_without_violation FROM inspection_view WHERE remarks != :remarks";
$totalInspectedBusinessWithoutViolationStatement = $pdo->prepare($totalInspectedBusinessWithoutViolationQuery);
$totalInspectedBusinessWithoutViolationStatement->bindValue(':remarks', 'With Violation');
$totalInspectedBusinessWithoutViolationStatement->execute();
$totalInspectedBusinessWithoutViolation = $totalInspectedBusinessWithoutViolationStatement->fetch(PDO::FETCH_ASSOC);


$totalIssuedCertificateQuery = "SELECT count(DISTINCT certificate_id) AS total_issued_certificates FROM annual_inspection_certificate_view";
$totalIssuedCertificateStatement = $pdo->query($totalIssuedCertificateQuery);
$totalIssuedCertificate = $totalIssuedCertificateStatement->fetch(PDO::FETCH_ASSOC);
