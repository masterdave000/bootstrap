<?php 

$title = "Manage Admin";
require "./../includes/side-header.php";
$user_id = $_SESSION['user_id'];
$fullname = $_SESSION['fullname'];

?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <?php 
            if (isset($_SESSION['login-success'])) {
                echo $_SESSION['login-success'];
                unset($_SESSION['login-success']);
            }
        
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
        
            if (isset($_SESSION['change_pass_success'])) {
                 echo $_SESSION['change_pass_success'];
                unset($_SESSION['change_pass_success']);
            }
        
            if (isset($_SESSION['no_admin_data_found'])) {
                echo $_SESSION['no_admin_data_found'];
                unset($_SESSION['no_admin_data_found']);
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
                    <a href="./add-admin.php" class="btn btn-success">Add Admin</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Fullname</th>
                                    <th>Username</th>
                                    <th colspan="3">Actions</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                    $userQuery = "SELECT * FROM users ORDER BY user_id";
                                    $userStatement = $pdo->query($userQuery);
                                    $users = $userStatement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($users as $user) {
                                ?>

                                <tr>
                                    <td><?php echo htmlspecialchars($user['fullname'])?></td>
                                    <td><?php echo htmlspecialchars($user['username'])?></td>
                                    <td><a href="./update-admin.php?user_id=<?php echo $user['user_id']?>"
                                            class="btn btn-primary">Edit Admin</a></td>
                                    <td><a href="./change-password.php?user_id=<?php echo $user['user_id']?>"
                                            class="btn btn-warning">Change Password</a></td>
                                    <td><a href="./controller/delete.php?user_id=<?php echo $user['user_id']?>"
                                            class="btn btn-danger">Delete Admin</a></td>


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