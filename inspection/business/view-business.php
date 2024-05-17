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

            //inspection base sa bus_id
            $inspectionQuery = "SELECT * FROM inspection WHERE bus_id = :bus_id";
            $inspectionStatement = $pdo->prepare($inspectionQuery);
            $inspectionStatement->bindParam(':bus_id', $bus_id);
            $inspectionStatement->execute();

            $inspections = $inspectionStatement->fetchAll(PDO::FETCH_ASSOC);

        }
        ?>
        <?php
        function formatDate($dateString) {
            if ($dateString === '0000-00-00 00:00:00') {
                return 'Not assigned';
            }
            
            $date = new DateTime($dateString);
            return $date->format('M-d-Y');
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
                            <div class="row">
                                <div class="col"></div>
                                <div class="col col-md-5">
                                    <h1 class="h4 text-gray-900 mb-4"><?php echo $title ?></h1>
                                </div>
                                <div class="col">
                                    <button class="btn btn-success" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">History</button>
                                </div>
                                <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Inspection History</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php if (!empty($inspections)): ?>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Application ID</th>
                                                            <th>Remarks</th>
                                                            <th>Date Inspected</th>
                                                            <th>Date Signed</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($inspections as $inspection): ?>
                                                            <tr>
                                                                <td class="application-type" data-bs-target="#exampleModalToggle2">
                                                                    <a href="../inspection/view-inspection.php?inspection_id=<?php echo htmlspecialchars($inspection['inspection_id']); ?>" target="_blank">
                                                                        <?php echo htmlspecialchars($inspection['inspection_id']); ?>
                                                                    </a>
                                                                </td>
                                                                <td><?php echo htmlspecialchars($inspection['remarks']); ?></td>
                                                                <td><?php echo formatDate($inspection['date_inspected']); ?></td>
                                                                <td><?php echo formatDate($inspection['date_signed']); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php else: ?>
                                                <p>No inspection data available.</p>
                                            <?php endif; ?>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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