<?php

include './../../../config/constants.php';

$query = "SELECT DATE_FORMAT(date_inspected, '%b') AS month, COUNT(DISTINCT bus_id) AS business_count 
              FROM inspection_view 
              GROUP BY DATE_FORMAT(date_inspected, '%b')";

$stmt = $pdo->query($query);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$labels = array();
$businessCounts = array();

foreach ($data as $row) {
    $labels[] = $row['month'];
    $businessCounts[] = (int)$row['business_count']; // Ensure the data is converted to integer
}

echo json_encode(array(
    'labels' => $labels,
    'businessCounts' => $businessCounts
));
