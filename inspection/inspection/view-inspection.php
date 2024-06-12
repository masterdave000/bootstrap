<?php

$title = "Equipment Inspection Details";
include './../includes/side-header.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['inspection_id'])) {
    $clean_id = filter_var($_GET['inspection_id'], FILTER_SANITIZE_NUMBER_INT);
    $inspection_id = filter_var($clean_id, FILTER_VALIDATE_INT);

    $inspectionQuery = "SELECT 
        inspection_id, 
        bus_id, 
        owner_firstname, 
        owner_midname, 
        owner_lastname, 
        owner_suffix, 
        bus_name, 
        bus_type, 
        bus_address, 
        bus_contact_number, 
        floor_area, 
        signage_area, 
        bldg_section,
        bldg_property_attribute,
        bldg_fee, 
        sanitary_fee, 
        sanitary_quantity,
        display_type,
        sign_type,
        signage_fee, 
        application_type, 
        remarks,
        GROUP_CONCAT(DISTINCT item_name) AS item_names, 
        GROUP_CONCAT(category_name) AS category_names, 
        GROUP_CONCAT(section) AS sections, 
        GROUP_CONCAT(capacity) AS capacities, 
        GROUP_CONCAT(power_rating) AS power_ratings, 
        GROUP_CONCAT(quantity) AS quantities, 
        GROUP_CONCAT(fee) AS fees, 
        GROUP_CONCAT(DISTINCT inspector_id) AS inspector_ids, 
        GROUP_CONCAT(
        DISTINCT 
            CONCAT(
                inspector_firstname, 
                IFNULL(CONCAT(' ', LEFT(inspector_midname, 1), '.'), ''), 
                ' ', 
                inspector_lastname, 
                ' ', 
                inspector_suffix
            )
        ) AS inspector_fullnames,
        GROUP_CONCAT(DISTINCT description) AS descriptions, 
        bus_img_url, 
        date_inspected
        FROM inspection_view 
        WHERE inspection_id = :inspection_id 
        GROUP BY inspection_id";

    $inspectionStatement = $pdo->prepare($inspectionQuery);
    $inspectionStatement->bindParam(':inspection_id', $inspection_id);
    $inspectionStatement->execute();

    $inspectionData = $inspectionStatement->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

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

                        <?php foreach ($inspectionData as $data) :


                            $owner_firstname = htmlspecialchars(ucwords($data['owner_firstname']));
                            $owner_midname = htmlspecialchars(ucwords($data['owner_midname'] ? mb_substr($data['owner_midname'], 0, 1, 'UTF-8') . "." : ""));
                            $owner_lastname = htmlspecialchars(ucwords($data['owner_lastname']));
                            $owner_suffix = htmlspecialchars(ucwords($data['owner_suffix']));

                            $owner_fullname = trim($owner_firstname . ' ' . $owner_midname . ' ' . $owner_lastname . ' ' . $owner_suffix);

                            $item_names = explode(',', $data['item_names']);
                            $category_names = explode(',', $data['category_names']);

                            $sections = explode(',', $data['sections']);
                            $capacities = explode(',', $data['capacities']);
                            $power_ratings = explode(',', $data['power_ratings']);
                            $quantities = explode(',', $data['quantities']);
                            $fees = explode(',', $data['fees']);

                            $inspector_ids = explode(',', $data['inspector_ids']);
                            $inspector_fullnames = explode(' ,', $data['inspector_fullnames']);

                            $descriptions = explode(',', $data['descriptions']);

                        ?>
                            <form action="./generate/regenerate-equipment-inspection.php" method="POST" class="user" id="inspection-form" enctype="multipart/form-data">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="image-container mb-3">
                                        <img src="./../business/images/<?= $data['bus_img_url'] ?>" alt="default-item-image" class="img-fluid rounded-circle" id="bus-img" />
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary btn-md-block mr-3 px-3">Re-Issue
                                    </button>
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

                                            <div class="col col-12 p-0 form-group">
                                                <label>Application Type</label>
                                                <input type="text" name="application_type" class="form-control p-4" value="<?= $data['application_type'] ?>" readonly>
                                            </div>


                                            <div class="col col-12 p-0 form-group">
                                                <label>Business Name</label>
                                                <input type="text" name="bus_name" class="form-control p-4" value="<?= $data['bus_name'] ?>" readonly>
                                            </div>

                                            <div class="col col-12 p-0 form-group">
                                                <label>Owner Name</label>
                                                <input type="text" name="owner_name" class="form-control p-4" value="<?= $owner_fullname ?>" readonly>
                                            </div>


                                            <div class="col col-12 p-0 form-group">
                                                <label>Business Address</label>
                                                <input type="text" name="bus_address" class="form-control p-4" value="<?= $data['bus_address'] ?>" readonly>
                                            </div>


                                            <div class="col col-12 p-0 form-group">
                                                <label>Business Type</label>
                                                <input type="text" name="bus_type" class="form-control p-4" value="<?= $data['bus_type'] ?>" readonly>
                                            </div>


                                            <div class="col col-12 p-0 form-group">
                                                <label>Business Contact No.</label>
                                                <input type="text" name="bus_contact_number" class="form-control p-4" value="<?= $data['bus_contact_number'] ?>" readonly>
                                            </div>

                                            <div class="d-md-flex align-items-center justify-content-center">
                                                <div class="col col-md-6 p-0 form-group flex-md-grow-1">
                                                    <label>Floor Area</label>
                                                    <input type="text" name="floor_area" class="form-control p-4" value="<?= $data['floor_area'] ?>" readonly>
                                                </div>

                                                <div class="col col-md-6 p-0 form-group flex-md-grow-1">
                                                    <label for="signage-area">Signage Area</label>
                                                    <input type="text" name="signage_area" class="form-control p-4" value="<?= $data['signage_area'] ?>" readonly>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="carousel-item p-2" data-bs-interval="false">
                                            <div class="d-flex flex-column" id="item-container">
                                                <div class="d-flex justify-content-between">
                                                    <p class="text font-weight-bolder">Item Information</p>
                                                    <p class="text font-weight-bolder">Total
                                                        Item: <span id="total-item"><?= count($item_names); ?></span>
                                                    </p>
                                                </div>


                                                <?php foreach ($item_names as $index => $item) : ?>

                                                    <div class="shadow bg-white rounded p-3 mb-2" id="item-content-1">
                                                        <a id="item-title-1" class="text text-decoration-none" style="cursor: pointer; font-weight: 700;">Item <?= $index + 1 ?>
                                                        </a>
                                                        <div class="col col-12 p-0 form-group mb-1">
                                                            <label>Item Name</label>
                                                            <input type="text" name="item_name[]" class="form-control p-4" value="<?= $item_names[$index] ?>" readonly>
                                                        </div>

                                                        <div class="col col-12 p-0 form-group mb-1">
                                                            <label>Category</label>
                                                            <input type="text" name="category_name[]" class="form-control p-4" value="<?= $category_names[$index] ?>" readonly>
                                                        </div>

                                                        <div class="col col-12 p-0 form-group mb-1">
                                                            <label>Section</label>
                                                            <input type="text" name="section[]" class="form-control p-4" value="<?= $sections[$index] ?>" readonly>
                                                        </div>

                                                        <?php if ($category_names[$index] !== 'Electronics') : ?>

                                                            <div class="col col-12 p-0 form-group mb-1">
                                                                <label>Capacity</label>
                                                                <input type="text" name="capacity[]" class="form-control p-4" value="<?= $capacities[$index] ?>" readonly>
                                                            </div>
                                                        <?php endif; ?>

                                                        <div class="d-md-flex align-items-center justify-content-center p-0">
                                                            <div class="col col-md-6 p-0 form-group mb-1 flex-md-grow-1">
                                                                <label>Quantity</label>
                                                                <input type="number" name="quantity[]" class="form-control p-4" value="<?= $quantities[$index] ?>" readonly>
                                                            </div>

                                                            <div class="col col-md-6 p-0 form-group mb-1 flex-md-grow-1">
                                                                <label>Power Rating</label>
                                                                <input type="number" name="power_rating[]" class="form-control p-4" value="<?= $power_ratings[$index] ?>" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col col-12 p-0 form-group mb-1">
                                                            <label>Fee</label>
                                                            <input type="number" name="fee[]" class="form-control p-4" value="<?= $fees[$index] ?>" readonly>
                                                        </div>
                                                    </div>

                                                <?php endforeach ?>
                                            </div>

                                        </div>

                                        <div class="carousel-item p-2" data-bs-interval="false">

                                            <p class="text font-weight-bolder">Building Information</p>

                                            <div class="col col-12 p-0 form-group mb-1">
                                                <label>Section</label>
                                                <input type="text" name="bldg_section" class="form-control p-4" value="<?= $data['bldg_section'] ?>" readonly>
                                            </div>

                                            <div class="col col-12 p-0 form-group mb-1">
                                                <label>Property Attribute</label>
                                                <input type="text" class="form-control p-4" value="<?= $data['bldg_property_attribute'] ?>" readonly>
                                            </div>


                                            <div class="col col-12 p-0 form-group" id="bldg-fee-container">
                                                <label for="bldg-fee">Fee
                                                </label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>

                                                    <input type="number" name="bldg_fee" class="form-control p-4" value="<?= $data['bldg_fee'] ?>" readonly>
                                                </div>
                                            </div>

                                            <p class="text font-weight-bolder">Sanitary/Plumbing Information</p>

                                            <div class="d-md-flex align-items-center justify-content-center">
                                                <div class="col col-md-6 p-0 form-group flex-md-grow-1">
                                                    <label for="sanitary-fee">Fee
                                                    </label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>

                                                        <input type="number" name="sanitary_fee" class="form-control p-4" value="<?= $data['sanitary_fee'] ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="col col-md-6 p-0 form-group flex-md-grow-1">
                                                    <label for="sanitary-quantity">Quantity
                                                    </label>
                                                    <input type="number" name="sanitary_quantity" class="form-control p-4" value="<?= $data['sanitary_quantity'] ?>" readonly>
                                                </div>
                                            </div>

                                            <p class="text font-weight-bolder">Signage Information</p>

                                            <div class="col col-12 p-0 form-group mb-1">
                                                <label>Display Type</label>
                                                <input type="text" class="form-control p-4" value="<?= $data['display_type'] ?>" readonly>
                                            </div>

                                            <div class="col col-12 p-0 form-group mb-1">
                                                <label>Sign Type</label>
                                                <input type="text" class="form-control p-4" value="<?= $data['sign_type'] ?>" readonly>
                                            </div>

                                            <div class="col col-12 p-0 form-group">
                                                <label>Fee</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>

                                                    <input type="number" name="signage_fee" class="form-control p-4" value="<?= $data['signage_fee'] ?>" readonly>
                                                </div>
                                            </div>

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
                                                <?php endforeach ?>
                                            </div>

                                        </div>

                                        <div class="carousel-item p-2" data-bs-interval="false">

                                            <div class=" col col-12 p-0 form-group mb-1">
                                                <label>Remarks</label>
                                                <input type="text" name="remarks" class="form-control p-4" value="<?= $data['remarks'] ?>" readonly>
                                            </div>

                                            <?php if ($data['remarks'] !== 'No Violation'):?>
                                            <div class="d-flex flex-column" id="violation-container">
                                                <div class="d-flex justify-content-between">
                                                    <p class="text font-weight-bolder">Violation Information</p>
                                                    <p class="text font-weight-bolder">Total
                                                        Violation: <span id="total-violation">
                                                            <?= count($descriptions) ?></span>
                                                    </p>
                                                </div>

                                                <?php

                                                foreach ($descriptions as $index => $description) :



                                                ?>
                                                    <div class="shadow bg-white rounded p-3 mb-2" id="violation-content-1"><a id="violation-title-1" class="text text-decoration-none" style="cursor: pointer; font-weight: 700;">Violation
                                                            <?= $index + 1 ?></a>

                                                        <div class="col col-12 p-0 form-group mb-1">
                                                            <label>Description</label>
                                                            <input type="text" name="description" class="form-control p-4" value="<?= $descriptions[$index] ?>" readonly>
                                                        </div>

                                                    </div>

                                                <?php endforeach ?>
                                            </div>
                                            
                                            <?php endif?>
                                        </div>
                                    </div>

                                    <div class=" d-flex justify-content-between mt-4">
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
                            </form>

                        <?php endforeach ?>
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
require './modals/violation.php';
?>

</body>

</html>