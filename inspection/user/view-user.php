<?php

$title = "User Details";
include './../includes/side-header.php';

if ($role !== 'Administrator') {
    $_SESSION['redirect'] = "
    <div class='msgalert alert--danger' id='alert'>
        <div class='alert__message'>
            Restricted Access
    </div>
";

    header('location:' . SITEURL . 'inspection/dashboard/');
    exit;
}

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
}
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">

        <?php require './../includes/top-header.php' ?>

        <div class="row d-flex align-items-center justify-content-center overflow-hidden">
            <div class="col-xl-6 col-lg-8 col-md-11 col-sm-11 p-3">
                <div class="card card-body o-hidden shadow-lg p-4">
                    <!-- Nested Row within Card Body -->
                    <div class="d-flex flex-column justify-content-center col-lg-12">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $title ?></h1>
                        </div>
                        <form class="user" enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center">
                                <div class="image-container mb-3">
                                    <img src="./../inspector/images/<?php echo $user['inspector_img_url'] ?? 'default.png' ?>" alt="default-inspector-image" class="img-fluid rounded-circle" />
                                </div>

                                <p class="h3 text-gray-900 mb-4 "><?php echo $fullname ?></p>

                            </div>

                            <div class="col col-12 p-1 form-group d-flex flex-column">
                                <label for="inspector-name">Inspector Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control p-4" value="<?php echo $fullname ?>" disabled>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for="username">Username <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control p-4" value="<?php echo $user['username'] ?>" disabled>
                            </div>

                            <div class="col col-12 p-1 form-group d-flex flex-column">
                                <label for="role">Role <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control p-4" value="<?php echo $user['role'] ?>" disabled>
                            </div>
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