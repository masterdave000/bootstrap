<?php 
include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_item_id = filter_var($_GET['item_id'], FILTER_SANITIZE_NUMBER_INT);
    $item_id = filter_var($clean_item_id, FILTER_VALIDATE_INT);

    $itemQuery = "SELECT * FROM item_view WHERE item_id = :item_id";
    $itemStatement = $pdo->prepare($itemQuery);
    $itemStatement->bindParam(':item_id', $item_id);
    $itemStatement->execute();

    $item = $itemStatement->fetch(PDO::FETCH_ASSOC);
    
    $response = array(
        'item_id' => $item['item_id'],
        'item_name' => $item['item_name'],
        'category_name' => $item['category_name']
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}