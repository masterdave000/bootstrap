<?php

$title = "Issue Annual Certificate Details";
include './../includes/side-header.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $clean_id = filter_var($_GET['certificate_id'], FILTER_SANITIZE_NUMBER_INT);
    $certificate_id = filter_var($clean_id, FILTER_VALIDATE_INT);

    $annualCertificateQuery = "SELECT DISTINCT certificate_id, application_type, bin, bus_name, bus_address, bus_img_url, bus_group, character_of_occupancy, occupancy_no, issued_on, owner_firstname, owner_midname, owner_lastname, owner_suffix, category, date_complied, date_inspected,
                            GROUP_CONCAT(inspector_firstname) AS inspector_firstname,
                            GROUP_CONCAT(inspector_midname) AS inspector_midname,
                            GROUP_CONCAT(inspector_lastname) AS inspector_lastname,
                            GROUP_CONCAT(inspector_suffix) AS inspector_suffix,
                            GROUP_CONCAT(category) AS category,
                            GROUP_CONCAT(date_signed) AS date_signed,
                            GROUP_CONCAT(time_in) AS time_in,
                            GROUP_CONCAT(time_out) AS time_out
                            FROM annual_inspection_certificate_view 
                            WHERE certificate_id = :certificate_id
                            GROUP BY certificate_id";

    $annualCertificateStatement = $pdo->prepare($annualCertificateQuery);
    $annualCertificateStatement->bindParam(':certificate_id', $certificate_id);
    $annualCertificateStatement->execute();

    $certificates = $annualCertificateStatement->fetchAll(PDO::FETCH_ASSOC);
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

                        <?php foreach ($certificates as $certificate) :
                            $owner_firstname = htmlspecialchars(ucwords($certificate['owner_firstname']));
                            $owner_midname = htmlspecialchars(ucwords($certificate['owner_midname'] ? mb_substr($certificate['owner_midname'], 0, 1, 'UTF-8') . "." : ""));
                            $owner_lastname = htmlspecialchars(ucwords($certificate['owner_lastname']));
                            $owner_suffix = htmlspecialchars(ucwords($certificate['owner_suffix']));

                            $owner_fullname = trim($owner_firstname . ' ' . $owner_midname . ' ' . $owner_lastname . ' ' . $owner_suffix);

                            $inspector_firstnames = explode(',', $certificate['inspector_firstname']);
                            $inspector_midnames = explode(',', $certificate['inspector_midname']);
                            $inspector_lastnames = explode(',', $certificate['inspector_lastname']);
                            $inspector_suffixes = explode(',', $certificate['inspector_suffix']);
                            $categories = explode(',', $certificate['category']);
                            $time_ins = explode(',', $certificate['time_in']);
                            $time_outs = explode(',', $certificate['time_out']);
                            $date_signeds = explode(',', $certificate['date_signed']);

                        ?>
                            <form class="user" id="certificate-form" enctype="multipart/form-data">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="image-container mb-3">
                                        <img src="./../business/images/<?= $certificate['bus_img_url'] ?? 'no-image.png' ?>" alt="default-item-image" class="img-fluid rounded-circle" id="bus-img" />
                                    </div>
                                </div>

                                <div id="certificateCarousel" class="carousel slide">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#certificateCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#certificateCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#certificateCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>

                                    <div class="carousel-inner">
                                        <div class="carousel-item active p-2" data-bs-interval="false">

                                            <p class="text font-weight-bolder">Business Information</p>

                                            <div class="col col-12 p-0 form-group">
                                                <label>Application Type
                                                </label>

                                                <div class="input-group">
                                                    <input type="text" class="form-control p-4" value="<?= $certificate['application_type'] ?: 'None' ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col col-12 p-0 form-group">
                                                <label>Business Name
                                                </label>

                                                <div class="input-group">
                                                    <input type="text" class="form-control p-4" value="<?= $certificate['bus_name'] ?>" readonly>
                                                </div>
                                            </div>


                                            <div class="col col-12 p-0 form-group">
                                                <label>Owner Name
                                                </label>
                                                <input type="text" class="form-control p-4" value="<?= $owner_fullname ?>" readonly>

                                            </div>

                                            <div class="col col-12 p-0 form-group">
                                                <label>Business Address
                                                </label>
                                                <input type="text" class="form-control p-4" value="<?= $certificate['bus_address'] ?>" readonly>
                                            </div>

                                            <div class="col col-12 p-0 form-group">
                                                <label>Business Group
                                                </label>
                                                <input type="text" class="form-control p-4" value="<?= $certificate['bus_group'] ?>" readonly>
                                            </div>

                                            <div class="col col-12 p-0 form-group">
                                                <label>Character of Occupancy
                                                </label>
                                                <input type="text" class="form-control p-4" value="<?= $certificate['character_of_occupancy'] ?>" readonly>
                                            </div>

                                        </div>

                                        <div class="carousel-item p-2" data-bs-interval="false">
                                            <div class="d-flex flex-column" id="inspector-certificate-container">
                                                <div class="d-flex justify-content-between">
                                                    <p class="text font-weight-bolder">Inspector Information</p>
                                                    <p class="text font-weight-bolder">Total
                                                        Inspector: <span id="total-inspector"><?= count($inspector_firstnames); ?></span>
                                                    </p>
                                                </div>

                                                <?php

                                                foreach ($inspector_firstnames as $index => $inspector_firstname) :

                                                    $inspector_firstname = $inspector_firstnames[$index];
                                                    $inspector_midname = $inspector_midnames[$index];
                                                    $inspector_lastname = $inspector_lastnames[$index];
                                                    $inspector_suffix = $inspector_suffixes[$index];

                                                    $inspector_fullname = trim($inspector_firstname . ' ' . $inspector_midname . ' ' . $inspector_lastname . ' ' . $inspector_suffix);

                                                    $category = $categories[$index];
                                                    $date_signed = $date_signeds[$index];
                                                    $time_in = $time_ins[$index];
                                                    $time_out = $time_outs[$index];
                                                ?>



                                                    <div class="shadow bg-white rounded p-3 mb-2" id="inspector-content-1">
                                                        <a id="inspector-title-1" class="text text-decoration-none" style="cursor: pointer; font-weight: 700;">Inspector
                                                            <?= $index + 1 ?></a>

                                                        <div class="col col-12 p-0 form-group mb-1">
                                                            <label>Inspector Name</label>
                                                            <input type="text" class="form-control p-4" value="<?= $inspector_fullname ?>" readonly>
                                                        </div>

                                                        <div class="col col-12 p-0 form-group mb-1">
                                                            <label>Category</label>
                                                            <input type="text" class="form-control p-4" value="<?= $category ?>" readonly>
                                                        </div>

                                                        <div class="col col-12 p-0 form-group mb-1">
                                                            <label>Date Signed
                                                            </label>
                                                            <input type="date" class="form-control p-4" value="<?= $date_signed ?>" readonly>
                                                        </div>
                                                        <div class="d-md-flex align-items-center justify-content-center p-0">
                                                            <div class="col col-md-6 p-0 form-group mb-1 flex-md-grow-1">
                                                                <label>Time In </label>
                                                                <input type="time" class="form-control p-4" value="<?= $time_in ?>" readonly>
                                                            </div>
                                                            <div class="col col-md-6 p-0 form-group mb-1 flex-md-grow-1">
                                                                <label>Time Out </label>
                                                                <input type="time" class="form-control p-4" value="<?= $time_out ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>

                                        <div class="carousel-item p-2" data-bs-interval="false">

                                            <p class="text font-weight-bolder">Other Certificate Information</p>

                                            <div class="col col-12 p-0 form-group">
                                                <label>BIN</label>

                                                <div class="input-group">
                                                    <input type="text" name="bin" class="form-control p-4" value="<?= $certificate['bin'] ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col col-12 p-0 form-group">
                                                <label>Character Of Occupancy</label>

                                                <div class="input-group">
                                                    <input type="text" class="form-control p-4" value="<?= $certificate['character_of_occupancy'] ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col col-12 p-0 form-group">
                                                <label>Group</label>

                                                <div class="input-group">
                                                    <input type="text" class="form-control p-4" value="<?= $certificate['bus_group'] ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col col-12 p-0 form-group">
                                                <label>Occupancy No.</label>

                                                <div class="input-group">
                                                    <input type="text" class="form-control p-4" value="<?= $certificate['occupancy_no'] ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col col-12 p-0 form-group">
                                                <label for="date-compiled">Date Complied</label>

                                                <div class="input-group">
                                                    <input type="date" class="form-control p-4" value="<?= $certificate['date_complied'] ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col col-12 p-0 form-group">
                                                <label for="issued-on">Issued On</label>

                                                <div class="input-group">
                                                    <input type="datetime" class="form-control p-4" value="<?= $certificate['issued_on'] ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <div class="previous-container invisible">
                                            <button class="d-flex justify-content-center align-items-center border-0 bg-dark p-2 previous carousel-button" data-bs-target="#certificateCarousel" role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                        <div class="next-container">
                                            <button class="d-flex justify-content-center align-items-center border-0 bg-dark p-2 next carousel-button" data-bs-target="#certificateCarousel" role="button" data-bs-slide="next">
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
require './modals/inspector.php';
?>

</body>

</html>