<?php 

$title = "Inspector Details";
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
    $clean_inspector_id = filter_var($_GET['inspector_id'], FILTER_SANITIZE_NUMBER_INT);
    $inspector_id = filter_var($clean_inspector_id, FILTER_VALIDATE_INT);

    $inspectorQuery = "SELECT * FROM inspector WHERE inspector_id = :inspector_id";
    $inspectorStatement = $pdo->prepare($inspectorQuery);
    $inspectorStatement->bindParam(':inspector_id', $inspector_id);
    $inspectorStatement->execute();

    $inspector = $inspectorStatement->fetch(PDO::FETCH_ASSOC);
    $firstname = htmlspecialchars(ucwords($inspector['inspector_firstname']));
    $midname = htmlspecialchars(ucwords($inspector['inspector_midname'] ? mb_substr($inspector['inspector_midname'], 0, 1, 'UTF-8') . "." : ""));
    $lastname = htmlspecialchars(ucwords($inspector['inspector_lastname']));
    $suffix = htmlspecialchars(ucwords($inspector['inspector_suffix']));
    $contact_number = htmlspecialchars($inspector['contact_number']);
    $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);

    $img_url = $inspector['inspector_img_url'];
}
?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">

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
                        <form class="user" enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center">
                                <div class="image-container mb-3">
                                    <img src="./images/<?php echo $img_url ?? 'default.png'?>"
                                        alt="default-inspector-image" class="img-fluid rounded-circle" />
                                </div>

                                <p class="h3 text-gray-900 mb-4 "><?php echo $fullname?></p>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="inspector-firstname">First Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control p-4" value="<?php echo $firstname?>"
                                        disabled>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="inspector-midname">Middle Name </label>
                                    <input type="text" class="form-control p-4"
                                        value="<?php echo $inspector['inspector_midname']?>" disabled>
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="inspector-lasttname">Last Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control p-4" value="<?php echo $lastname?>" disabled>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="inspector-suffix">Suffix </label>
                                    <input type="text" class="form-control p-4" value="<?php echo $suffix?>" disabled>
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="contact-number">Contact Number <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control p-4"
                                        value="<?php echo $inspector['contact_number']?>" disabled>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="email">Email <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control p-4"
                                        value="<?php echo $inspector['email']?>" disabled>
                                </div>
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