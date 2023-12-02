<?php 

$title = "Change Password";
include './../includes/side-header.php';
$fullname = $_SESSION['fullname'];
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php
            if (filter_has_var(INPUT_GET, 'user_id')) {
                $clean_id = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);
                $user_id = filter_var($clean_id, FILTER_VALIDATE_INT);
                
            }
                
        ?>

        <?php

            if (isset($_SESSION['change_pass_failed'])) {
                echo $_SESSION['change_pass_failed'];
                unset($_SESSION['change_pass_failed']);
            }

            if (isset($_SESSION['pass_not_match'])) {
                echo $_SESSION['pass_not_match'];
                unset($_SESSION['pass_not_match']);
            }

            if (isset($_SESSION['user_not_found'])) {
                echo $_SESSION['user_not_found'];
                unset($_SESSION['user_not_found']);
            }
        ?>


        <?php 
            require './../includes/top-header.php';
        ?>

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
                                    <form action="./controller/update-password.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="password" name="currentpassword"
                                                class="form-control form-control-user" id="exampleInputcurrentpassword"
                                                aria-describedby="currentpasswordHelp"
                                                placeholder="Enter Current Password..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="newpassword"
                                                class="form-control form-control-user" id="exampleInputnewpassword"
                                                aria-describedby="newpasswordHelp" placeholder="Enter New Password..."
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="confirmpassword"
                                                class="form-control form-control-user" id="exampleInputconfirmpassword"
                                                aria-describedby="confirmpasswordHelp" placeholder="Confirm Password..."
                                                required>
                                        </div>

                                        <input type="submit" name="submit" class="btn btn-primary btn-user btn-block"
                                            value="Update Password">
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
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