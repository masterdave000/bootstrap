<?php
ob_start();

$title = "Edit Inspection Schedule";
include './../includes/side-header.php';

if ($role === 'Inspector') {
    $_SESSION['redirect'] = "
    <div class='msgalert alert--danger' id='alert'>
        <div class='alert__message'>
            Restricted Access
    </div>
";

    header('location:' . SITEURL . 'inspection/schedule/');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_id = filter_var($_GET['schedule_id'], FILTER_SANITIZE_NUMBER_INT);
    $schedule_id = filter_var($clean_id, FILTER_VALIDATE_INT);

    $scheduleQuery = "SELECT schedule_id, bus_id, team_id, 
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
                            GROUP_CONCAT(team_role) AS team_roles,
                            schedule_date,
                            bus_img_url FROM business_inspection_schedule_view WHERE schedule_id = :schedule_id ORDER BY inspector_id DESC";
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

        <?php

        if (isset($_SESSION['update'])) //Checking whether the session is set or not
        {    //DIsplaying session message
            echo $_SESSION['update'];
            //Removing session message
            unset($_SESSION['update']);
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

                        <?php
                        foreach ($scheduleData as $schedule) {

                            $inspector_ids = explode(',', $schedule['inspector_ids']);

                            $inspector_fullnames = explode(',', $schedule['inspector_fullnames']);
                            $team_roles = explode(',', $schedule['team_roles']);
                        ?>
                            <form action="./controller/update.php" method="POST" class="user" id="certificate-form" enctype="multipart/form-data">
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

                                            <div class="form-group d-flex flex-column flex-md-grow-1">
                                                <label for="business-id">Business Name <span class="text-danger">*</span>
                                                </label>
                                                <div class="d-flex align-items-center justify-content-center select-container">
                                                    <select name="business_id" id="schedule-business-id" class="form-control form-select px-3" required>
                                                        <option selected hidden value="">Select</option>
                                                        <?php
                                                        $businessQuery = "SELECT * from business";
                                                        $businessStatement = $pdo->query($businessQuery);
                                                        $businesses = $businessStatement->fetchAll(PDO::FETCH_ASSOC);

                                                        foreach ($businesses as $business) {
                                                        ?>

                                                            <option <?= $schedule['bus_id'] === $business['bus_id'] ? 'selected' : '' ?> value="<?php echo $business['bus_id'] ?>">
                                                                <?php echo $business['bus_name'] ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col col-12 p-0 form-group">
                                                <label for="schedule-date">Inspection Date <span class="text-danger">*</span></label>

                                                <div class="input-group">
                                                    <input type="date" name="schedule_date" class="form-control p-4" id="schedule-date" placeholder="Enter Inspection Date..." max="<?= date('Y-m-d') ?>" value="<?= $schedule['schedule_date'] ?>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="carousel-item p-2" data-bs-interval="false">
                                            <div class="d-flex flex-column" id="inspector-schedule-container">
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
                                                        <a id="inspector-title-<?= $index + 1 ?>" class="text text-decoration-none" style="cursor: pointer; font-weight: 700;">Inspector
                                                            <?= $index + 1 ?></a>
                                                        <div class="col col-12 p-0 form-group mb-1">
                                                            <label>Inspector Name</label>

                                                            <input type="text" name="inspector_name[]" id="inspector-name-<?= $index + 1 ?>" class="form-control p-4" value="<?= $inspector_fullname ?>" readonly>
                                                        </div>

                                                        <div class="col col-12 p-0 form-group mb-1">
                                                            <label>Team Role</label>

                                                            <input type="text" name="team_role[]" id="team-role-<?= $index + 1 ?>" class="form-control p-4" value="<?= $team_roles[$index] ?>" readonly>
                                                        </div>

                                                        <input type="hidden" name="team_id" value="<?= $schedule['team_id'] ?>" id="team-id-<?= $index + 1 ?>">
                                                    </div>
                                                <?php endforeach ?>
                                            </div>

                                            <div class="d-flex justify-content-end my-4">
                                                <a class="btn btn-primary btn-md-block px-3 <?= $index > 0 ? 'd-none' : '' ?>" id="add-team-button" data-bs-target="#team-list" data-bs-toggle="modal">Add
                                                    Team</a>
                                                <a class="btn btn-danger btn-md-block px-3 <?= count($inspector_ids) > 0 ? 'ml-3' : 'd-none' ?>" id="delete-team">Delete
                                                    Team</a>
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

                                <input type="hidden" name="schedule_id" value="<?= $schedule['schedule_id'] ?>">
                                <div class="text-center mt-4 d-none formSubmit">
                                    <input type="submit" name="submit" class="btn btn-primary btn-user btn-block mt-3" value="Edit">
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
require './modals/team.php';
?>

</body>

</html>

<?php
ob_end_flush(); // Flush output buffer and send output to the browser
?>