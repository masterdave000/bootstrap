<?php

$title = "Edit User";
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
}
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php
        if (isset($_SESSION['update'])) //Checking whether the session is set or not
        {    //DIsplaying session message
            echo $_SESSION['update'];
            //Removing session message
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['duplicate'])) //Checking whether the session is set or not
        {    //DIsplaying session message
            echo $_SESSION['duplicate'];
            //Removing session message
            unset($_SESSION['duplicate']);
        }
        ?>

        <?php require './../includes/top-header.php' ?>

        <!-- Outer Row -->
        <div class="row d-flex align-items-center justify-content-center overflow-hidden">
            <div class="col-xl-6 col-lg-8 col-md-11 col-sm-11 p-3">
                <div class="card card-body o-hidden shadow-lg p-4">
                    <!-- Nested Row within Card Body -->
                    <div class="d-flex flex-column justify-content-center col-lg-12">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $title ?></p>
                        </div>
                        <form action="./controller/update.php" method="POST" class="user" enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center">
                                <div class="image-container mb-3">
                                    <img src="./../inspector/images/<?php echo $user['inspector_img_url'] ?? 'default.png' ?>" alt="default-inspector-image" class="img-fluid rounded-circle" />
                                </div>

                                <p class="h3 text-gray-900 mb-4 "><?php echo $fullname ?></h1>
                            </div>

                            <div class="col col-12 p-1 form-group d-flex flex-column">
                                <label for="inspector-name">Inspector Name <span class="text-danger">*</span>
                                </label>
                                <div class="d-flex align-items-center justify-content-center select-container">
                                    <select name="inspector_name" id="inspector-name" class="form-control form-select px-3" required>

                                        <option selected hidden value="<?php echo $user['inspector_id'] ?>">
                                            <?php echo $fullname ?></option>
                                        <?php

                                        $inspectorQuery = "SELECT i.*
                                                FROM inspector i
                                                LEFT JOIN users u ON i.inspector_id = u.inspector_id
                                                WHERE u.inspector_id IS NULL";
                                        $inspectorStatement = $pdo->query($inspectorQuery);
                                        $inspectors = $inspectorStatement->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($inspectors as $inspector) {
                                            $firstname = htmlspecialchars(ucwords($inspector['inspector_firstname']));
                                            $midname = htmlspecialchars(ucwords($inspector['inspector_midname'] ? mb_substr($inspector['inspector_midname'], 0, 1, 'UTF-8') . "." : ""));
                                            $lastname = htmlspecialchars(ucwords($inspector['inspector_lastname']));
                                            $suffix = htmlspecialchars(ucwords($inspector['inspector_suffix']));
                                            $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);

                                        ?>

                                            <option value="<?php echo $inspector['inspector_id'] ?>">
                                                <?php echo $fullname ?>
                                            </option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for="username">Username <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="username" class="form-control p-4" id="username" aria-describedby="username" placeholder="Enter Username..." value="<?php echo $user['username'] ?>" required>
                            </div>

                            <div class="col col-12 p-1 form-group d-flex flex-column">
                                <label for="role">Role <span class="text-danger">*</span>
                                </label>
                                <div class="d-flex align-items-center justify-content-center select-container">
                                    <select name="role" id="role" class="form-control form-select px-3" required>
                                        <option selected hidden value="<?php echo $user['role'] ?>">
                                            <?php echo $user['role'] ?>
                                        </option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Inspector - Team Leader">Inspector - Team Leader</option>
                                        <option value="Inspector">Inspector</option>
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block mt-3" value="Edit">
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