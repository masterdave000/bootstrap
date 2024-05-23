<?php

$title = "Add Inspection";
include './../includes/side-header.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_id = filter_var($_GET['schedule_id'], FILTER_SANITIZE_NUMBER_INT);
    $schedule_id = filter_var($clean_id, FILTER_VALIDATE_INT);

    $scheduleQuery = "SELECT bus_id, owner_id, bus_name, bus_address, bus_type, 
                            bus_contact_number, floor_area, signage_area,
                            owner_firstname, owner_midname, owner_lastname, owner_suffix,
                            inspector_id,
                            GROUP_CONCAT(inspector_id) AS inspector_ids,
                            GROUP_CONCAT(
                                 
                                    CONCAT(
                                        inspector_firstname, 
                                        IFNULL(CONCAT(' ', LEFT(inspector_midname, 1), '.'), ''), 
                                        ' ', 
                                        inspector_lastname, 
                                        ' ', 
                                        inspector_suffix
                                    )
                            ) AS inspector_fullnames,
                            schedule_date,
                            bus_img_url 
                            FROM business_inspection_schedule_view WHERE schedule_id = :schedule_id";
    $scheduleStatement = $pdo->prepare($scheduleQuery);
    $scheduleStatement->bindParam(':schedule_id', $schedule_id);
    $scheduleStatement->execute();

    $scheduleData = $scheduleStatement->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php

        if (isset($_SESSION['add'])) //Checking whether the session is set or not
        {    //DIsplaying session message
            echo $_SESSION['add'];
            //Removing session message
            unset($_SESSION['add']);
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

                        <?php
                        foreach ($scheduleData as $schedule) {

                            $inspector_ids = explode(',', $schedule['inspector_ids']);
                            $inspector_fullnames = explode(' ,', $schedule['inspector_fullnames']);

                            $owner_firstname = htmlspecialchars(ucwords($schedule['owner_firstname']));
                            $owner_midname = htmlspecialchars(ucwords($schedule['owner_midname'] ? mb_substr($schedule['owner_midname'], 0, 1, 'UTF-8') . "." : ""));
                            $owner_lastname = htmlspecialchars(ucwords($schedule['owner_lastname']));
                            $owner_suffix = htmlspecialchars(ucwords($schedule['owner_suffix']));

                            $owner_fullname = trim($owner_firstname . ' ' . $owner_midname . ' ' . $owner_lastname . ' ' . $owner_suffix);

                        ?>
                            <form action="./generate/equipment-inspection.php" method="POST" class="user" id="inspection-form" enctype="multipart/form-data">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="image-container mb-3">
                                        <img src="./images/default-img.png" alt="default-item-image" class="img-fluid rounded-circle" id="bus-img" />
                                    </div>
                                </div>

                                <div id="inspectionCarousel" class="carousel slide">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#inspectionCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#inspectionCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#inspectionCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        <button type="button" data-bs-target="#inspectionCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                        <button type="button" data-bs-target="#inspectionCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
                                    </div>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active p-2" data-bs-interval="false">

                                            <p class="text font-weight-bolder">Business Information</p>

                                            <div class="form-group d-flex flex-column flex-md-grow-1">
                                                <label for="application-type">Application Type <span class="text-danger">*</span>
                                                </label>
                                                <div class="d-flex align-items-center justify-content-center select-container">
                                                    <select name="application_type" id="application-type" class="form-control form-select px-3" required>
                                                        <option selected disabled hidden value="">Select</option>
                                                        <option value="Annual">Annual</option>
                                                        <option value="New">New</option>
                                                        <option value="Change Address">Change Address</option>
                                                        <option value="Change Name">Change Name</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col col-12 p-0 form-group">
                                                <label for="business-name">Business Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="bus_name" class="form-control p-4" id="bus-name" value="<?= $schedule['bus_name'] ?>" required readonly>
                                                <input type="hidden" id="business-id" name="business_id" value="<?= $schedule['bus_id'] ?>">
                                            </div>

                                            <div class="col col-12 p-0 form-group d-none">
                                                <label for="owner-name">Owner Name
                                                </label>
                                                <input type="text" name="owner_name" class="form-control p-4" id="owner-name" value="<?= $owner_fullname ?>" required readonly>
                                                <input type="hidden" id="owner-id" name="owner_id" value="<?= $schedule['owner_id'] ?>">
                                            </div>

                                            <div class="col col-12 p-0 form-group d-none">
                                                <label for="bus-address">Business Address
                                                </label>
                                                <input type="text" name="bus_address" class="form-control p-4" id="bus-address" value="<?= $schedule['bus_address'] ?>" required readonly>
                                            </div>

                                            <div class="col col-12 p-0 form-group d-none">
                                                <label for="bus-type">Business Type
                                                </label>
                                                <input type="text" name="bus_type" class="form-control p-4" id="bus-type" value="<?= $schedule['bus_type'] ?>" required readonly>
                                            </div>

                                            <div class="col col-12 p-0 form-group d-none">
                                                <label for="bus-contact-number">Business Contact Number
                                                </label>
                                                <input type="text" name="bus_contact_number" class="form-control p-4" id="bus-contact-number" value="<?= $schedule['bus_contact_number'] ?>" required readonly>
                                            </div>
                                            <div class="d-md-flex align-items-center justify-content-center">
                                                <div class="col col-md-6 p-0 form-group flex-md-grow-1 d-none">
                                                    <label for="floor-area">Floor Area
                                                    </label>
                                                    <input type="text" name="floor_area" class="form-control p-4" id="floor-area" value="<?= $schedule['floor_area'] ?>" required readonly>
                                                </div>

                                                <div class="col col-md-6 p-0 form-group flex-md-grow-1 d-none">
                                                    <label for="signage-area">Signage Area
                                                    </label>
                                                    <input type="text" name="signage_area" class="form-control p-4" id="signage-area" value="<?= $schedule['signage_area'] ?>" required readonly>
                                                </div>
                                            </div>

                                            <input type="hidden" id="">
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
                                                <a class="btn btn-primary btn-md-block px-3" data-bs-target="#item-list" data-bs-toggle="modal">Add Item</a>
                                                <a class="btn btn-danger btn-md-block px-3 d-none" id="delete-item">Delete
                                                    Item</a>
                                            </div>

                                        </div>

                                        <div class="carousel-item p-2" data-bs-interval="false">

                                            <p class="text font-weight-bolder">Building Information</p>

                                            <div class="form-group d-flex flex-column flex-md-grow-1">
                                                <label for="bldg-section">Section <span class="text-danger">*</span>
                                                </label>

                                                <div class="d-flex align-items-center justify-content-center select-container">
                                                    <select name="bldg_section" id="bldg-section" class="form-control form-select px-3" required>
                                                        <option selected disabled hidden value="">Select</option>
                                                        <?php
                                                        $buildingQuery = "SELECT DISTINCT bldg_section from building_billing";
                                                        $buildingStatement = $pdo->query($buildingQuery);
                                                        $buildings = $buildingStatement->fetchAll(PDO::FETCH_ASSOC);

                                                        foreach ($buildings as $building) :
                                                        ?>

                                                            <option value="<?php echo $building['bldg_section'] ?>">
                                                                <?php echo $building['bldg_section'] ?>
                                                            </option>

                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group d-none flex-column flex-md-grow-1" id="prop-attr-container">
                                                <label for="bldg-property-attribute">Property Attribute <span class="text-danger">*</span>
                                                </label>
                                                <div class="d-flex align-items-center justify-content-center select-container">
                                                    <select name="bldg_property_attribute" id="bldg-property-attribute" class="form-control form-select px-3" required>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col col-12 p-0 form-group d-none" id="bldg-fee-container">
                                                <label for="bldg-fee">Fee <span class="text-danger">*</span>
                                                </label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>

                                                    <input type="number" name="bldg_fee" class="form-control p-4" id="bldg-fee" placeholder="Enter Building Fee..." step="0.01" value="0.00" required readonly>
                                                </div>
                                            </div>

                                            <p class="text font-weight-bolder">Sanitary/Plumbing Information</p>

                                            <div class="d-md-flex align-items-center justify-content-center">
                                                <div class="col col-md-6 p-0 form-group flex-md-grow-1">
                                                    <label for="sanitary-fee">Fee <span class="text-danger">*</span>
                                                    </label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>

                                                        <?php
                                                        $sanitaryQuery = "SELECT * FROM sanitary_billing WHERE sanitary_section = :sanitary_section";
                                                        $sanitaryStatement = $pdo->prepare($sanitaryQuery);
                                                        $sanitaryStatement->bindValue(':sanitary_section', 'Plumbing');
                                                        $sanitaryStatement->execute();

                                                        $sanitaryBilling = $sanitaryStatement->fetch(PDO::FETCH_ASSOC);

                                                        ?>
                                                        <input type="number" name="sanitary_fee" class="form-control p-4" id="sanitary-fee" placeholder="Enter Sanitary Fee..." step="0.01" value="<?= $sanitaryBilling['sanitary_fee'] ?>" readonly>

                                                        <input type="hidden" name="sanitary_id" value="<?= $sanitaryBilling['sanitary_id'] ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col col-md-6 p-0 form-group flex-md-grow-1">
                                                    <label for="sanitary-quantity">Quantity <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" name="sanitary_quantity" class="form-control p-4" id="sanitary-quantity" placeholder="Enter Quantity..." value="1" required>
                                                </div>
                                            </div>

                                            <p class="text font-weight-bolder">Signage Information</p>

                                            <div class="form-group d-flex flex-column flex-md-grow-1">
                                                <label for="display-type">Display Type <span class="text-danger">*</span>
                                                </label>
                                                <div class="d-flex align-items-center justify-content-center select-container">
                                                    <select name="display_type" id="display-type" class="form-control form-select px-3" required>
                                                        <option selected disabled hidden value="">Select</option>
                                                        <?php
                                                        $signageQuery = "SELECT DISTINCT display_type from signage_billing";
                                                        $signageStatement = $pdo->query($signageQuery);
                                                        $signages = $signageStatement->fetchAll(PDO::FETCH_ASSOC);

                                                        foreach ($signages as $signage) :
                                                        ?>

                                                            <option value="<?php echo $signage['display_type'] ?>">
                                                                <?php echo $signage['display_type'] ?>
                                                            </option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group d-none flex-column flex-md-grow-1" id="sign-type-container">
                                                <label for="sign-type">Sign Type <span class="text-danger">*</span>
                                                </label>
                                                <div class="d-flex align-items-center justify-content-center select-container">
                                                    <select name="sign_type" id="sign-type" class="form-control form-select px-3" required>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col col-12 p-0 form-group d-none" id="signage-fee-container">
                                                <label for="signage-fee">Fee <span class="text-danger">*</span>
                                                </label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>

                                                    <input type="number" name="signage_fee" class="form-control p-4" id="signage-fee" placeholder="Enter Signage Fee..." step="0.01" required readonly>
                                                </div>
                                            </div>

                                            <input type="hidden" name="bldg_billing_id" id="bldg-billing-id">
                                            <input type="hidden" name="sanitary_id" id="sanitary-id" value="<?= $sanitaryBilling['sanitary_id'] ?>">
                                            <input type="hidden" name="signage_id" id="signage-id">
                                        </div>

                                        <div class="carousel-item p-2" data-bs-interval="false">
                                            <div class="d-flex flex-column" id="inspector-container">
                                                <div class="d-flex justify-content-between">
                                                    <p class="text font-weight-bolder">Inspector Information</p>
                                                    <p class="text font-weight-bolder">Total
                                                        Inspector: <span id="total-inspector"><?= count($inspector_ids) ?></span>
                                                    </p>
                                                </div>

                                                <?php
                                                foreach ($inspector_ids as $index => $inspector_id) :

                                                    $inspector_fullname = $inspector_fullnames[$index];

                                                ?>

                                                    <div class="shadow bg-white rounded p-3 mb-2" id="inspector-content-1">
                                                        <a id="inspector-title-1" class="text text-decoration-none" style="cursor: pointer; font-weight: 700;">Inspector
                                                            <?= $index + 1 ?></a>
                                                        <div class="col col-12 p-0 form-group mb-1">
                                                            <label>Inspector Name</label>

                                                            <input type="text" name="inspector_name[]" class="form-control p-4" value="<?= $inspector_fullname ?>" readonly>
                                                        </div>

                                                    </div>

                                                    <input type="hidden" name="inspector_id[]" value="<?= $inspector_ids[$index] ?>">
                                                <?php endforeach ?>
                                            </div>
                                        </div>

                                        <div class="carousel-item p-2" data-bs-interval="false">
                                            <div class="form-group d-flex flex-column flex-md-grow-1">
                                                <label for="remarks-id">Remarks <span class="text-danger">*</span>
                                                </label>
                                                <div class="d-flex align-items-center justify-content-center select-container">
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
                                                <a class="btn btn-primary btn-md-block px-3" data-bs-target="#violation-list" data-bs-toggle="modal">Add
                                                    violation</a>
                                                <a class="btn btn-danger btn-md-block px-3 d-none" id="delete-violation">Delete
                                                    Violation</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <div class="previous-container invisible">
                                            <button class="d-flex justify-content-center align-items-center border-0 bg-dark p-2 previous carousel-button" data-bs-target="#inspectionCarousel" role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                        <div class="next-container">
                                            <button class="d-flex justify-content-center align-items-center border-0 bg-dark p-2 next carousel-button" data-bs-target="#inspectionCarousel" role="button" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4 d-none formSubmit">
                                    <input type="submit" name="submit" class="btn btn-primary btn-user btn-block mt-3" value="Issue">
                                </div>
                            </form>

                        <?php }
                        ?>
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