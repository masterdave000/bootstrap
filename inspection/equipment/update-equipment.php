<?php 

$title = "Update Equipment";
include './../includes/side-header.php';
$fullname = $_SESSION['fullname'];

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php

            if (filter_has_var(INPUT_GET, 'equipment_id')) {
                $clean_id = filter_var($_GET['equipment_id'], FILTER_SANITIZE_NUMBER_INT);
                $equipment_id = filter_var($clean_id, FILTER_VALIDATE_INT);
            }

            $equipmentQuery = "SELECT * FROM equipment WHERE equipment_id = :equipment_id";
            $equipmentStatement = $pdo->prepare($equipmentQuery);
            $equipmentStatement->bindParam(':equipment_id', $equipment_id, PDO::PARAM_INT);
            $equipmentStatement->execute();
            
            $equipment = $equipmentStatement->fetch(PDO::FETCH_ASSOC);
            

            if (isset($_SESSION['update'])) //Checking whether the session is set or not
            {	//DIsplaying session message
                echo $_SESSION['update'];
                //Removing session message
                unset($_SESSION['update']);
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
                                    <form action="./controller/update.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="text" name="equipment_name"
                                                class="form-control form-control-user" id="exampleInputequipmentname"
                                                aria-describedby="equipmentnameHelp"
                                                placeholder="Enter Equipment Name..."
                                                value="<?php echo $equipment['equipment_name']?>">
                                        </div>
                                        <div class="form-group">
                                            <select name="category" class="form-control"
                                                style="border-radius: 10rem; font-size: 0.8rem; height: 50px;"
                                                id="exampleInputcategory" aria-describedby="categoryHelp" required>
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

                                                <option <?php if ($equipment['category_id'] === $category_id) {
											echo "Selected"; }?> value="<?php echo $category_id; ?>">
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
                                            value="Edit">
                                        <input type="hidden" name="equipment_id"
                                            value="<?php echo $equipment['equipment_id']; ?>">
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

<?php 
    
    require './../modals/logout.php';
    require './../includes/footer.php';
    
    ?>
</body>

</html>