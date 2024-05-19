<?php

$title = "Inspection List";
require "./../includes/side-header.php";

?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">

        <?php require './../includes/top-header.php' ?>

        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <div class="card shadow mb-4">
                <div class="d-flex align-items-center justify-content-between card-header h-75">
                    <h1 class="h3 text-gray-800 mt-2"><?php echo $title ?></h1>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#business-list" class="btn btn-primary d-flex justify-content-center align-items-center">
                        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                        <span class="d-none d-lg-inline">Issue</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="obosTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="d-flex justify-content-between border-bottom">
                                    <th>
                                        Category
                                    </th>

                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $inspectionQuery = "SELECT DISTINCT inspection_id, bus_name, bus_img_url, date_inspected FROM inspection_view";

                                $bindings = [];
                                if ($role !== 'Administrator') {
                                    $inspectionQuery .= " WHERE inspection_id = :inspection_id";
                                    $bindings[':inspection_id'] = $user_inspector_id;
                                }

                                $inspectionQuery .= " ORDER BY inspection_id DESC";
                                $inspectionStatement = $pdo->prepare($inspectionQuery);
                                $inspectionStatement->execute($bindings);
                                $inspections = $inspectionStatement->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($inspections as $inspection) :
                                ?>


                                    <tr class="d-flex justify-content-between align-items-center border-bottom py-1">
                                        <td class="p-0 m-0">
                                            <a href="./view-inspection.php?inspection_id=<?php echo $inspection['inspection_id'] ?>" class="d-flex flex-row align-items-center justify-content-center text-decoration-none
                                text-gray-700 flex-gap">
                                                <div class="image-container img-fluid">
                                                    <img src="./../business/images/<?php echo $inspection['bus_img_url'] ?? 'no-image.png' ?>" alt="inspector-image" class="img-fluid rounded-circle" />
                                                </div>

                                                <div>
                                                    <div class="text">
                                                        <?php echo $inspection['bus_name'] ?>
                                                    </div>
                                                    <div class="sub-title d-none d-md-flex">Date Inspected:
                                                        <?php echo $inspection['date_inspected'] ?></div>

                                                </div>
                                            </a>
                                        </td>
                                    </tr>

                                <?php

                                endforeach;
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

include "./modals/business.php";
?>

<?php

if (isset($_SESSION['add'])) { //Checking whether the session is set or not
    //DIsplaying session message
    echo $_SESSION['add'];
    //Removing session message
    unset($_SESSION['add']);
}



?>


<?php if (filter_has_var(INPUT_GET, 'msg')) : ?>
    <div class='msgalert alert--success' id='alert'>
        <div class='alert__message'>
            <?php
            $msg = htmlspecialchars($_GET['msg']);
            unset($_GET['msg']);
            echo $msg;
            ?>
        </div>
    </div>
<?php endif ?>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php
require './../includes/footer.php';
?>

</body>

</html>