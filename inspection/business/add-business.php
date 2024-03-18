<?php 

$title = "Add Business";
include './../includes/side-header.php';

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
                                    <img src="./images/no-image.png" alt="default-bus-image"
                                        class="img-fluid rounded-circle" />
                                </div>

                                <div class="form-group d-flex flex-column align-items-center w-100">
                                    <input type="file" name="bus_img" id="bus-img" class="border w-75"
                                        accept="image/JPEG, image/JPG, image/PNG" />

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
                                <div class="col col-md-6 p-1 form-group d-flex flex-column">
                                    <label for="owner-name">Owner Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="d-flex align-items-center justify-content-center select-container">
                                        <select name="owner_name" id="owner-name" class="form-control px-3" required>

                                            <?php 
                                                
                                                $ownerQuery = "SELECT owner.owner_id, owner_firstname, owner_midname, owner_lastname, owner_suffix 
                                                FROM owner LEFT JOIN business ON owner.owner_id = business.owner_id WHERE business.owner_id IS NULL";
                                                $ownerStatement = $pdo->query($ownerQuery);
                                                $owners = $ownerStatement->fetchAll(PDO::FETCH_ASSOC);
    
                                                foreach ($owners as $owner) {
                                                    $firstname = htmlspecialchars(ucwords($owner['owner_firstname']));
                                                    $midname = htmlspecialchars(ucwords($owner['owner_midname'] ? mb_substr($owner['owner_midname'], 0, 1, 'UTF-8') . "." : ""));
                                                    $lastname = htmlspecialchars(ucwords($owner['owner_lastname']));
                                                    $suffix = htmlspecialchars(ucwords($owner['owner_suffix']));
                                                    $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);
    
                                                ?>

                                            <option selected disabled hidden value="">Select</option>
                                            <option value="<?php echo $owner['owner_id']?>">
                                                <?php echo $fullname?>
                                            </option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="bus-name">Business Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="bus_name" class="form-control p-4" id="bus-name"
                                        aria-describedby="businessnameHelp" placeholder="Enter Business Name..."
                                        required>
                                </div>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for="bus-address">Address <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="bus_address" class="form-control p-4" id="bus-address"
                                    aria-describedby="businessaddressHelp" placeholder="Enter Business Address..."
                                    required>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-between">
                                <div class="form-group d-flex flex-column flex-md-grow-1">
                                    <label for="bus-type">Business Type <span class="text-danger">*</span>
                                    </label>
                                    <div class="d-flex align-items-center justify-content-center select-container">
                                        <select name="bus_type" id="bus-type" class="form-control px-3">
                                            <option disabled hidden selected value="">Select</option>
                                            <option value="Retail">Retail</option>
                                            <option value="Food and Beverage">RetailFood and Beverage</option>
                                            <option value="Services">Services</option>
                                            <option value="Healthcare">Healthcare</option>
                                            <option value="Construction and Real Estate">Construction and Real
                                                Estate
                                            </option>
                                            <option value="Manufacturing">Manufacturing</option>
                                            <option value="Financial Services">Financial Services</option>
                                            <option value="Transportation and Logistics">Transportation and
                                                Logistics
                                            </option>
                                            <option value="Education">Education</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group flex-md-grow-1 d-none">
                                    <label for="other-bus-type">Other <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="other_bus_type" id="other-bus-type"
                                        class="form-control p-4" aria-describedby="businesstypeHelp"
                                        placeholder="Enter Other Business Type...">
                                </div>
                            </div>


                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="contact-number">Contact Number <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="contact_number" class="form-control p-4"
                                        id="contact-number" aria-describedby="contactnoHelp"
                                        placeholder="Enter Contact Number..." maxlength="11" required>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="email">Email <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" name="email" class="form-control p-4" id="email"
                                        aria-describedby="contactnoHelp" placeholder="Enter Contact Number...">
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="floor-area">Floor Area <span class="text-danger">*</span> </label>
                                    <input type="number" name="floor_area" class="form-control p-4" id="floor-area"
                                        aria-describedby="floorareaHelp" placeholder="Enter Floor Area..." step="0.1">
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="signage-area">Signage Area <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="signage_area" class="form-control p-4" id="signage-area"
                                        aria-describedby="signageareaHelp" placeholder="Enter Signage Area..."
                                        step="0.1">
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