<?php

$title = "Edit Signage Billing Record";
include './../../includes/side-header.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_signage_id = filter_var($_GET['signage_id'], FILTER_SANITIZE_NUMBER_INT);
    $signage_id = filter_var($clean_signage_id, FILTER_VALIDATE_INT);

    $signageBilling = "SELECT * FROM signage_billing WHERE signage_id = :signage_id";
    $signageStatement = $pdo->prepare($signageBilling);
    $signageStatement->bindParam(':signage_id', $signage_id);
    $signageStatement->execute();

    $signage = $signageStatement->fetch(PDO::FETCH_ASSOC);
}

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
        ?>

        <?php require './../../includes/top-header.php' ?>

        <!-- Outer Row -->
        <div class="row d-flex align-items-center justify-content-center overflow-hidden" style="height: 90%;">
            <div class="col-xl-6 col-lg-8 col-md-11 col-sm-11 p-3">
                <div class="card card-body o-hidden shadow-lg p-4">
                    <!-- Nested Row within Card Body -->
                    <div class="d-flex flex-column justify-content-center col-lg-12">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $title ?></h1>
                        </div>
                        <form action="" method="POST" class="user" enctype="multipart/form-data">
                            <div class="col col-12 p-0 form-group">
                                <label>Display Type <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control p-4" value="<?php echo $signage['display_type'] ?>" disabled>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label>Sign Type <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control p-4" value="<?php echo $signage['sign_type'] ?>" disabled>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for="fee">Fee <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>

                                    <input type="number" name="fee" class="form-control p-4" id="fee" placeholder="Enter Fee..." step="0.01" value="<?= $signage['signage_fee'] ?>" min="0.00" readonly>
                                </div>
                            </div>

                            <input type="hidden" name="signage_id" value="<?= $signage['signage_id'] ?>">
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

<?php require './../../includes/footer.php'; ?>
</body>

</html>