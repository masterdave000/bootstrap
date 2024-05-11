<?php

$title = "Business Details";
include './../includes/side-header.php';

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php

        if (filter_has_var(INPUT_GET, 'bus_id')) {
            $clean_bus_id = filter_var($_GET['bus_id'], FILTER_SANITIZE_NUMBER_INT);
            $bus_id = filter_var($clean_bus_id, FILTER_VALIDATE_INT);

            $businessQuery = "SELECT * from business_view WHERE bus_id = :bus_id";
            $businessStatement = $pdo->prepare($businessQuery);
            $businessStatement->bindParam(':bus_id', $bus_id);
            $businessStatement->execute();

            $businessCount = $businessStatement->rowCount();

            if ($businessCount === 1) {
                $business = $businessStatement->fetch(PDO::FETCH_ASSOC);
                $firstname = htmlspecialchars(ucwords($business['owner_firstname']));
                $midname = htmlspecialchars(ucwords($business['owner_midname'] ? mb_substr($business['owner_midname'], 0, 1, 'UTF-8') . "." : ""));
                $lastname = htmlspecialchars(ucwords($business['owner_lastname']));
                $suffix = htmlspecialchars(ucwords($business['owner_suffix']));
                $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);
            }
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
                        <form class="user" enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center">
                                <div class="image-container mb-3">
                                    <img src="./images/<?php echo $business['bus_img_url'] ?>" alt="default-bus-image" class="img-fluid rounded-circle" />
                                </div>

                                <p class="h3 text-gray-900 mb-4 "><?php echo $business['bus_name'] ?></p>
                            </div>
                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="owner-name">Owner Name
                                    </label>
                                    <input type="text" class="form-control p-4" value="<?php echo $fullname ?>" disabled>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="bus-name">Business Name
                                    </label>
                                    <input type="text" class="form-control p-4" value="<?php echo $business['bus_name'] ?>" disabled>
                                </div>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for=" bus-address">Address</label>
                                <input type="text" class="form-control p-4" value="<?php echo $business['bus_address'] ?>" disabled>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for=" bus-type">Business Type</label>
                                <input type="text" class="form-control p-4" value="<?php echo $business['bus_type'] ?>" disabled>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for=" bus-type">Character of Occupancy</label>
                                <input type="text" class="form-control p-4" value="<?php echo $business['character_of_occupancy'] ?>" disabled>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label>Group</label>
                                <input type="text" class="form-control p-4" value="<?php echo $business['occupancy_group'] ?>" disabled>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="contact-number">Contact Number</label>
                                    <input type="text" class="form-control p-4" value="<?php echo $business['bus_contact_number'] ?>" disabled>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control p-4" value="<?php echo $business['email'] ?>" disabled>
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="floor-area">Floor Area </label>
                                    <input type="number" class="form-control p-4" value="<?php echo $business['floor_area'] ?>" disabled>
                                </div>

                                <div class=" col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="signage-area">Signage Area
                                    </label>
                                    <input type="number" class="form-control p-4" value="<?php echo $business['signage_area'] ?>" disabled>
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