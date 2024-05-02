<?php 

$title = "Manage User";
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
        
            if (isset($_SESSION['change_pass_success'])) {
                 echo $_SESSION['change_pass_success'];
                unset($_SESSION['change_pass_success']);
            }
        
            if (isset($_SESSION['no_user_data_found'])) {
                echo $_SESSION['no_user_data_found'];
                unset($_SESSION['no_user_data_found']);
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

        <div class="container-fluid mt-4">
            <div class="card shadow mb-4">
                <div class="d-flex align-items-center justify-content-between card-header">
                    <h1 class="h3 text-gray-800 mt-2"><?php echo $title ?></h1>
                    <a href="./add-user.php" class="btn btn-success d-flex justify-content-center align-items-center">
                        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                        <span class="d-none d-lg-inline">Add</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="d-flex justify-content-between border-bottom">
                                    <th>
                                        User
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php 
                                    $userQuery = "SELECT * FROM user_view ORDER BY user_id";
                                    $userStatement = $pdo->query($userQuery);
                                    $users = $userStatement->fetchAll(PDO::FETCH_ASSOC);

                                    if ($users) :
                                        foreach ($users as $user) :
                                            $firstname = htmlspecialchars(ucwords($user['inspector_firstname']));
                                            $midname = htmlspecialchars(ucwords($user['inspector_midname'] ? mb_substr($user['inspector_midname'], 0, 1, 'UTF-8') . "." : ""));
                                            $lastname = htmlspecialchars(ucwords($user['inspector_lastname']));
                                            $suffix = htmlspecialchars(ucwords($user['inspector_suffix']));
                                            
                                            $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);
                                ?>

                                <tr class="d-flex justify-content-between align-items-center border-bottom py-1">
                                    <td class="p-0 m-0">
                                        <a href="./view-user.php?user_id=<?php echo $user['user_id']?>"
                                            class="d-flex align-items-center justify-content-between text-decoration-none text-gray-700 flex-gap">
                                            <div class="image-container img-fluid">
                                                <img src="./../inspector/images/<?php echo $user['inspector_img_url'] ?? 'default.png'?>"
                                                    alt="inspector-image" class="img-fluid rounded-circle" />
                                            </div>

                                            <div>
                                                <div class="text">
                                                    <?php echo $fullname?>
                                                </div>
                                                <div class="sub-title">
                                                    <span class="d-none d-md-inline">Username:</span>
                                                    <?php echo $user['username']?>
                                                </div>
                                            </div>
                                        </a>
                                    </td>

                                    <td class="d-flex justify-content-end">
                                        <a href="./update-user.php?user_id=<?php echo $user['user_id']?>"
                                            class="btn btn-primary mr-2 text-center d-flex align-items-center">
                                            <i class="fa fa-pencil-square mr-1" aria-hidden="true"></i>
                                            <span class="d-none d-lg-inline">Edit</span>
                                        </a>

                                        <a href="./change-password.php?user_id=<?php echo $user['user_id']?>"
                                            class="btn btn-warning mr-2 text-center d-flex justify-content-center align-items-center">
                                            <i class="fa fa-key mr-1" aria-hidden="true"></i>
                                            <span class="d-none d-lg-inline">Change Password</span>
                                        </a>

                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal-<?php echo $user['user_id']?>"
                                            class="btn btn-danger d-flex justify-content-center align-items-center">
                                            <i class="fa fa-trash mr-1" aria-hidden="true"></i>
                                            <span class="d-none d-lg-inline">Delete</span>
                                        </a>

                                    </td>
                                </tr>

                                <?php
                                require './modals/delete.php';
                                    endforeach  
                                ?>

                                <?php else : ?>

                                <div class="img-fluid w-100 d-flex flex-column align-items-center bg-white m-0 p-0">
                                    <img src="<?php echo SITEURL?>assets/img/no_data.png" alt="no-data-image"
                                        class="img-fluid w-50 m-0 no-data-image" />
                                    <p class="font-weight-bolder m-0 p-0">No Data</p>
                                </div>

                                <?php endif;?>
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