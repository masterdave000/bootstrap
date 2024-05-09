<?php

$title = "Add Item";
include './../includes/side-header.php';

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php

        if (isset($_SESSION['add'])) //Checking whether the session is set or not
        {    //DIsplaying session message
            echo $_SESSION['add'];
            //Removing session message
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['duplicate'])) //Checking whether the session is set or not
        {    //DIsplaying session message
            echo $_SESSION['duplicate'];
            //Removing session message
            unset($_SESSION['duplicate']);
        }
        ?>

        <?php require './../includes/top-header.php' ?>

        <!-- Outer Row -->
        <div class="row d-flex align-items-center justify-content-center overflow-hidden" style="height: 90%;">
            <div class="col-xl-6 col-lg-8 col-md-11 col-sm-11 p-3">
                <div class="card card-body o-hidden shadow-lg p-4">
                    <!-- Nested Row within Card Body -->
                    <div class="d-flex flex-column justify-content-center col-lg-12">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $title ?></h1>
                        </div>
                        <form action="./controller/create.php" method="POST" class="user" enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center">
                                <div class="image-container mb-3">
                                    <img src="./images/default-img.png" alt="default-item-image" class="img-fluid rounded-circle" />
                                </div>

                                <div class="form-group d-flex flex-column align-items-center w-100">
                                    <input type="file" name="item_img" id="item-img" class="border w-75" accept="image/JPEG, image/JPG, image/PNG" />

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
                                    <select name="category_id" id="category-id" class="form-control form-select px-3" required>
                                        <option selected disabled hidden value="">Select</option>
                                        <?php
                                        $categoryQuery = "SELECT * from category_list";
                                        $categoryStatement = $pdo->query($categoryQuery);
                                        $categories = $categoryStatement->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($categories as $category) {
                                        ?>

                                            <option value="<?php echo $category['category_id'] ?>">
                                                <?php echo $category['category_name'] ?>
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
                                <input type="text" name="item_name" class="form-control p-4" id="item-name" placeholder="Enter Item Name..." required>
                            </div>

                            <div class="form-group d-none flex-column flex-md-grow-1" id="electrical-section">
                                <label for="section">Section<span class="text-danger">*</span>
                                </label>
                                <div class="d-flex align-items-center justify-content-center select-container">
                                    <select name="section" class="form-control px-3" id="electrical">
                                        <option selected disabled hidden value="">Select</option>
                                        <?php
                                        $sectionQuery = "SELECT DISTINCT section from equipment_billing_view WHERE category_name = :category_name";
                                        $sectionStatement = $pdo->prepare($sectionQuery);
                                        $sectionStatement->bindValue(':category_name', 'Electrical');
                                        $sectionStatement->execute();
                                        $sections = $sectionStatement->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($sections as $section) {
                                        ?>

                                            <option value="<?php echo $section['section'] ?>">
                                                <?php echo $section['section'] ?>
                                            </option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group d-none flex-column flex-md-grow-1" id="mechanical-section">
                                <label for="section">Section<span class="text-danger">*</span>
                                </label>
                                <div class="d-flex align-items-center justify-content-center select-container">
                                    <select name="section" class="form-control px-3" id="mechanical">
                                        <option selected disabled hidden value="">Select</option>
                                        <?php

                                        $sectionQuery = "SELECT DISTINCT section from equipment_billing_view WHERE category_name = :category_name";
                                        $sectionStatement = $pdo->prepare($sectionQuery);
                                        $sectionStatement->bindValue(':category_name', 'Mechanical');
                                        $sectionStatement->execute();
                                        $sections = $sectionStatement->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($sections as $section) {
                                        ?>

                                            <option value="<?php echo $section['section'] ?>">
                                                <?php echo $section['section'] ?>
                                            </option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group d-none flex-column flex-md-grow-1" id="electronics-section">
                                <label for="section">Section<span class="text-danger">*</span>
                                </label>
                                <div class="d-flex align-items-center justify-content-center select-container">
                                    <select name="section" class="form-control px-3" id="electronics">
                                        <option selected disabled hidden value="">Select</option>
                                        <?php

                                        $sectionQuery = "SELECT DISTINCT section from equipment_billing_view WHERE category_name = :category_name";
                                        $sectionStatement = $pdo->prepare($sectionQuery);
                                        $sectionStatement->bindValue(':category_name', 'Electronics');
                                        $sectionStatement->execute();
                                        $sections = $sectionStatement->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($sections as $section) {
                                        ?>

                                            <option value="<?php echo $section['section'] ?>">
                                                <?php echo $section['section'] ?>
                                            </option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>


                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block mt-3" value="Add">
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