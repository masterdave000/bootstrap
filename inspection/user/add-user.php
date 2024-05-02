<?php 

$title = "Add User";
include './../includes/side-header.php';

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php
            if (isset($_SESSION['pass_not_match'])) //Checking whether the session is set or not
            {	//DIsplaying session message
                echo $_SESSION['pass_not_match'];
                //Removing session message
                unset($_SESSION['pass_not_match']);
            }

            if (isset($_SESSION['add'])) //Checking whether the session is set or not
            {	//DIsplaying session message
                echo $_SESSION['add'];
                //Removing session message
                unset($_SESSION['add']);
            }
        ?>

        <?php require './../includes/top-header.php'?>

        <!-- Outer Row -->
        <div class="row d-flex align-items-center justify-content-center overflow-hidden">
            <div class="col-xl-6 col-lg-8 col-md-11 col-sm-11 p-3">
                <div class="card card-body o-hidden shadow-lg p-4">
                    <!-- Nested Row within Card Body -->
                    <div class="d-flex flex-column justify-content-center col-lg-12">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $title?></h1>
                        </div>
                        <form action="./controller/create.php" method="POST" class="user" enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center">
                                <div class="image-container mb-3">
                                    <img src="./../inspector/images/default.png" alt="default-inspector-image"
                                        class="img-fluid rounded-circle" />
                                </div>
                            </div>

                            <div class="col col-12 p-1 form-group d-flex flex-column">
                                <label for="inspector-name">Inspector Name <span class="text-danger">*</span>
                                </label>
                                <div class="d-flex align-items-center justify-content-center select-container">
                                    <select name="inspector_name" id="inspector-name"
                                        class="form-control form-select px-3" required>

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

                                        <option selected disabled hidden value="">Select</option>
                                        <option value="<?php echo $inspector['inspector_id']?>">
                                            <?php echo $fullname?>
                                        </option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for="username">Username <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="username" class="form-control p-4" id="username"
                                    aria-describedby="username" placeholder="Enter Username..." required>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for="password1">Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password1" class="form-control p-4" id="password1"
                                    aria-describedby="password1" placeholder="Enter Password..." required>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for="password2">Confirm Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password2" class="form-control p-4" id="password2"
                                    aria-describedby="password2" placeholder="Confirm Password..." required>
                            </div>

                            <div class="col col-12 p-1 form-group d-flex flex-column">
                                <label for="role">Role <span class="text-danger">*</span>
                                </label>
                                <div class="d-flex align-items-center justify-content-center select-container">
                                    <select name="role" id="role" class="form-control form-select px-3" required>
                                        <option selected disabled hidden value="">Select</option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Inspector Admin">Inspector Admin</option>
                                        <option value="Inspector">Inspector</option>
                                    </select>
                                </div>
                            </div>

                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block mt-3"
                                value="Add">

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