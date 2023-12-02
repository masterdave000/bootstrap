<?php 

$title = "Manage Category";
require "./../includes/side-header.php";
$user = $_SESSION['user_id'];
$fullname = $_SESSION['fullname'];

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

            if (isset($_SESSION['no_category_data_found'])) {
                echo $_SESSION['no_category_data_found'];
                unset($_SESSION['no_category_data_found']);
            }
        
        ?>

        <?php require './../includes/top-header.php'?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800"><?php echo $title ?></h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="d-flex align-items-center justify-content-end card-header py-3">
                    <a href="./add-category.php" class="btn btn-success">Add Category</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th colspan="2">Actions</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                    $categoryQuery = "SELECT * FROM category ORDER BY category_id";
                                    $categoryStatement = $pdo->query($categoryQuery);
                                    $categories = $categoryStatement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($categories as $category) {
                                ?>

                                <tr>
                                    <td><?php echo htmlspecialchars($category['category_name'])?></td>
                                    <td><a href="./update-category.php?category_id=<?php echo $category['category_id']?>"
                                            class="btn btn-primary">Edit Category</a></td>
                                    <td><a href="./controller/delete.php?category_id=<?php echo $category['category_id']?>"
                                            class="btn btn-danger">Delete Category</a></td>

                                </tr>

                                <?php
                            }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<?php require './../modals/logout.php'?>
<?php require './../includes/footer.php';?>

</body>

</html>