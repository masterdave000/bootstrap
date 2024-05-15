<?php
include './../../../config/constants.php';

$query = "SELECT application_type, COUNT(*) AS count FROM annual_inspection_certificate_view GROUP BY application_type";
$stmt = $pdo->query($query);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$labels = array();
$counts = array();

foreach ($data as $row) {
    $labels[] = $row['application_type'];
    $counts[] = $row['count'];
}

header('Content-Type: application/json');
echo json_encode(array(
    'labels' => $labels,
    'data' => $counts
));
