<?php 

$title = "Update Owner";
include './../includes/side-header.php';

?>
<?php 

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_inspector_id = filter_var($_GET['inspector_id'], FILTER_SANITIZE_NUMBER_INT);
    $inspector_id = filter_var($clean_inspector_id, FILTER_VALIDATE_INT);
}
    $getOwnerQuery = "SELECT * FROM inspector WHERE inspector_id = :inspector_id";
    $getOwnerStatement = $pdo->prepare($getOwnerQuery);
    $getOwnerStatement->bindParam(':inspector_id', $inspector_id);
    $getOwnerStatement->execute();

    $inspector = $getOwnerStatement->fetch(PDO::FETCH_ASSOC);

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

        <!-- Outer Row -->
        <div class="row d-flex align-items-center justify-content-center overflow-hidden" style="height: 88vh">
            <div class="col-xl-6 col-lg-8 col-md-11 col-sm-11 p-3">
                <div class="card card-body o-hidden shadow-lg p-3">
                    <!-- Nested Row within Card Body -->
                    <div class="d-flex flex-column justify-content-center col-lg-12 p-3">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $title?></h1>
                        </div>
                        <form action="./controller/update.php" method="POST" class="user">
                            <div class="form-group">
                                <input type="text" name="inspector_name"
                                    class="form-control form-control-user squared-border" id="exampleInputOwnerName"
                                    aria-describedby="inspectorNameHelp" placeholder="Enter Inpsector Name..."
                                    value="<?php echo $inspector['inspector_name']?>" required>
                            </div>

                            <div class="form-group">
                                <input type="text" name="contact_no"
                                    class="form-control form-control-user squared-border" id="exampleInputcontactno"
                                    aria-describedby="contactnoHelp" placeholder="Enter Contact Number..."
                                    maxlength="11" value="<?php echo $inspector['contact_no']?>" required>

                            </div>

                            <input type="hidden" name="inspector_id" value="<?php echo $inspector['inspector_id']?>"
                                required>
                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block mt-3"
                                value="Update">
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