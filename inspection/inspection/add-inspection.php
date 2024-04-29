<?php 

$title = "Add Inspection";
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
                        <form action="./generate/equipment-inspection.php" method="POST" class="user"
                            enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center">
                                <div class="image-container mb-3">
                                    <img src="./images/default-img.png" alt="default-item-image"
                                        class="img-fluid rounded-circle" id="bus-img" />
                                </div>

                                <div class="form-group d-flex flex-column align-items-center w-100">
                                    <input type="file" name="item_img" id="item-img" class="border w-75"
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

                            <div id="inspectionCarousel" class="carousel slide" data-ride="carousel"
                                data-interval="false">
                                <div>
                                    <ol class="carousel-indicators">
                                        <li data-target="#inspectionCarousel" data-slide-to="0" class="active">
                                        </li>
                                        <li data-target="#inspectionCarousel" data-slide-to="1"></li>
                                        <li data-target="#inspectionCarousel" data-slide-to="2"></li>
                                        <li data-target="#inspectionCarousel" data-slide-to="4"></li>
                                        <li data-target="#inspectionCarousel" data-slide-to="5"></li>
                                    </ol>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active p-2">

                                        <p class="text font-weight-bolder">Business Information</p>

                                        <div class="form-group d-flex flex-column flex-md-grow-1">
                                            <label for="application-type">Application Type <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div
                                                class="d-flex align-items-center justify-content-center select-container">
                                                <select name="application_type" id="application-type"
                                                    class="form-control px-3" required>
                                                    <option selected disabled hidden value="">Select</option>
                                                    <option value="Annual">Annual</option>
                                                    <option value="New">New</option>
                                                    <option value="Change Address">Change Address</option>
                                                    <option value="Change Name">Change Name</option>


                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group d-flex flex-column flex-md-grow-1">
                                            <label for="business-id">Business Name <span class="text-danger">*</span>
                                            </label>
                                            <div
                                                class="d-flex align-items-center justify-content-center select-container">
                                                <select name="business_id" id="business-id" class="form-control px-3"
                                                    required>
                                                    <option selected disabled hidden value="">Select</option>
                                                    <?php 
                                            $businessQuery = "SELECT * from business";
                                            $businessStatement = $pdo->query($businessQuery);
                                            $businesses = $businessStatement->fetchAll(PDO::FETCH_ASSOC);
                                            
                                            foreach ($businesses as $business) {
                                                ?>

                                                    <option value="<?php echo $business['bus_id']?>">
                                                        <?php echo $business['bus_name']?>
                                                    </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <input type="hidden" name="bus_name" class="form-control p-4" id="bus-name"
                                            required readonly>

                                        <div class="col col-12 p-0 form-group d-none">
                                            <label for="owner-name">Owner Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="owner_name" class="form-control p-4"
                                                id="owner-name" placeholder="Enter Owner Name..." required readonly>
                                            <input type="hidden" id="owner-id" name="owner_id">
                                        </div>

                                        <div class="col col-12 p-0 form-group d-none">
                                            <label for="bus-address">Business Address<span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="bus_address" class="form-control p-4"
                                                id="bus-address" placeholder="Enter Business Address..." required
                                                readonly>
                                        </div>

                                        <div class="col col-12 p-0 form-group d-none">
                                            <label for="bus-type">Business Type <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="bus_type" class="form-control p-4" id="bus-type"
                                                placeholder="Enter Business Type..." required readonly>
                                        </div>

                                        <div class="col col-12 p-0 form-group d-none">
                                            <label for="bus-contact-number">Business Contact Number <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="bus_contact_number" class="form-control p-4"
                                                id="bus-contact-number" placeholder="Enter Business Contact Number..."
                                                required readonly>
                                        </div>
                                        <div class="d-md-flex align-items-center justify-content-center">
                                            <div class="col col-md-6 p-0 form-group flex-md-grow-1 d-none">
                                                <label for="floor-area">Floor Area <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="floor_area" class="form-control p-4"
                                                    id="floor-area" placeholder="Enter Floor Area..." required readonly>
                                            </div>

                                            <div class="col col-md-6 p-0 form-group flex-md-grow-1 d-none">
                                                <label for="signage-area">Signage Area <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="signage_area" class="form-control p-4"
                                                    id="signage-area" placeholder="Enter Signage Area..." readonly>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="carousel-item p-3">

                                        <div class="d-flex flex-column" id="item-container">
                                            <div class="d-flex justify-content-between">
                                                <p class="text font-weight-bolder">Item Information</p>
                                                <p class="text font-weight-bolder">Total
                                                    Item: <span id="total-item">0</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-end my-4">
                                            <a class="btn btn-success btn-md-block mr-3 px-3" data-target="#item-list"
                                                data-toggle="modal">Add Item</a>
                                            <a class="btn btn-danger btn-md-block px-3" id="delete-item">Delete Item</a>
                                        </div>

                                    </div>

                                    <div class="carousel-item p-2">

                                        <p class="text font-weight-bolder">Other Fees Information</p>

                                        <div class="col col-12 p-0 form-group">
                                            <label for="building-fee">Building Fee <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" name="building_fee" class="form-control p-4"
                                                id="building-fee" placeholder="Enter Building Fee..." step="0.01"
                                                value="0.00" min="0.00" required>
                                        </div>

                                        <div class="col col-12 p-0 form-group">
                                            <label for="sanitary-fee">Sanitary Fee <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" name="sanitary_fee" class="form-control p-4"
                                                id="sanitary-fee" placeholder="Enter Sanitary Fee..." step="0.01"
                                                value="0.00" required>
                                        </div>

                                        <div class="col col-12 p-0 form-group">
                                            <label for="signage-fee">Signage Fee <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" name="signage_fee" class="form-control p-4"
                                                id="signage-fee" placeholder="Enter Signage Fee..." step="0.01"
                                                value="0.00" required>
                                        </div>

                                    </div>
                                    <div class="carousel-item p-2">
                                        <p class="text font-weight-bolder">Inspector Information</p>

                                        <div class="d-flex justify-content-end my-4">
                                            <a class="btn btn-success btn-md-block mr-3 px-3"
                                                data-target="#inspector-list" data-toggle="modal">Add Inspector</a>
                                            <a class="btn btn-danger btn-md-block px-3" id="delete-inspector">Delete
                                                Inspector</a>
                                        </div>
                                    </div>

                                    <div class="carousel-item p-2">
                                        <p class="text font-weight-bolder">Violation Information</p>

                                        <div class="form-group d-flex flex-column flex-md-grow-1">
                                            <label for="violation-id">Violation Description <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div
                                                class="d-flex align-items-center justify-content-center select-container">
                                                <select name="violation_id" id="violation-id" class="form-control px-3"
                                                    required>
                                                    <option selected disabled hidden value="">Select</option>
                                                    <?php 
                                                    
                                                    $violationQuery = "SELECT * from violation";
                                                    $violationStatement = $pdo->query($violationQuery);
                                                    $violations = $violationStatement->fetchAll(PDO::FETCH_ASSOC);
                                                    
                                                    foreach ($violations as $violation) {
                                                        ?>

                                                    <option value="<?php echo $violation['violation_id']?>">
                                                        <?php echo $violation['violation_description']?>
                                                    </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group d-flex flex-column flex-md-grow-1">
                                            <label for="remarks-id">Remarks <span class="text-danger">*</span>
                                            </label>
                                            <div
                                                class="d-flex align-items-center justify-content-center select-container">
                                                <select name="remarks_id" id="remarks-id" class="form-control px-3"
                                                    required>
                                                    <option selected disabled hidden value="">Select</option>
                                                    <option value="No Violation">No Violation</option>
                                                    <option value="With Violation">With Violation</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button
                                        class="d-flex justify-content-center align-items-center border-0 bg-dark p-2 previous carousel-button"
                                        href="#inspectionCarousel" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </button>
                                    <button type="submit"
                                        class="d-flex justify-content-center align-items-center border-0 bg-dark p-2 next carousel-button"
                                        href="#inspectionCarousel" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </button>
                                </div>

                            </div>

                            <div class="text-center mt-4">
                                <input type="submit" name="submit" class="btn btn-primary btn-user btn-block mt-3"
                                    value="Add">
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


<?php 

require './../includes/footer.php'; 
require './modals/item.php';
require './modals/inspector.php';
?>
</body>

</html>