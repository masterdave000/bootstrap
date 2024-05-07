<?php

$title = "Update Violation";
include './../includes/side-header.php';

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php

        if (isset($_SESSION['update'])) //Checking whether the session is set or not
        {    //DIsplaying session message
            echo $_SESSION['update'];
            //Removing session message
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['duplicate'])) //Checking whether the session is set or not
        {    //DIsplaying session message
            echo $_SESSION['duplicate'];
            //Removing session message
            unset($_SESSION['duplicate']);
        }


        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $clean_violation_id = filter_var($_GET['violation_id'], FILTER_SANITIZE_NUMBER_INT);
            $violation_id = filter_var($clean_violation_id, FILTER_VALIDATE_INT);

            $violationQuery = "SELECT * from violation WHERE violation_id = :violation_id";
            $violationStatement = $pdo->prepare($violationQuery);
            $violationStatement->bindParam(':violation_id', $violation_id);
            $violationStatement->execute();

            $violation = $violationStatement->fetch(PDO::FETCH_ASSOC);
        }
        ?>

        <?php require './../includes/top-header.php' ?>

        <!-- Outer Row -->
        <div class="row d-flex align-items-center justify-content-center overflow-hidden">
            <div class="col-xl-6 col-lg-8 col-md-11 col-sm-11 p-3">
                <div class="card card-body o-hidden shadow-lg p-4">
                    <!-- Nested Row within Card Body -->
                    <div class="d-flex flex-column justify-content-center col-lg-12">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $title ?></h1>
                        </div>
                        <form action="./controller/update.php" method="POST" class="user" enctype="multipart/form-data">

                            <div class="col col-12 p-0 form-group">
                                <label for="description">Description <span class="text-danger">*</span>
                                </label>
                                <textarea name="description" class="form-control p-4" id="description" placeholder="Enter Violation Description..." required><?php echo $violation['description'] ?></textarea>
                            </div>

                            <input type="hidden" name="violation_id" value="<?php echo $violation['violation_id'] ?>">

                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block mt-3" value="Edit">
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

<?php require './../includes/footer.php'; ?>
</body>

</html>