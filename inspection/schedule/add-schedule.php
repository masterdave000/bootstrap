<?php

$title = "Add Inspection Schedule";
include './../includes/side-header.php';

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">


        <?php require './../includes/top-header.php' ?>

        <?php

        if (isset($_SESSION['add'])) //Checking whether the session is set or not
        {    //DIsplaying session message
            echo $_SESSION['add'];
            //Removing session message
            unset($_SESSION['add']);
        }
        ?>

        <!-- Outer Row -->
        <div class="row d-flex align-items-center justify-content-center overflow-hidden">
            <div class="col-xl-6 col-lg-8 col-md-11 col-sm-11 p-3">
                <div class="card card-body o-hidden shadow-lg p-4">
                    <!-- Nested Row within Card Body -->
                    <div class="d-flex flex-column justify-content-center col-lg-12">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $title ?></h1>
                        </div>
                        <form action="./controller/create.php" method="POST" class="user" id="certificate-form" enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center">
                                <div class="image-container mb-3">
                                    <img src="./../business/images/no-image.png" alt="default-item-image" class="img-fluid rounded-circle" id="bus-img" />
                                </div>
                            </div>

                            <div id="scheduleCarousel" class="carousel slide">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#scheduleCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#scheduleCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#scheduleCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active p-2" data-bs-interval="false">

                                        <p class="text font-weight-bolder">Business Information</p>

                                        <div class="form-group d-flex flex-column flex-md-grow-1">
                                            <label for="business-id">Business Name <span class="text-danger">*</span>
                                            </label>
                                            <div class="d-flex align-items-center justify-content-center select-container">
                                                <select name="business_id" id="" class="form-control form-select px-3" required>
                                                    <option selected disabled hidden value="">Select</option>
                                                    <?php
                                                    $businessQuery = "SELECT * from business";
                                                    $businessStatement = $pdo->query($businessQuery);
                                                    $businesses = $businessStatement->fetchAll(PDO::FETCH_ASSOC);

                                                    foreach ($businesses as $business) {
                                                    ?>

                                                        <option value="<?php echo $business['bus_id'] ?>">
                                                            <?php echo $business['bus_name'] ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col col-12 p-0 form-group">
                                            <label for="schedule-date">Inspection Date </label>

                                            <div class="input-group">
                                                <input type="date" name="schedule_date" class="form-control p-4" id="schedule-date" placeholder="Enter Inspection Date..." max="<?= date('Y-m-d') ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="carousel-item p-2" data-bs-interval="false">
                                        <div class="d-flex flex-column" id="inspector-container">
                                            <div class="d-flex justify-content-between">
                                                <p class="text font-weight-bolder">Inspector Information</p>
                                                <p class="text font-weight-bolder">Total
                                                    Inspector: <span id="total-inspector">0</span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end my-4">
                                            <a class="btn btn-primary btn-md-block px-3" data-bs-target="#inspector-list" data-bs-toggle="modal">Add
                                                Inspector</a>
                                            <a class="btn btn-danger btn-md-block px-3 d-none" id="delete-inspector">Delete
                                                Inspector</a>
                                        </div>
                                    </div>

                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <div class="previous-container invisible">
                                        <button class="d-flex justify-content-center align-items-center border-0 bg-dark p-2 previous carousel-button" data-bs-target="#scheduleCarousel" role="button" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                    <div class="next-container">
                                        <button class="d-flex justify-content-center align-items-center border-0 bg-dark p-2 next carousel-button" data-bs-target="#scheduleCarousel" role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4 d-none formSubmit">
                                <input type="submit" name="submit" class="btn btn-primary btn-user btn-block mt-3" value="Add">
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

<?php

require './../includes/footer.php';
require './modals/inspector.php';
?>

</body>

</html>