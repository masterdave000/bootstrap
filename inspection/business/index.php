<?php 

$title = "Business List";
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
                    <a href="./add-business.php" class="btn btn-success">Add Business</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Owner Name</th>
                                    <th>Business Name</th>
                                    <th>Business Description</th>
                                    <th>Location</th>
                                    <th>Contact No.</th>
                                    <th colspan="2">Actions</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                    $businessQuery = "SELECT * FROM business_view";
                                    $businessStatement = $pdo->query($businessQuery);
                                    $businesses = $businessStatement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($businesses as $business) {
                                ?>

                                <tr>
                                    <td><?php echo htmlspecialchars($business['owner_name'])?></td>
                                    <td><?php echo htmlspecialchars($business['bus_name'])?></td>
                                    <td><?php echo htmlspecialchars($business['bus_desc'])?></td>
                                    <td><?php echo htmlspecialchars($business['location'])?></td>
                                    <td><?php echo htmlspecialchars($business['contact_no'])?></td>
                                    <td><a href="./update-business.php?bus_id=<?php echo $business['bus_id']?>&owner_id=<?php echo $business['owner_id']?>&location_id=<?php echo $business['location_id']?>"
                                            class="btn btn-primary">Edit Business</a></td>
                                    <td><a href="./controller/delete.php?bus_id=<?php echo $business['bus_id']?>"
                                            class="btn btn-danger">Delete Business</a></td>

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