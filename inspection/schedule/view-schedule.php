<?php

$title = "Inspection Schedule Details";
include './../includes/side-header.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_id = filter_var($_GET['schedule_id'], FILTER_SANITIZE_NUMBER_INT);
    $schedule_id = filter_var($clean_id, FILTER_VALIDATE_INT);

    $scheduleQuery = "SELECT bus_name,
                            GROUP_CONCAT(inspector_id) AS inspector_ids,
                            GROUP_CONCAT(
                                 
                                    CONCAT(
                                        inspector_firstname, 
                                        IFNULL(CONCAT(' ', LEFT(inspector_midname, 1), '.'), ''), 
                                        ' ', 
                                        inspector_lastname, 
                                        ' ', 
                                        inspector_suffix
                                    )
                            ) AS inspector_fullnames,
                            schedule_date,
                            bus_img_url 
                            FROM business_inspection_schedule_view WHERE schedule_id = :schedule_id";
    $scheduleStatement = $pdo->prepare($scheduleQuery);
    $scheduleStatement->bindParam(':schedule_id', $schedule_id);
    $scheduleStatement->execute();

    $scheduleData = $scheduleStatement->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">


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

                        <?php
                        foreach ($scheduleData as $schedule) {

                            $inspector_ids = explode(',', $schedule['inspector_ids']);
                            $inspector_fullnames = explode(' ,', $schedule['inspector_fullnames']);
                        ?>
                            <form action="" method="" class="user" id="certificate-form" enctype="multipart/form-data">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="image-container mb-3">
                                        <img src="./../business/images/<?= $schedule['bus_img_url'] ?>" alt="default-item-image" class="img-fluid rounded-circle" id="bus-img" />
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

                                            <div class="col col-12 p-0 form-group">
                                                <label>Business Name </label>

                                                <div class="input-group">
                                                    <input type="text" class="form-control p-4" value="<?= $schedule['bus_name'] ?>" required readonly>
                                                </div>
                                            </div>

                                            <div class="col col-12 p-0 form-group">
                                                <label>Inspection Date </label>

                                                <div class="input-group">
                                                    <input type="date" class="form-control p-4" value="<?= $schedule['schedule_date'] ?>" required readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="carousel-item p-2" data-bs-interval="false">
                                            <div class="d-flex flex-column" id="inspector-container">
                                                <div class="d-flex justify-content-between">
                                                    <p class="text font-weight-bolder">Inspector Information</p>
                                                    <p class="text font-weight-bolder">Total
                                                        Inspector: <span id="total-inspector"><?= count($inspector_ids) ?></span>
                                                    </p>
                                                </div>

                                                <?php
                                                foreach ($inspector_ids as $index => $inspector_id) :

                                                    $inspector_fullname = $inspector_fullnames[$index];

                                                ?>

                                                    <div class="shadow bg-white rounded p-3 mb-2" id="inspector-content-1">
                                                        <a id="inspector-title-1" class="text text-decoration-none" style="cursor: pointer; font-weight: 700;">Inspector
                                                            <?= $index + 1 ?></a>
                                                        <div class="col col-12 p-0 form-group mb-1">
                                                            <label>Inspector Name</label>

                                                            <input type="text" name="inspector_name[]" class="form-control p-4" value="<?= $inspector_fullname ?>" readonly>
                                                        </div>

                                                    </div>
                                                <?php endforeach ?>
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
                            </form>

                        <?php
                        }
                        ?>
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