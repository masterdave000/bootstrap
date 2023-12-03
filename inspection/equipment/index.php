<?php 

$title = "Manage Equipment";
require "./../includes/side-header.php";
$user_id = $_SESSION['user_id'];
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

        ?>

        <?php require './../includes/top-header.php'?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800"><?php echo $title ?></h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="d-flex align-items-center justify-content-end card-header py-3">
                    <a href="./add-equipment.php" class="btn btn-success">Add Equipment</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Equipment Name</th>
                                    <th>Category Name</th>
                                    <th colspan="2">Actions</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                    $equipmentQuery = "SELECT * FROM equipment_view";
                                    $equipmentStatement = $pdo->query($equipmentQuery);
                                    $equipments = $equipmentStatement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($equipments as $equipment) {
                                ?>

                                <tr>
                                    <td><?php echo htmlspecialchars($equipment['equipment_name'])?></td>
                                    <td><?php echo htmlspecialchars($equipment['category_name'])?></td>
                                    <td><a href="./update-equipment.php?equipment_id=<?php echo $equipment['equipment_id']?>"
                                            class="btn btn-primary">Edit Equipment</a></td>
                                    <td><a href="./controller/delete.php?equipment_id=<?php echo $equipment['equipment_id']?>"
                                            class="btn btn-danger">Delete Equipment</a></td>

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