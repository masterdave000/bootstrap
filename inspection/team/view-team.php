<?php

$title = "Team Details";
include './../includes/side-header.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_id = filter_var($_GET['team_id'], FILTER_SANITIZE_NUMBER_INT);
    $team_id = filter_var($clean_id, FILTER_VALIDATE_INT);

    $teamQuery = "SELECT team_name,
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
                            inspector_img_url 
                            FROM inspector_team_view WHERE team_id = :team_id";
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

                            $inspector_ids = explode(',', $team['inspector_ids']);
                            $inspector_fullnames = explode(' ,', $team['inspector_fullnames']);
                        ?>
                            <form action="" method="" class="user" id="certificate-form" enctype="multipart/form-data">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="image-container mb-3">
                                        <img src="./../inspector/images/<?= $team['inspector_img_url'] ?>" alt="default-item-image" class="img-fluid rounded-circle" id="inspector-img" />
                                    </div>
                                </div>

                                <div id="scheduleCarousel" class="carousel slide">
                                    <div class="carousel-inner">

                                        <div class="carousel-item active p-2" data-bs-interval="false">

                                            <div class="col col-12 p-0 form-group">
                                                <label>Team Name
                                                </label>
                                                <input type="text" class="form-control p-4" value="<?= $team['team_name']?>" readonly>
                                            </div>

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