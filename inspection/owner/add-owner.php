<?php

$title = "Add Owner";
include './../includes/side-header.php';

?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">

        <?php

        if (isset($_SESSION['add'])) //Checking whether the session is set or not
        {    //DIsplaying session message
            echo $_SESSION['add'];
            //Removing session message
            unset($_SESSION['add']);
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
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $title ?></h1>
                        </div>
                        <form action="./controller/create.php" method="POST" class="user" enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center">
                                <div class="image-container mb-3">
                                    <img src="./images/default.png" alt="default-owner-image" class="img-fluid rounded-circle" />
                                </div>

                                <div class="form-group d-flex flex-column align-items-center w-100">
                                    <input type="file" name="owner_img_url" id="owner-img-url" class="border w-75" accept="image/JPEG, image/JPG, image/PNG" />

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
                                    <label for="owner-firstname">First Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="owner_firstname" id="owner-firstname" class="form-control p-4" id="exampleInputOwnerName" aria-describedby="ownerNameHelp" placeholder="Enter First Name..." required>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="owner-midname">Middle Name </label>
                                    <input type="text" name="owner_midname" id="owner-midname" class="form-control p-4" id="exampleInputOwnerName" aria-describedby="ownerNameHelp" placeholder="Enter Middle Name..." pattern="[a-zA-z -.ñÑ]+" oninvalid="this.setCustomValidity('Numbers and Special Characters are not allowed. Avoid inputting whitespaces.')" onchange="try{setCustomValidity('')}catch(e){}" oninput="setCustomValidity(' ')">
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="owner-lasttname">Last Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="owner_lastname" id="owner-lastname" class="form-control p-4" id="exampleInputOwnerName" aria-describedby="ownerNameHelp" placeholder="Enter Last Name..." required>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="owner-suffix">Suffix <small class="font-italic"> (i.e. Sr., Jr., II, III) </small></label>
                                    <input type="text" name="owner_suffix" id="owner-suffix" class="form-control p-4" id="exampleInputOwnerName" aria-describedby="ownerNameHelp" placeholder="Enter Suffix Name..." pattern="[a-zA-z .]+" oninvalid="this.setCustomValidity('Numbers and Special Characters are not allowed. Avoid inputting whitespaces.')" onchange="try{setCustomValidity('')}catch(e){}" oninput="setCustomValidity(' ')" maxlength="7">
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="contact-number">Contact Number <span class="text-danger">*</span> <small class="font-italic">(i.e. 09433637223)</small>
                                    </label>
                                    <input type="text" name="contact_number" class="form-control p-4" id="contact-number" aria-describedby="contactnoHelp" placeholder="Enter Contact Number..." maxlength="11" pattern="^(09)\d{9}$" oninvalid="this.setCustomValidity('Characters are not allowed. 11 digit numnber starting with 09')" onchange="try{setCustomValidity('')}catch(e){}" oninput="setCustomValidity(' ')" required>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="email">Email <span class="text-danger">*</span>
                                        <small class="font-italic">(i.e. sample@gmail.com)</small>
                                    </label>
                                    <input type="email" name="email" class="form-control p-4" id="email" aria-describedby="contactnoHelp" placeholder="Enter Email Address..." pattern="[A-Za-z0-9-._]+@[A-Za-z0-9.-_]+\.[a-zA-Z]{2,}" required>
                                </div>
                            </div>

                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block mt-3" value="Add">
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