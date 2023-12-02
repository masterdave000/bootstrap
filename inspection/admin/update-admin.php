<?php 

$title = "Update Admin";
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
                    $userQuery = "SELECT * from users where user_id = :user_id";
                    $userStatement = $pdo->prepare($userQuery);
                    $userStatement->bindParam(':user_id', $user_id, PDO::PARAM_INT);

                    //Check whether the query is executed or not.
                    $userStatement->execute();
                    $userCount = $userStatement->rowCount();
                    
                    if ($userCount === 1) {
                        $user = $userStatement->fetch(PDO::FETCH_ASSOC);
                        
                        $full_name = $user['fullname'];
                        $username = $user['username'];
                                
                    } else {
                        $_SESSION['no_admin_data_found'] = "
                            <div class='msgalert alert--danger' id='alert'>
                                <div class='alert__message'>	
                                    Admin Profile Data Not Found
                                </div>
                            </div>
                        ";
                        header('location:' . SITEURL . 'admin/admin_manage/admin_manage.php');
                    }
            }
                

        ?>

        <?php
        if (isset($_SESSION['update'])) //Checking whether the session is set or not
        { //DIsplaying session message
        echo $_SESSION['update'];
        //Removing session message
        unset($_SESSION['update']);
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
                                    <form action="./controller/update.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="text" name="fullname" class="form-control form-control-user"
                                                id="exampleInputfullname" aria-describedby="fullnameHelp"
                                                placeholder="Enter Fullname..."
                                                value="<?php echo $user['fullname']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="exampleInputusername" aria-describedby="usernameHelp"
                                                placeholder="Enter Username..." value="<?php echo $full_name?>">
                                        </div>

                                        <input type="submit" name="submit" class="btn btn-primary btn-user btn-block"
                                            value="Edit">
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