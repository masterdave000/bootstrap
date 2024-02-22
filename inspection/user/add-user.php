<?php 

$title = "Add User";
include './../includes/side-header.php';
$fullname = $_SESSION['fullname'];

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php
            if (isset($_SESSION['pass_not_match'])) //Checking whether the session is set or not
            {	//DIsplaying session message
                echo $_SESSION['pass_not_match'];
                //Removing session message
                unset($_SESSION['pass_not_match']);
            }

            if (isset($_SESSION['add'])) //Checking whether the session is set or not
            {	//DIsplaying session message
                echo $_SESSION['add'];
                //Removing session message
                unset($_SESSION['add']);
            }
        ?>

        <?php require './../includes/top-header.php'?>

        <!-- Outer Row -->
        <div class="row d-flex align-items-center justify-content-center overflow-hidden" style="height: 88vh">
            <div class="col-xl-4 col-lg-8 col-md-11 col-sm-11 p-3">
                <div class="card card-body o-hidden shadow-lg p-3 pt-5">
                    <!-- Nested Row within Card Body -->
                    <div class="d-flex flex-column col-lg-12 p-3">
                        <div class="text-center mb-4">
                            <h1 class="h4 text-gray-900"><?php echo $title?></h1>
                        </div>

                        <form action="./controller/create.php" method="POST" class="user">
                            <div class="form-group">
                                <input type="text" name="fullname" class="form-control form-control-user squared-border"
                                    id="exampleInputfullname" aria-describedby="fullnameHelp"
                                    placeholder="Enter Fullname..." required>
                            </div>

                            <div class="form-group">
                                <input type="text" name="username" class="form-control form-control-user squared-border"
                                    id="exampleInputusername" aria-describedby="usernameHelp"
                                    placeholder="Enter Username..." required>
                            </div>

                            <div class="form-group">
                                <input type="password" name="password1"
                                    class="form-control form-control-user squared-border" id="exampleInputPassword1"
                                    placeholder="Password" required>
                            </div>

                            <div class="form-group">
                                <input type="password" name="password2"
                                    class="form-control form-control-user squared-border" id="exampleInputPassword2 "
                                    placeholder="Confirm Password" required>
                            </div>

                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block squared-border"
                                value="Add">
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

<?php 
    
    require './../modals/logout.php';
    require './../includes/footer.php';
    
    ?>
</body>

</html>