<?php

$title = "Schedule List";
require "./../includes/side-header.php";

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">

        <?php require './../includes/top-header.php' ?>

        <div class="container-fluid mt-4">
            <!-- Page Heading -->

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="d-flex align-items-center justify-content-between card-header">
                    <h1 class="h3 text-gray-800 mt-2"><?php echo $title ?></h1>
                    <?php if ($role !== 'Inspector') : ?>
                        <a href="./add-schedule.php" class="btn btn-primary d-flex justify-content-center align-items-center">
                            <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                            <span class="d-none d-lg-inline">Add</span>
                        </a>
                    <?php endif ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="obosTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="d-flex justify-content-between border-bottom">
                                    <th>
                                        Business Name
                                    </th>

                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $scheduleQuery = "SELECT DISTINCT schedule_id, bus_name, schedule_date, bus_img_url FROM business_inspection_schedule_view";

                                $bindings = [];

                                if ($_SESSION['role'] !== 'Administrator') {
                                    $scheduleQuery .= " WHERE inspector_id = :inspector_id";
                                    $bindings[':inspector_id'] = $user_inspector_id;
                                }
                                $scheduleQuery .= " ORDER BY schedule_date DESC";

                                $scheduleStatement = $pdo->prepare($scheduleQuery);
                                $scheduleStatement->execute($bindings);

                                $schedule = $scheduleStatement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($schedule as $schedules) {
                                    $schedule_id = htmlspecialchars(ucwords($schedules['schedule_id']));
                                    $bus_name = htmlspecialchars(ucwords($schedules['bus_name']));

                                ?>

                                    <tr class="d-flex justify-content-between align-items-center border-bottom py-1">
                                        <td class="p-0 m-0">
                                            <a href="view-schedule.php?schedule_id=<?php echo $schedules['schedule_id'] ?>" class="d-flex flex-row align-items-center justify-content-center text-decoration-none text-gray-700 flex-gap" href="./view-schedule.php?schedule_id=<?php echo $schedules['schedule_id'] ?>">
                                                <div class="image-container img-fluid">
                                                    <img src="<?= SITEURL ?>inspection/business/images/<?php echo $schedules['bus_img_url'] ?? 'no-image.png' ?>" alt="inspector-image" class="img-fluid rounded-circle" />
                                                </div>

                                                <div>
                                                    <div class="text">
                                                        <?php echo $bus_name ?>
                                                    </div>
                                                    <div class="sub-title d-none d-md-flex">Inspection Schedule:
                                                        <?php echo $schedules['schedule_date'] ?>
                                                    </div>

                                                </div>
                                            </a>
                                        </td>

                                        <td class="d-flex justify-content-end">

                                            <?php if ($role !== 'Inspector') : ?>
                                                <a href="./update-schedule.php?schedule_id=<?php echo $schedules['schedule_id'] ?>" class="btn btn-info mr-2 text-center d-flex align-items-center">
                                                    <i class="fa fa-pencil-square mr-1" aria-hidden="true"></i>
                                                    <span class="d-none d-lg-inline">Edit</span>
                                                </a>

                                                <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-<?php echo $schedules['schedule_id'] ?>" class="btn btn-danger d-flex justify-content-center align-items-center">
                                                    <i class="fa fa-trash mr-1" aria-hidden="true"></i>
                                                    <span class="d-none d-lg-inline">Delete</span>
                                                </a>
                                            <?php endif ?>
                                        </td>
                                    </tr>

                                <?php
                                    require './modals/delete.php';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

if (isset($_SESSION['add'])) //Checking whether the session is set or not
{    //DIsplaying session message
    echo $_SESSION['add'];
    //Removing session message
    unset($_SESSION['add']);
}

if (isset($_SESSION['delete'])) {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}

if (isset($_SESSION['update'])) {
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}

if (isset($_SESSION['invalid_password'])) {
    echo $_SESSION['invalid_password'];
    unset($_SESSION['invalid_password']);
}

if (isset($_SESSION['id_not_found'])) {
    echo $_SESSION['id_not_found'];
    unset($_SESSION['id_not_found']);
}

if (isset($_SESSION['redirect'])) {
    echo $_SESSION['redirect'];
    unset($_SESSION['redirect']);
}
?>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php
require './../includes/footer.php';
?>



</body>

</html>