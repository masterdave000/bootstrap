<?php 

$title = "Owner Details";
include './../includes/side-header.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $clean_owner_id = filter_var($_GET['owner_id'], FILTER_SANITIZE_NUMBER_INT);
    $owner_id = filter_var($clean_owner_id, FILTER_VALIDATE_INT);
}
    $getOwnerQuery = "SELECT * FROM owner WHERE owner_id = :owner_id";
    $getOwnerStatement = $pdo->prepare($getOwnerQuery);
    $getOwnerStatement->bindParam(':owner_id', $owner_id);
    $getOwnerStatement->execute();

    $owner = $getOwnerStatement->fetch(PDO::FETCH_ASSOC);
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
                        <form class="user">
                            <div class="d-flex flex-column align-items-center">
                                <div class="image-container mb-3">
                                    <img src="./images/<?php echo $owner['owner_img_url']?>" alt="default-owner-image"
                                        class="img-fluid rounded-circle" />
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="owner-firstname">First Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="owner_firstname" id="owner-firstname"
                                        class="form-control p-4" id="exampleInputOwnerName"
                                        aria-describedby="ownerNameHelp" placeholder="Enter First Name..."
                                        value="<?php echo $owner['owner_firstname']?>" disabled>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="owner-midname">Middle Name </label>
                                    <input type="text" name="owner_midname" id="owner-midname" class="form-control p-4"
                                        id="exampleInputOwnerName" aria-describedby="ownerNameHelp"
                                        placeholder="Enter Middle Name..." value="<?php echo $owner['owner_midname']?>"
                                        disabled>
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="owner-lasttname">Last Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="owner_lastname" id="owner-lasttname"
                                        class="form-control p-4" id="exampleInputOwnerName"
                                        aria-describedby="ownerNameHelp" placeholder="Enter Last Name..."
                                        value="<?php echo $owner['owner_lastname']?>" disabled>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="owner-suffix">Suffix </label>
                                    <input type="text" name="owner_suffix" id="owner-suffix" class="form-control p-4"
                                        id="exampleInputOwnerName" aria-describedby="ownerNameHelp"
                                        placeholder="Enter Suffix Name..." value="<?php echo $owner['owner_suffix']?>"
                                        disabled>
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="contact-number">Contact Number <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="contact_number" class="form-control p-4"
                                        id="contact-number" aria-describedby="contactnoHelp"
                                        placeholder="Enter Contact Number..." maxlength="11"
                                        value="<?php echo $owner['contact_number']?>" disabled>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="email">Email <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" name="email" class="form-control p-4" id="email"
                                        aria-describedby="contactnoHelp" placeholder="Enter Contact Number..."
                                        value="<?php echo $owner['email']?>" disabled>
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