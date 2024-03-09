<?php 

$title = "Add Equipment";
include './../includes/side-header.php';

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
        ?>

        <?php require './../includes/top-header.php'?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800"><?php echo $title?></h1>

        </div>


        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-4 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><?php echo $title?></h1>
                                    </div>
                                    <form action="./controller/create.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="text" name="equipment_name"
                                                class="form-control form-control-user" id="exampleInputequipmentname"
                                                aria-describedby="equipmentnameHelp"
                                                placeholder="Enter Equipment Name...">
                                        </div>
                                        <div class="form-group">
                                            <select name="category" class="form-control"
                                                style="border-radius: 10rem; font-size: 0.8rem; height: 50px;"
                                                id="exampleInputcategory" aria-describedby="categoryHelp" required>
                                                <option value="" selected>Select</option>
                                                <?php

                                                    $categoryQuery = "SELECT * FROM category ORDER BY category_name";
                                                    $categoryStatement = $pdo->query($categoryQuery);

                                                    $categoryCount = $categoryStatement->rowCount();

                                                    if ($categoryCount > 0) {
                                                        $categories = $categoryStatement->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($categories as $category) {
                                                            $category_id = $category['category_id'];
                                                            $category_name = $category['category_name'];

                                                    ?>

                                                <option value="<?php echo $category_id; ?>">
                                                    <?php echo $category_name; ?></option>

                                                <?php
                                                    }
                                                } else {
                                                    ?>
                                                <option value="">No Category Found</option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                        <input type="submit" name="submit" class="btn btn-primary btn-user btn-block"
                                            value="Add">
                                    </form>
                                </div>
                            </div>
                        </div>
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