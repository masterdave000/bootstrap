<?php

$title = "Team Leaders List";
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
                        <a href="./add-team.php" class="btn btn-primary d-flex justify-content-center align-items-center">
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
                                        Team Leader
                                    </th>

                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $teamQuery = "SELECT DISTINCT team_id, inspector_firstname, inspector_midname, inspector_lastname, inspector_suffix, team_name, inspector_img_url FROM inspector_team_view WHERE team_role = :team_role";

                                $bindings = [];

                                if ($_SESSION['role'] !== 'Administrator') {
                                    $teamQuery .= " AND inspector_id = :inspector_id";
                                    $bindings[':inspector_id'] = $user_inspector_id;
                                }
                                $bindings[':team_role'] = 'Leader';
                                $teamQuery .= " ORDER BY team_member_id DESC";

                                $teamStatement = $pdo->prepare($teamQuery);
                                $teamStatement->execute($bindings);

                                $teams = $teamStatement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($teams as $team) {
                                    $team_id = htmlspecialchars(ucwords($team['team_id']));

                                    $firstname = htmlspecialchars(ucwords($team['inspector_firstname']));
                                    $midname = htmlspecialchars(ucwords($team['inspector_midname'] ? mb_substr($team['inspector_midname'], 0, 1, 'UTF-8') . "." : ""));
                                    $lastname = htmlspecialchars(ucwords($team['inspector_lastname']));
                                    $suffix = htmlspecialchars(ucwords($team['inspector_suffix']));
                                    $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);

                                ?>

                                    <tr class="d-flex justify-content-between align-items-center border-bottom py-1">
                                        <td class="p-0 m-0">
                                            <a href="view-team.php?team_id=<?php echo $team['team_id'] ?>" class="d-flex flex-row align-items-center justify-content-center text-decoration-none text-gray-700 flex-gap" href="./view-team.php?team_id=<?php echo $team['team_id'] ?>">
                                                <div class="image-container img-fluid">
                                                    <img src="<?= SITEURL ?>inspection/inspector/images/<?php echo $team['inspector_img_url'] ?? 'no-image.png' ?>" alt="inspector-image" class="img-fluid rounded-circle" />
                                                </div>

                                                <div>
                                                    <div class="text">
                                                        <?php echo $fullname ?>
                                                    </div>
                                                    <div class="sub-title d-none d-md-flex">Team Name:
                                                        <?php echo $team['team_name'] ?>
                                                    </div>

                                                </div>
                                            </a>
                                        </td>

                                        <td class="d-flex justify-content-end">

                                            <?php if ($role === 'Administrator') : ?>
                                                <a href="./update-team.php?team_id=<?php echo $team['team_id'] ?>" class="btn btn-info mr-2 text-center d-flex align-items-center">
                                                    <i class="fa fa-pencil-square mr-1" aria-hidden="true"></i>
                                                    <span class="d-none d-lg-inline">Edit</span>
                                                </a>

                                                <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-<?php echo $team['team_id'] ?>" class="btn btn-danger d-flex justify-content-center align-items-center">
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