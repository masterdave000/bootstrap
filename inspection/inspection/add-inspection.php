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
                            id="inspection-form" enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center">
                                <div class="image-container mb-3">
                                    <img src="./images/default-img.png" alt="default-item-image"
                                        class="img-fluid rounded-circle" id="bus-img" />
                                </div>
                            </div>

                            <div id="inspectionCarousel" class="carousel slide">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#inspectionCarousel" data-bs-slide-to="0"
                                        class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#inspectionCarousel" data-bs-slide-to="1"
                                        aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#inspectionCarousel" data-bs-slide-to="2"
                                        aria-label="Slide 3"></button>
                                    <button type="button" data-bs-target="#inspectionCarousel" data-bs-slide-to="3"
                                        aria-label="Slide 4"></button>
                                    <button type="button" data-bs-target="#inspectionCarousel" data-bs-slide-to="4"
                                        aria-label="Slide 5"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active p-2" data-bs-interval="false">

                                        <p class="text font-weight-bolder">Business Information</p>

                                        <div class="form-group d-flex flex-column flex-md-grow-1">
                                            <label for="application-type">Application Type <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div
                                                class="d-flex align-items-center justify-content-center select-container">
                                                <select name="application_type" id="application-type"
                                                    class="form-control form-select px-3" required>
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
                                                <select name="business_id" id="business-id"
                                                    class="form-control form-select px-3" required>
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

                                    <div class="carousel-item p-2" data-bs-interval="false">
                                        <div class="d-flex flex-column" id="item-container">
                                            <div class="d-flex justify-content-between">
                                                <p class="text font-weight-bolder">Item Information</p>
                                                <p class="text font-weight-bolder">Total
                                                    Item: <span id="total-item">0</span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-end my-4">
                                            <a class="btn btn-primary btn-md-block px-3" data-bs-target="#item-list"
                                                data-bs-toggle="modal">Add Item</a>
                                            <a class="btn btn-danger btn-md-block px-3 d-none" id="delete-item">Delete
                                                Item</a>
                                        </div>

                                    </div>

                                    <div class="carousel-item p-2" data-bs-interval="false">

                                        <p class="text font-weight-bolder">Other Fees Information</p>

                                        <div class="col col-12 p-0 form-group">
                                            <label for="building-fee">Building Fee <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>

                                                <input type="number" name="building_fee" class="form-control p-4"
                                                    id="building-fee" placeholder="Enter Building Fee..." step="0.01"
                                                    value="0.00" min="0.00" required>
                                            </div>

                                        </div>

                                        <div class="col col-12 p-0 form-group">
                                            <label for="sanitary-fee">Sanitary Fee <span class="text-danger">*</span>
                                            </label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>

                                                <input type="number" name="sanitary_fee" class="form-control p-4"
                                                    id="sanitary-fee" placeholder="Enter Sanitary Fee..." step="0.01"
                                                    value="0.00" required>
                                            </div>

                                        </div>

                                        <div class="col col-12 p-0 form-group">
                                            <label for="signage-fee">Signage Fee <span class="text-danger">*</span>
                                            </label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>

                                                <input type="number" name="signage_fee" class="form-control p-4"
                                                    id="signage-fee" placeholder="Enter Signage Fee..." step="0.01"
                                                    value="0.00" required>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="carousel-item p-2" data-bs-interval="false">
                                        <div class="d-flex flex-column" id="inspector-container">
                                            <div class="d-flex justify-content-between">
                                                <p class="text font-weight-bolder">Inspector Information</p>
                                                <p class="text font-weight-bolder">Total
                                                    Inspector: <span id="total-inspector">0</span>
                                                </p>
                                            </div>

                                        </div>
                                        <div class="d-flex justify-content-end my-4">
                                            <a class="btn btn-primary btn-md-block px-3"
                                                data-bs-target="#inspector-list" data-bs-toggle="modal">Add
                                                Inspector</a>
                                            <a class="btn btn-danger btn-md-block px-3 d-none"
                                                id="delete-inspector">Delete
                                                Inspector</a>
                                        </div>
                                    </div>

                                    <div class="carousel-item p-2" data-bs-interval="false">
                                        <div class="form-group d-flex flex-column flex-md-grow-1">
                                            <label for="remarks-id">Remarks <span class="text-danger">*</span>
                                            </label>
                                            <div
                                                class="d-flex align-items-center justify-content-center select-container">
                                                <select name="remarks" id="remarks" class="form-control px-3" required>
                                                    <option selected disabled hidden value="">Select</option>
                                                    <option value="No Violation">No Violation</option>
                                                    <option value="With Violation">With Violation</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column" id="violation-container">
                                            <div class="d-flex justify-content-between">
                                                <p class="text font-weight-bolder">Violation Information</p>
                                                <p class="text font-weight-bolder">Total
                                                    Violation: <span id="total-violation">0</span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end my-4">
                                            <a class="btn btn-primary btn-md-block px-3"
                                                data-bs-target="#violation-list" data-bs-toggle="modal">Add
                                                violation</a>
                                            <a class="btn btn-danger btn-md-block px-3 d-none"
                                                id="delete-violation">Delete
                                                Violation</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <div class="previous-container invisible">
                                        <button
                                            class="d-flex justify-content-center align-items-center border-0 bg-dark p-2 previous carousel-button"
                                            data-bs-target="#inspectionCarousel" role="button" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                    <div class="next-container">
                                        <button
                                            class="d-flex justify-content-center align-items-center border-0 bg-dark p-2 next carousel-button"
                                            data-bs-target="#inspectionCarousel" role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4 d-none formSubmit">
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
require './modals/violation.php';
?>

</body>

</html>