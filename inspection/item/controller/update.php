<?php 
include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_item_id = filter_var($_POST['item_id'], FILTER_SANITIZE_NUMBER_INT);
    $item_id = filter_var($clean_item_id, FILTER_VALIDATE_INT);
    

    $clean_category_id = filter_var($_POST['category_id'], FILTER_SANITIZE_NUMBER_INT);
    $category_id = filter_var($clean_category_id, FILTER_VALIDATE_INT);
    $item_name = htmlspecialchars(ucwords(trim($_POST['item_name'])));

    $img_name = basename($_FILES['item_img']['name']);
    $temp_name = $_FILES['item_img']['tmp_name'];
    $img_size = $_FILES['item_img']['size'];
    $max_size = 1024 * 1024;

    $img_extension = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    $allowed_types = ['jpeg', 'png', 'jpg'];
    $folder_path = "./../images/";
    $filename = $item_name . '(' . date('m-d-Y') . ').png';

    $img_url = $_POST['current_item_img'];
    
    if ($img_name) {
        if (!in_array($img_extension, $allowed_types)) {
            $_SESSION['error'] = "Only JPEG, JPG, and PNG files are allowed.";
        } elseif ($img_size >= $max_size) {
            $_SESSION['error'] = "File size must be less than 1MB.";
        } else {
            $upload = $filename;
            move_uploaded_file($temp_name, $folder_path . $upload);
            $img_url = $upload;
        }

        // Redirect to the form file with an error message
        if (isset($_SESSION['error'])) {
            header("Location: ../update-item.php?item_id='$item_id'");
            exit();
        }

    }
}

$itemQuery = "UPDATE item_list SET
    category_id = :category_id,
    item_name = :item_name,
    img_url = :img_url  
    WHERE item_id = :item_id  
";

$itemStatement = $pdo->prepare($itemQuery);
$itemStatement->bindParam(':item_id', $item_id, PDO::PARAM_INT);
$itemStatement->bindParam(':category_id', $category_id, PDO::PARAM_INT);
$itemStatement->bindParam(':item_name', $item_name);
$itemStatement->bindParam(':img_url', $img_url);


if ($itemStatement->execute()) {
    $_SESSION['update'] = "
        <div class='msgalert alert--success' id='alert'>
            <div class='alert__message'>
                Item Updated Successfully
            </div>
        </div>
    ";

    header('location:' . SITEURL . 'inspection/item/');
} else {
    $_SESSION['update'] = "
        <div class='msgalert alert--danger' id='alert'>
            <div class='alert__message'>	
                Failed to Update Item
            </div>
        </div>s
    ";
    header("location:" . SITEURL . "inspection/item/update-item.php?item_id='$item_id'");
}