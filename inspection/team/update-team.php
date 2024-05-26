<?php
ob_start();

$title = "Edit Team";
include './../includes/side-header.php';

if ($role !== 'Administrator') {
    $_SESSION['redirect'] = "
    <div class='msgalert alert--danger' id='alert'>
        <div class='alert__message'>
            Restricted Access
    </div>
";

    header('location:' . SITEURL . 'inspection/team/');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_id = filter_var($_GET['team_id'], FILTER_SANITIZE_NUMBER_INT);
    $team_id = filter_var($clean_id, FILTER_VALIDATE_INT);

    $teamQuery = "SELECT GROUP_CONCAT(team_member_id) AS team_member_ids,
                            team_id, team_name,
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
                            inspector_img_url FROM inspector_team_view WHERE team_id = :team_id ORDER BY team_member_id DESC";
    $teamStatement = $pdo->prepare($teamQuery);
    $teamStatement->bindParam(':team_id', $team_id);
    $teamStatement->execute();

    $teamData = $teamStatement->fetchAll(PDO::FETCH_ASSOC);
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
                        foreach ($teamData as $team) {

                            $team_member_ids = explode(',', $team['team_member_ids']);
                            $inspector_ids = explode(',', $team['inspector_ids']);
                            $team_roles = explode(',', $team['team_roles']);
                            $inspector_fullnames = explode(' ,', $team['inspector_fullnames']);


                        ?>
                            <form action="./controller/update.php" method="POST" class="user" id="certificate-form" enctype="multipart/form-data">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="image-container mb-3">
                                        <img src="./../inspector/images/<?= $schedule['inspector_img_url'] ?>" alt="default-item-image" class="img-fluid rounded-circle" id="inspector-img" />
                                    </div>
                                </div>

                                <div id="scheduleCarousel" class="carousel slide">

                                    <div class="carousel-inner">
                                        <div class="carousel-item active p-2" data-bs-interval="false">
                                            <div class="col col-12 p-0 form-group">
                                                <label for="team-name">Team Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="team_name" class="form-control p-4" id="team-name" placeholder="Enter Team Name..." value="<?= $team['team_name'] ?>" required>
                                            </div>

                                            <div class="d-flex flex-column" id="inspector-team-container">
                                                <div class="d-flex justify-content-between">
                                                    <p class="text font-weight-bolder">Inspector Information</p>
                                                    <p class="text font-weight-bolder">Total
                                                        Inspector: <span id="total-inspector"><?= count($inspector_ids) ?></span>
                                                    </p>
                                                </div>

                                                <?php
                                                foreach ($inspector_ids as $index => $inspector_id) :

                                                    $inspector_fullname = $inspector_fullnames[$index];
                                                    $team_role = $team_roles[$index];

                                                ?>

                                                    <div class="shadow bg-white rounded p-3 mb-2" id="inspector-content-1">
                                                        <a id="inspector-title-<?= $index + 1 ?>" class="text text-decoration-none" style="cursor: pointer; font-weight: 700;">Inspector
                                                            <?= $index + 1 ?></a>
                                                        <div class="col col-12 p-0 form-group mb-1">
                                                            <label>Inspector Name</label>

                                                            <input type="text" name="inspector_name[]" id="inspector-name-<?= $index + 1 ?>" class="form-control p-4" value="<?= $inspector_fullname ?>" readonly>
                                                        </div>

                                                        <div class="form-group flex-column flex-md-grow-1" id="">
                                                            <label>Role <strong style="color:red;">*</strong></label>
                                                            <div class="d-flex align-items-center justify-content-center select-container" id="">
                                                                <select class="form-control form-select" id="role-2" name="role[]">
                                                                    <option selected value="<?= $team_role ?>" hidden><?= $team_role ?> </option>
                                                                    <option value="Leader">Leader</option>
                                                                    <option value="Member">Member</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="team_member_id[]" value="<?= $team_member_ids[$index] ?>" id="team-member-id-<?= $index + 1 ?>">

                                                        <input type="hidden" name="inspector_id[]" value="<?= $inspector_id ?>" id="inspector-id-<?= $index + 1 ?>">
                                                    </div>
                                                <?php endforeach ?>
                                            </div>

                                            <div class="d-flex justify-content-end my-4">
                                                <a class="btn btn-primary btn-md-block px-3" data-bs-target="#inspector-list" data-bs-toggle="modal">Add
                                                    Inspector</a>
                                                <a class="btn btn-danger btn-md-block px-3 <?= count($inspector_ids) > 0 ? 'ml-3' : 'd-none' ?>" id="delete-inspector">Delete
                                                    Inspector</a>
                                            </div>
                                        </div>

                                    </div>


                                </div>

                                <input type="hidden" name="team_id" value="<?= $team['team_id'] ?>">
                                <div class="text-center mt-4 formSubmit">
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
require './modals/inspector.php';
?>

</body>

</html>

<?php
ob_end_flush(); // Flush output buffer and send output to the browser
?>