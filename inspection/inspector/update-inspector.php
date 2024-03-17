<?php 

$title = "Edit Inspector";
include './../includes/side-header.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_inspector_id = filter_var($_GET['inspector_id'], FILTER_SANITIZE_NUMBER_INT);
    $inspector_id = filter_var($clean_inspector_id, FILTER_VALIDATE_INT);

    $inspectorQuery = "SELECT * FROM inspector WHERE inspector_id = :inspector_id";
    $inspectorStatement = $pdo->prepare($inspectorQuery);
    $inspectorStatement->bindParam(':inspector_id', $inspector_id);
    $inspectorStatement->execute();

    $inspector = $inspectorStatement->fetch(PDO::FETCH_ASSOC);
}
?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">

        <?php

            if (isset($_SESSION['update'])) //Checking whether the session is set or not
            {	//DIsplaying session message
                echo $_SESSION['update'];
                //Removing session message
                unset($_SESSION['update']);
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
                        <form action="./controller/update.php" method="POST" class="user" enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center">
                                <div class="image-container mb-3">
                                    <img src="./images/<?php echo $inspector['inspector_img_url'] ?? 'default.png'?>"
                                        alt="default-inspector-image" class="img-fluid rounded-circle" />
                                </div>

                                <div class="form-group d-flex flex-column align-items-center w-100">
                                    <input type="hidden" name="current_img_url" class="border w-75"
                                        accept="image/JPEG, image/JPG, image/PNG"
                                        value="<?php echo $inspector['inspector_img_url'] ?>" />

                                    <input type="file" name="inspector_img_url" id="inspector-img-url"
                                        class="border w-75" accept="image/JPEG, image/JPG, image/PNG" />

                                    <?php
                                    if (isset($_SESSION['error'])) {
                                        echo "<small class='text-danger text-center'>" . $_SESSION['error'] . "</small>";
                                        unset($_SESSION['error']); // clear the error message from the session
                                    }
                                    ?>

                                    <div class="text-danger text-center">
                                        <small>
                                            <i>Note: The maximum file size allowed is 1MB. <br>
                                                Only JPEG, JPG, and PNG formats are accepted.
                                            </i>
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="inspector-firstname">First Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="inspector_firstname" id="inspector-firstname"
                                        class="form-control p-4" id="exampleInputOwnerName"
                                        aria-describedby="inspectorNameHelp" placeholder="Enter First Name..."
                                        value="<?php echo $inspector['inspector_firstname']?>" required>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="inspector-midname">Middle Name </label>
                                    <input type="text" name="inspector_midname" id="inspector-midname"
                                        class="form-control p-4" id="exampleInputOwnerName"
                                        aria-describedby="inspectorNameHelp" placeholder="Enter Middle Name..."
                                        value="<?php echo $inspector['inspector_midname']?>">
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="inspector-lasttname">Last Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="inspector_lastname" id="inspector-lasttname"
                                        class="form-control p-4" id="exampleInputOwnerName"
                                        aria-describedby="inspectorNameHelp" placeholder="Enter Last Name..."
                                        value="<?php echo $inspector['inspector_lastname']?>" required>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="inspector-suffix">Suffix </label>
                                    <input type="text" name="inspector_suffix" id="inspector-suffix"
                                        class="form-control p-4" id="exampleInputOwnerName"
                                        aria-describedby="inspectorNameHelp" placeholder="Enter Suffix Name..."
                                        value="<?php echo $inspector['$inspector_suffix']?>">
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="contact-number">Contact Number <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="contact_number" class="form-control p-4"
                                        id="contact-number" aria-describedby="contactnoHelp"
                                        placeholder="Enter Contact Number..." maxlength="11"
                                        value="<?php echo $inspector['contact_number']?>" required>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="email">Email <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" name="email" class="form-control p-4" id="email"
                                        aria-describedby="contactnoHelp" placeholder="Enter Email Address..."
                                        value="<?php echo $inspector['email']?>" required>
                                </div>
                            </div>

                            <input type="hidden" name="inspector_id" value="<?php echo $inspector['inspector_id']?>">
                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block mt-3"
                                value="Edit">
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