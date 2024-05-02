<?php 

$title = "Edit Item";
include './../includes/side-header.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_item_id = filter_var($_GET['item_id'], FILTER_SANITIZE_NUMBER_INT);
    $item_id = filter_var($clean_item_id, FILTER_VALIDATE_INT);

    $itemQuery = "SELECT * from item_view WHERE item_id = :item_id";
    $itemStatement = $pdo->prepare($itemQuery);
    $itemStatement->bindParam(':item_id', $item_id);
    $itemStatement->execute();

    $item = $itemStatement->fetch(PDO::FETCH_ASSOC);
}

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php

            if (isset($_SESSION['update'])) //Checking whether the session is set or not
            {	//DIsplaying session message
                echo $_SESSION['update'];
                //Removing session message
                unset($_SESSION['update']);
            }
        ?>

        <?php require './../includes/top-header.php'?>

        <!-- Outer Row -->
        <div class="row d-flex align-items-center justify-content-center overflow-hidden" style="height: 90%;">
            <div class="col-xl-6 col-lg-8 col-md-11 col-sm-11 p-3">
                <div class="card card-body o-hidden shadow-lg p-4">
                    <!-- Nested Row within Card Body -->
                    <div class="d-flex flex-column justify-content-center col-lg-12">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $title?></h1>
                        </div>
                        <form action="./controller/update.php" method="POST" class="user" enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center">
                                <div class="image-container mb-3">
                                    <img src="./images/<?php echo $item['img_url'] ?? 'default-img.png'?>"
                                        alt="default-item-image" class="img-fluid rounded-circle" />
                                </div>

                                <div class="form-group d-flex flex-column align-items-center w-100">
                                    <input type="file" name="item_img" id="item-img" class="border w-75"
                                        accept="image/JPEG, image/JPG, image/PNG" />

                                    <input type="hidden" name="current_item_img" id="item-img" class="border w-75"
                                        accept="image/JPEG, image/JPG, image/PNG"
                                        value="<?php echo $item['img_url']?>" />

                                    <?php
                                    if (isset($_SESSION['error'])) {
                                        echo "<small class='text-danger text-center'>" . $_SESSION['error'] . "</small>";
                                        unset($_SESSION['error']); // clear the error message from the session
                                    }
                                    ?>

                                    <div class="text-danger text-center">
                                        <small>
                                            <i>Note: The maximum file size allowed is 1MB. <br>
                                                Only JPEG, JPG, and PNG formats are accepted.
                                            </i>
                                        </small>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group d-flex flex-column flex-md-grow-1">
                                <label for="category-id">Category <span class="text-danger">*</span>
                                </label>
                                <div class="d-flex align-items-center justify-content-center select-container">
                                    <select name="category_id" id="category-id" class="form-control form-select px-3"
                                        required>
                                        <?php 
                                            $categoryQuery = "SELECT * from category_list";
                                            $categoryStatement = $pdo->query($categoryQuery);
                                            $categories = $categoryStatement->fetchAll(PDO::FETCH_ASSOC);
                                            
                                            foreach ($categories as $category) {
                                                ?>

                                        <option
                                            <?php echo $item['category_name'] === $category['category_name'] ? 'selected': ''?>
                                            value="<?php echo $category['category_id']?>">
                                            <?php echo $category['category_name']?>
                                        </option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for="item-name">Item Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="item_name" class="form-control p-4" id="item-name"
                                    placeholder="Enter Item Name..." value="<?php echo $item['item_name']?>" required>
                            </div>

                            <input type="hidden" name="item_id" value="<?php echo $item['item_id']?>">

                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block mt-3"
                                value="Edit">
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<!-- End of Main Content -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php require './../includes/footer.php'; ?>
</body>

</html>