<?php 

$title = "Equipment Inspection Details";
include './../includes/side-header.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['inspection_id'])) {
    $clean_id = filter_var($_GET['inspection_id'], FILTER_SANITIZE_NUMBER_INT);
    $inspection_id = filter_var($clean_id, FILTER_VALIDATE_INT);
    
    $inspectionQuery = "SELECT DISTINCT 
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
        building_fee, 
        sanitary_fee, 
        signage_fee, 
        application_type, 
        remarks,
        GROUP_CONCAT(DISTINCT item_name) AS item_names, 
        GROUP_CONCAT(DISTINCT category_name) AS category_names, 
        GROUP_CONCAT(DISTINCT section) AS sections, 
        GROUP_CONCAT(DISTINCT capacity) AS capacities, 
        GROUP_CONCAT(DISTINCT power_rating) AS power_ratings, 
        GROUP_CONCAT(DISTINCT quantity) AS quantities, 
        GROUP_CONCAT(DISTINCT fee) AS fees, 
        GROUP_CONCAT(DISTINCT inspector_firstname) AS inspector_firstnames, 
        GROUP_CONCAT(DISTINCT inspector_midname) AS inspector_midnames, 
        GROUP_CONCAT(DISTINCT inspector_lastname) AS inspector_lastnames, 
        GROUP_CONCAT(DISTINCT inspector_suffix) AS inspector_suffixes, 
        GROUP_CONCAT(DISTINCT description) AS descriptions, 
        bus_img_url, 
        date_inspected
        FROM inspection_view 
        WHERE inspection_id = :inspection_id 
        GROUP BY inspection_id;";
        
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
                            
                            $inspector_firstnames = explode(',', $data['inspector_firstnames']);
                            $inspector_midnames = explode(',', $data['inspector_midnames']);
                            $inspector_lastnames = explode(',', $data['inspector_lastnames']);
                            $inspector_suffixes = explode(',', $data['inspector_suffixes']); 
                            $descriptions = explode(',', $data['descriptions']); 

                        ?>
                        <form class="user" id="inspection-form" enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center">
                                <div class="image-container mb-3">
                                    <img src="./../business/images/<?= $data['bus_img_url']?>" alt="default-item-image"
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

                                        <div class="col col-12 p-0 form-group">
                                            <label>Application Type</label>
                                            <input type="text" class="form-control p-4"
                                                value="<?= $data['application_type']?>" readonly>
                                        </div>


                                        <div class="col col-12 p-0 form-group">
                                            <label>Business Name</label>
                                            <input type="text" class="form-control p-4" value="<?= $data['bus_name']?>"
                                                readonly>
                                        </div>

                                        <div class="col col-12 p-0 form-group">
                                            <label>Owner Name</label>
                                            <input type="text" class="form-control p-4" value="<?= $owner_fullname?>"
                                                readonly>
                                        </div>


                                        <div class="col col-12 p-0 form-group">
                                            <label>Business Address</label>
                                            <input type="text" class="form-control p-4"
                                                value="<?= $data['bus_address']?>" readonly>
                                        </div>


                                        <div class="col col-12 p-0 form-group">
                                            <label>Business Type</label>
                                            <input type="text" class="form-control p-4" value="<?= $data['bus_type']?>"
                                                readonly>
                                        </div>


                                        <div class="col col-12 p-0 form-group">
                                            <label>Business Contact No.</label>
                                            <input type="text" class="form-control p-4"
                                                value="<?= $data['bus_contact_number']?>" readonly>
                                        </div>

                                        <div class="d-md-flex align-items-center justify-content-center">
                                            <div class="col col-md-6 p-0 form-group flex-md-grow-1">
                                                <label>Floor Area</label>
                                                <input type="text" class="form-control p-4"
                                                    value="<?= $data['floor_area']?>" readonly>
                                            </div>

                                            <div class="col col-md-6 p-0 form-group flex-md-grow-1">
                                                <label for="signage-area">Signage Area</label>
                                                <input type="text" class="form-control p-4"
                                                    value="<?= $data['signage_area']?>" readonly>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="carousel-item p-2" data-bs-interval="false">
                                        <div class="d-flex flex-column" id="item-container">
                                            <div class="d-flex justify-content-between">
                                                <p class="text font-weight-bolder">Item Information</p>
                                                <p class="text font-weight-bolder">Total
                                                    Item: <span id="total-item"><?= count($item_names);?></span>
                                                </p>
                                            </div>


                                            <?php foreach($item_names as $index => $item):?>

                                            <div class="shadow bg-white rounded p-3 mb-2" id="item-content-1">
                                                <a id="item-title-1" class="text text-decoration-none"
                                                    style="cursor: pointer; font-weight: 700;">Item <?= $index + 1?>
                                                </a>
                                                <div class="col col-12 p-0 form-group mb-1">
                                                    <label>Item Name</label>
                                                    <input type="text" class="form-control p-4"
                                                        value="<?= $item_names[$index]?>" readonly>
                                                </div>

                                                <div class="col col-12 p-0 form-group mb-1">
                                                    <label>Category</label>
                                                    <input type="text" class="form-control p-4"
                                                        value="<?= $category_names[$index]?>" readonly>
                                                </div>

                                                <div class="col col-12 p-0 form-group mb-1">
                                                    <label>Section</label>
                                                    <input type="text" class="form-control p-4"
                                                        value="<?= $sections[$index]?>" readonly>
                                                </div>

                                                <div class="col col-12 p-0 form-group mb-1">
                                                    <label>Capacity</label>
                                                    <input type="text" class="form-control p-4"
                                                        value="<?= $capacities[$index]?>" readonly>
                                                </div>

                                                <div class="d-md-flex align-items-center justify-content-center p-0">
                                                    <div class="col col-md-6 p-0 form-group mb-1 flex-md-grow-1">
                                                        <label>Quantity</label>
                                                        <input type="number" class="form-control p-4"
                                                            value="<?= $quantities[$index]?>" readonly>
                                                    </div>

                                                    <div class="col col-md-6 p-0 form-group mb-1 flex-md-grow-1">
                                                        <label>Power Rating</label>
                                                        <input type="number" class="form-control p-4"
                                                            value="<?= $power_ratings[$index]?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="col col-12 p-0 form-group mb-1">
                                                    <label>Fee</label>
                                                    <input type="number" class="form-control p-4"
                                                        value="<?= $fees[$index]?>" readonly>
                                                </div>
                                            </div>
                                            <?php endforeach?>
                                        </div>

                                    </div>

                                    <div class="carousel-item p-2" data-bs-interval="false">

                                        <p class="text font-weight-bolder">Other Fees Information</p>

                                        <div class="col col-12 p-0 form-group">
                                            <label>Building Fee</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>

                                                <input type="number" class="form-control p-4"
                                                    value="<?= $data['building_fee']?>" readonly>
                                            </div>

                                        </div>

                                        <div class="col col-12 p-0 form-group">
                                            <label>Sanitary Fee</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>

                                                <input type="number" class="form-control p-4"
                                                    value="<?= $data['sanitary_fee']?>" readonly>
                                            </div>

                                        </div>

                                        <div class="col col-12 p-0 form-group">
                                            <label>Signage Fee</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>

                                                <input type="number" class="form-control p-4"
                                                    value="<?= $data['signage_fee']?>" readonly>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="carousel-item p-2" data-bs-interval="false">
                                        <div class="d-flex flex-column" id="inspector-container">
                                            <div class="d-flex justify-content-between">
                                                <p class="text font-weight-bolder">Inspector Information</p>
                                                <p class="text font-weight-bolder">Total
                                                    Inspector: <span
                                                        id="total-inspector"><?= count($inspector_firstnames)?></span>
                                                </p>
                                            </div>

                                            <?php 
                                             foreach($inspector_firstnames as $index => $inspector_firstname) :

                                                $inspector_firstname = $inspector_firstnames[$index];
                                                $inspector_midname = $inspector_midnames[$index];
                                                $inspector_lastname = $inspector_lastnames[$index];
                                                $inspector_suffix = $inspector_suffixes[$index];

                                                $inspector_fullname = trim($inspector_firstname . ' ' . $inspector_midname . ' ' . $inspector_lastname . ' ' . $inspector_suffix);

                                          
                                            ?>

                                            <div class="shadow bg-white rounded p-3 mb-2" id="inspector-content-1">
                                                <a id="inspector-title-1" class="text text-decoration-none"
                                                    style="cursor: pointer; font-weight: 700;">Inspector
                                                    <?= $index + 1?></a>
                                                <div class="col col-12 p-0 form-group mb-1">
                                                    <label>Inspector Name</label>

                                                    <input type="text" class="form-control p-4"
                                                        value="<?= $inspector_fullname?>" readonly>
                                                </div>

                                            </div>
                                            <?php endforeach?>
                                        </div>

                                    </div>

                                    <div class="carousel-item p-2" data-bs-interval="false">

                                        <div class=" col col-12 p-0 form-group mb-1">
                                            <label>Remarks</label>
                                            <input type="text" class="form-control p-4" value="<?= $data['remarks']?>"
                                                readonly>
                                        </div>

                                        <div class="d-flex flex-column" id="violation-container">
                                            <div class="d-flex justify-content-between">
                                                <p class="text font-weight-bolder">Violation Information</p>
                                                <p class="text font-weight-bolder">Total
                                                    Violation: <span id="total-violation">
                                                        <?= count($descriptions)?></span>
                                                </p>
                                            </div>

                                            <?php 
                                            
                                            foreach($descriptions as $index => $description) :

                                            
                                                
                                            ?>
                                            <div class="shadow bg-white rounded p-3 mb-2" id="violation-content-1"><a
                                                    id="violation-title-1" class="text text-decoration-none"
                                                    style="cursor: pointer; font-weight: 700;">Violation
                                                    <?= $index + 1?></a>

                                                <div class="col col-12 p-0 form-group mb-1">
                                                    <label>Description</label>
                                                    <input type="text" class="form-control p-4"
                                                        value="<?=$descriptions[$index]?>" readonly>
                                                </div>

                                            </div>

                                            <?php endforeach?>
                                        </div>
                                    </div>
                                </div>

                                <div class=" d-flex justify-content-between mt-4">
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
                        </form>

                        <?php endforeach?>
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