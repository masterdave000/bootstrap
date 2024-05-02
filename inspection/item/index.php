<?php 

$title = "Manage Item";
require "./../includes/side-header.php";

?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <?php 
        
            if (isset($_SESSION['add'])) //Checking whether the session is set or not
            {	//DIsplaying session message
                echo $_SESSION['add'];
                //Removing session message
                unset($_SESSION['add']);
            }
        
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
        
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        
            if (isset($_SESSION['no_item_data_found'])) {
                echo $_SESSION['no_item_data_found'];
                unset($_SESSION['no_item_data_found']);
            }
            
            if (isset($_SESSION['invalid_password'])) {
                echo $_SESSION['invalid_password'];
                unset($_SESSION['invalid_password']);
            }

            if (isset($_SESSION['id_not_found'])) {
                echo $_SESSION['id_not_found'];
                unset($_SESSION['id_not_found']);
            }

        ?>

        <?php require './../includes/top-header.php'?>

        <div class="container-fluid mt-4">
            <div class="card shadow mb-4">
                <div class="d-flex align-items-center justify-content-between card-header">
                    <h1 class="h3 text-gray-800 mt-2"><?php echo $title ?></h1>
                    <a href="./add-item.php" class="btn btn-success d-flex justify-content-center align-items-center">
                        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                        <span class="d-none d-lg-inline">Add</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="obosTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="d-flex justify-content-between border-bottom">
                                    <th>
                                        Item
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php 
                                    $itemQuery = "SELECT * FROM item_view ORDER BY item_id";
                                    $itemStatement = $pdo->query($itemQuery);
                                    $items = $itemStatement->fetchAll(PDO::FETCH_ASSOC);
                               
                                    foreach ($items as $item) :
                                        
                                ?>

                                <tr class="d-flex justify-content-between align-items-center border-bottom py-1">
                                    <td class="p-0 m-0">
                                        <a href="./view-item.php?item_id=<?php echo $item['item_id']?>"
                                            class="d-flex align-items-center justify-content-between text-decoration-none text-gray-700 flex-gap">
                                            <div class="image-container img-fluid">
                                                <img src="./images/<?php echo $item['img_url'] ?? 'default-img.png'?>"
                                                    alt="item-image" class="img-fluid rounded-circle" />
                                            </div>

                                            <div>
                                                <div class="text">
                                                    <?php echo $item['item_name']?>
                                                </div>
                                                <div class="sub-title d-none d-md-flex">Category:
                                                    <?php echo $item['category_name']?></div>
                                            </div>
                                        </a>
                                    </td>

                                    <td class="d-flex justify-content-end">
                                        <a href="./update-item.php?item_id=<?php echo $item['item_id']?>"
                                            class="btn btn-primary mr-2 text-center d-flex align-items-center">
                                            <i class="fa fa-pencil-square mr-1" aria-hidden="true"></i>
                                            <span class="d-none d-lg-inline">Edit</span>
                                        </a>

                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal-<?php echo $item['item_id']?>"
                                            class="btn btn-danger d-flex justify-content-center align-items-center">
                                            <i class="fa fa-trash mr-1" aria-hidden="true"></i>
                                            <span class="d-none d-lg-inline">Delete</span>
                                        </a>

                                    </td>
                                </tr>

                                <?php
                                require './modals/delete.php';
                                    endforeach
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php 
require './../includes/footer.php';
?>

</body>

</html>