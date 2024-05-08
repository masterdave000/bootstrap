<?php

$title = "Electronics Billing Details";
include './../../includes/side-header.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_electronics_id = filter_var($_GET['electronics_id'], FILTER_SANITIZE_NUMBER_INT);
    $electronics_id = filter_var($clean_electronics_id, FILTER_VALIDATE_INT);

    $electronicsBilling = "SELECT * FROM electronics_billing WHERE electronics_id = :electronics_id";
    $electronicsStatement = $pdo->prepare($electronicsBilling);
    $electronicsStatement->bindParam(':electronics_id', $electronics_id);
    $electronicsStatement->execute();

    $electronics = $electronicsStatement->fetch(PDO::FETCH_ASSOC);
}
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

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
                                <label>Section
                                </label>
                                <input type="text" class="form-control p-4" value="<?= $electronics['electronics_section'] ?>" disabled>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for="fee">Fee
                                </label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>

                                    <input type="number" class="form-control p-4" value="<?= $electronics['electronics_fee'] ?>" disabled>
                                </div>
                            </div>
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