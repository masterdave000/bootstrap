<?php 

$title = "Building Billing Details";
include './../../includes/side-header.php';


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


            if (filter_has_var(INPUT_GET, 'bldg_billing_id')) {

                $clean_bldg_billing_id = filter_var($_GET['bldg_billing_id'], FILTER_SANITIZE_NUMBER_INT);
                $bldg_billing_id = filter_var($clean_bldg_billing_id, FILTER_VALIDATE_INT);

                $billingQuery = "SELECT * FROM building_billing WHERE bldg_billing_id = :bldg_billing_id";
                $billingStatement = $pdo->prepare($billingQuery);
                $billingStatement->bindParam(':bldg_billing_id', $bldg_billing_id);
                $billingStatement->execute();

                $billing = $billingStatement->fetch(PDO::FETCH_ASSOC);
                
            }
        ?>

        <?php require './../../includes/top-header.php'?>

        <!-- Outer Row -->
        <div class="row d-flex align-items-center justify-content-center overflow-hidden" style="height: 90%;">
            <div class="col-xl-6 col-lg-8 col-md-11 col-sm-11 p-3">
                <div class="card card-body o-hidden shadow-lg p-4">
                    <!-- Nested Row within Card Body -->
                    <div class="d-flex flex-column justify-content-center col-lg-12">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $title?></h1>
                        </div>
                        <form class="user" enctype="multipart/form-data">

                            <div class="col col-12 p-0 form-group">
                                <label>Section <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control p-4" value="<?php echo $billing['bldg_section']?>"
                                    disabled>
                            </div>


                            <div class="col col-12 p-0 form-group">
                                <label>Property Attribute <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control p-4" value="<?php echo $billing['bldg_property_attribute']?>"
                                    disabled>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for="fee">Fee <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>

                                    <input type="number" class="form-control p-4"
                                        value="<?php echo $billing['bldg_fee']?>" disabled>
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