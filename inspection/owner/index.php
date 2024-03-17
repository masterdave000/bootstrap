<?php 

$title = "Owner List";
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

        ?>

        <?php require './../includes/top-header.php'?>

        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <div class="card shadow mb-4">
                <div class="d-flex align-items-center justify-content-between card-header">
                    <h1 class="h3 text-gray-800 mt-2"><?php echo $title ?></h1>
                    <a href="./add-owner.php" class="btn btn-success d-flex justify-content-center align-items-center">
                        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                        <span class="d-none d-lg-inline">Add Owner</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                            <thead>

                            </thead>

                            <tbody>

                                <?php 
                                    $ownerQuery = "SELECT * FROM owner ORDER BY owner_id DESC";
                                    $ownerStatement = $pdo->query($ownerQuery);
                                    $owners = $ownerStatement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($owners as $owner) {
                                        $firstname = htmlspecialchars(ucwords($owner['owner_firstname']));
                                        $midname = htmlspecialchars(ucwords($owner['owner_midname'] ? mb_substr($owner['owner_midname'], 0, 1, 'UTF-8') . "." : ""));
                                        $lastname = htmlspecialchars(ucwords($owner['owner_lastname']));
                                        $suffix = htmlspecialchars(ucwords($owner['owner_suffix']));
                                        $contact_number = htmlspecialchars($owner['contact_number']);
                                        $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);
                                ?>

                                <tr class="d-flex justify-content-between align-items-center border-bottom pb-0">
                                    <td class="p-0 m-0">
                                        <a href="./view-owner.php?owner_id=<?php echo $owner['owner_id']?>"
                                            class="d-flex flex-row align-items-center justify-content-center text-decoration-none text-gray-700 flex-gap">
                                            <div class="image-container d-none d-md-flex img-fluid">
                                                <img src="./images/<?php echo $owner['owner_img_url'] ?? 'default.png'?>"
                                                    alt="inspector-image" class="img-fluid rounded-circle" />
                                            </div>

                                            <div>
                                                <div class="text">
                                                    Name: <?php echo $fullname?>
                                                </div>
                                                <div class="sub-title">ID:
                                                    <?php echo $owner['owner_id']?></div>

                                            </div>
                                        </a>
                                    </td>

                                    <td class="d-flex justify-content-end">
                                        <a href="./update-owner.php?owner_id=<?php echo $owner['owner_id']?>"
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

require './../includes/footer.php';

?>

</body>

</html>