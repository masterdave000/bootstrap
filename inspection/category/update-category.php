<?php 

$title = "Update Category";
include './../includes/side-header.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_category_id = filter_var($_GET['category_id'], FILTER_SANITIZE_NUMBER_INT);
    $category_id = filter_var($clean_category_id, FILTER_VALIDATE_INT);

    $categoryQuery = "SELECT * FROM category_list WHERE category_id = :category_id";
    $categoryStatement = $pdo->prepare($categoryQuery);
    $categoryStatement->bindParam(':category_id', $category_id);
    $categoryStatement->execute();

    $category = $categoryStatement->fetch(PDO::FETCH_ASSOC);

    $category_id = $category['category_id'];
    $category_name = $category['category_name'];
    $category_img_url = $category['category_img_url'];
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
                                    <img src="./images/<?php echo $category_img_url ?: 'no-image.png'?>"
                                        alt="default-category-image" class="img-fluid rounded-circle" />
                                </div>

                                <p class="h3 text-gray-900 mb-4 "><?php echo $category_name?></p>

                                <div class="form-group d-flex flex-column align-items-center w-100">
                                    <input type="file" name="category_img" id="category-img" class="border w-75"
                                        accept="image/JPEG, image/JPG, image/PNG" />

                                    <input type="hidden" name="current_category_img" id="category-img"
                                        class="border w-75" accept="image/JPEG, image/JPG, image/PNG"
                                        value="<?php echo $category_img_url?>" />


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

                            <div class="col col-12 p-0 form-group">
                                <label for="category-name">Category Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="category_name" class="form-control p-4" id="category-name"
                                    aria-describedby="businessaddressHelp" placeholder="Enter Business Address..."
                                    value="<?php echo $category_name?>" required>
                            </div>

                            <input type="hidden" name="category_id" value="<?php echo $category_id ?>">

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