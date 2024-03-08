<?php 

$title = "Inspector List";
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

        ?>

        <?php require './../includes/top-header.php'?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800"><?php echo $title ?></h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="d-flex align-items-center justify-content-end card-header py-3">
                    <a href="./add-inspector.php" class="btn btn-success d-flex align-items-center">
                        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                        <span>Add Inspector</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Owner Name</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                    $inspectorQuery = "SELECT inspector_id, inspector_name FROM inspector";
                                    $inspectorStatement = $pdo->query($inspectorQuery);
                                    $inspectors = $inspectorStatement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($inspectors as $inspector) {
                                ?>

                                <tr>
                                    <td class="align-middle">
                                        <?php echo htmlspecialchars($inspector['inspector_name'])?></td>

                                    <td class="d-flex justify-content-end">
                                        <a href="./update-inspector.php?inspector_id=<?php echo $inspector['inspector_id']?>"
                                            class="btn btn-primary mr-2">Edit</a>

                                        <a href="./controller/delete.php?inspector_id=<?php echo $inspector['inspector_id']?>"
                                            class="btn btn-danger ml-2">Delete</a>
                                    </td>
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