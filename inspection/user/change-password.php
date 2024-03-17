<?php 

$title = "Update Password";
include './../includes/side-header.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_user_id = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);
    $user_id = filter_var($clean_user_id, FILTER_VALIDATE_INT);

    $userQuery = "SELECT * FROM user_view WHERE user_id = :user_id";
    $userStatement = $pdo->prepare($userQuery);
    $userStatement->bindParam(':user_id', $user_id);
    $userStatement->execute();

    $user = $userStatement->fetch(PDO::FETCH_ASSOC);
    $firstname = htmlspecialchars(ucwords($user['inspector_firstname']));
    $midname = htmlspecialchars(ucwords($user['inspector_midname'] ? mb_substr($user['inspector_midname'], 0, 1, 'UTF-8') . "." : ""));
    $lastname = htmlspecialchars(ucwords($user['inspector_lastname']));
    $suffix = htmlspecialchars(ucwords($user['inspector_suffix']));
    $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);
    
    $password = md5($user['password']);
    
    $inspector_img_url = $user['inspector_img_url'];
        
    
}
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php

            if (isset($_SESSION['change_pass_failed'])) {
                echo $_SESSION['change_pass_failed'];
                unset($_SESSION['change_pass_failed']);
            }

            if (isset($_SESSION['pass_not_match'])) {
                echo $_SESSION['pass_not_match'];
                unset($_SESSION['pass_not_match']);
            }

            if (isset($_SESSION['user_not_found'])) {
                echo $_SESSION['user_not_found'];
                unset($_SESSION['user_not_found']);
            }
        ?>

        <?php 
            require './../includes/top-header.php';
        ?>

        <div class="row d-flex align-items-center justify-content-center overflow-hidden">
            <div class="col-xl-6 col-lg-8 col-md-11 col-sm-11 p-3">
                <div class="card card-body o-hidden shadow-lg p-4">
                    <!-- Nested Row within Card Body -->
                    <div class="d-flex flex-column justify-content-center col-lg-12">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $title?></h1>
                        </div>
                        <form action="./controller/update-password.php" method="POST" class="user"
                            enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center">
                                <div class="image-container mb-3">
                                    <img src="./../inspector/images/<?php echo $inspector_img_url ?? 'default.png'?>"
                                        alt="default-inspector-image" class="img-fluid rounded-circle" />
                                </div>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for="current-password">Current Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="current_password"
                                    class="form-control form-control-user squared-border" id="current-password"
                                    aria-describedby="current-password" placeholder="Enter Current Password..."
                                    value="<?php echo $password?>" required>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for="new-password">New Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="new_password"
                                    class="form-control form-control-user squared-border" id="new-password"
                                    aria-describedby="new-password" placeholder="Enter New Password..." required>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for="confirm-password">Confirm Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="confirm_password"
                                    class="form-control form-control-user squared-border" id="confirm-password"
                                    aria-describedby="confirm-password" placeholder="Confirm Password..." required>
                            </div>

                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block"
                                value="Update Password">
                        </form>
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

<?php require './../includes/footer.php'; ?>

</body>

</html>