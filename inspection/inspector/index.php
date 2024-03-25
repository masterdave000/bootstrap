<?php 

$title = "Inspector List";
require "./../includes/side-header.php";

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

        ?>

        <?php require './../includes/top-header.php'?>

        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <div class="card shadow mb-4">
                <div class="d-flex align-items-center justify-content-between card-header">
                    <h1 class="h3 text-gray-800 mt-2"><?php echo $title ?></h1>
                    <a href="./add-inspector.php"
                        class="btn btn-success d-flex justify-content-center align-items-center">
                        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                        <span class="d-none d-lg-inline">Add</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                            <thead>

                            </thead>

                            <tbody>

                                <?php 
                                    $inspectorQuery = "SELECT inspector_id, inspector_firstname, inspector_midname, inspector_lastname, inspector_suffix, contact_number, inspector_img_url FROM inspector ORDER BY inspector_id DESC";
                                    $inspectorStatement = $pdo->query($inspectorQuery);
                                    $inspectors = $inspectorStatement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($inspectors as $inspector) {
                                        $firstname = htmlspecialchars(ucwords($inspector['inspector_firstname']));
                                        $midname = htmlspecialchars(ucwords($inspector['inspector_midname'] ? mb_substr($inspector['inspector_midname'], 0, 1, 'UTF-8') . "." : ""));
                                        $lastname = htmlspecialchars(ucwords($inspector['inspector_lastname']));
                                        $suffix = htmlspecialchars(ucwords($inspector['inspector_suffix']));
                                        $contact_number = htmlspecialchars($inspector['contact_number']);
                                        $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);
                                ?>

                                <tr class="d-flex justify-content-between align-items-center border-bottom py-1">
                                    <td class="p-0 m-0">
                                        <a href="./view-inspector.php?inspector_id=<?php echo $inspector['inspector_id']?>"
                                            class="d-flex flex-row align-items-center justify-content-center text-decoration-none text-gray-700 flex-gap">
                                            <div class="image-container img-fluid">
                                                <img src="./images/<?php echo $inspector['inspector_img_url'] ?? 'default.png'?>"
                                                    alt="inspector-image" class="img-fluid rounded-circle" />
                                            </div>

                                            <div>
                                                <div class="text">
                                                    <span class="d-none d-md-inline">Name:</span>
                                                    <?php echo $fullname?>
                                                </div>
                                                <div class=" sub-title d-none d-md-flex">ID:
                                                    <?php echo $inspector['inspector_id']?>
                                                </div>

                                            </div>
                                        </a>
                                    </td>

                                    <td class="d-flex justify-content-end">
                                        <a href="./update-inspector.php?inspector_id=<?php echo $inspector['inspector_id']?>"
                                            class="btn btn-primary mr-2 text-center d-flex align-items-center">
                                            <i class="fa fa-pencil-square mr-1" aria-hidden="true"></i>
                                            <span class="d-none d-lg-inline">Edit</span>
                                        </a>

                                        <a href="#" data-toggle="modal" data-target="#deleteModal"
                                            class="btn btn-danger d-flex justify-content-center align-items-center">
                                            <i class="fa fa-trash mr-1" aria-hidden="true"></i>
                                            <span class="d-none d-lg-inline">Delete</span>
                                        </a>

                                    </td>
                                </tr>

                                <?php
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

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php 

require './modals/delete.php';
require './../includes/footer.php';

?>

</body>

</html>