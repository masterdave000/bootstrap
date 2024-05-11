<?php


$title = "Annual Certificate";
include './../../includes/side-header.php';

// var_dump($_POST);
// exit;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_bus_id = filter_var($_POST['business_id'], FILTER_SANITIZE_NUMBER_INT);
    $bus_id = filter_var($clean_bus_id, FILTER_VALIDATE_INT);

    $clean_owner_id = filter_var($_POST['owner_id'], FILTER_SANITIZE_NUMBER_INT);
    $owner_id = filter_var($clean_owner_id, FILTER_VALIDATE_INT);

    $bin = $_POST['bin'];
    $owner_name = trim(strtoupper($_POST['owner_name']));

    $bus_name = trim(strtoupper($_POST['bus_name']));
    $bus_address = trim(strtoupper($_POST['bus_address']));

    $application_type = trim(strtoupper($_POST['application_type']));
    $character_occupancy = trim(strtoupper($_POST['character_of_occupancy']));
    $group_substr = trim(strtoupper(substr($_POST['occupancy_group'], -1)));
    $group = trim(strtoupper($_POST['occupancy_group']));
    $occupancy_no = $_POST['occupancy_no'];
    $date_inspected = date('m-d-Y');
    $date_complied = $_POST['date_complied'];
    $issued_on = $_POST['issued_on'];
}
?>

<div id="content-wrapper">
    <div class="content">
        <?php require './../../includes/top-header.php' ?>

        <form action="./../controller/create.php" method="POST">
            <div class="container-fluid d-flex justify-content-center py-5">
                <div class="annual-container">
                    <div class="annual-sheet">
                        <img src="./../../../assets/img/annual-certificate.jpg" alt="annual-certificate" class="annual-sheet-image">
                        <div class="annual-sheet-left">
                            <div class="d-flex justify-content-center annual-header annual-business-name mb-2 pb-1 annual-data">
                                <?= $owner_name . ' / ' . $bus_name ?>
                            </div>

                            <div class="d-flex justify-content-center annual-header annual-business-address pb-1 mb-1 annual-data">
                                <?= $bus_address ?>
                            </div>

                            <div class="w-100 d-flex justify-content-between flex-gap annual-owner-wrapper">
                                <div class=" w-50 d-flex flex-column justify-content-center align-items-center ">
                                    <div class="w-100 d-flex justify-content-center annual-owner p-1 annual-data">
                                        <?= $character_occupancy ?>
                                    </div>
                                    <p class="w-100 m-0 text-center annual-owner-title">CHARACTER OF OCCUPANCY</p>
                                </div>


                                <div class="w-50 d-flex flex-column justify-content-center align-items-center">
                                    <div class="w-100 d-flex justify-content-center annual-group p-1 annual-data">
                                        <?= $group_substr ?>
                                    </div>
                                    <p class="w-100 m-0 text-center annual-group-title">Group</p>
                                </div>
                            </div>

                            <div class="annual-certification-description">
                                A CERTIFICATION DULY SIGNED AND SEALED FROM A DULY LICENSED ARCHITECT/CIVIL ENGINEER,
                                PROFESSIONAL ELECTRICAL ENGINEER/ ELECTRONICS ENGINEER/PROFESSIONAL MECHANICAL ENGINEER,
                                MASTER PLUMBER AND SANITARY ENGINEER HIRED BY THE OWNER WAS SUBMITTED AND WHO UNDERTOOK
                                THE
                                ANNUAL INSPECTION THAT THE BUILDING/STRUCTURE IS ARCHITECTURALLY PRESENTABLE,
                                STRUCTURALLY
                                SAFE, THE ELECTRICAL
                            </div>

                            <div class="d-flex flex-column align-items-center mb-2">
                                <div class="verified-title mb-1">
                                    VERIFIED AS TO THE FOLLOWING
                                </div>

                                <div class="verified-by-wrapper w-100 d-flex justify-content-center flex-wrap">
                                    <?php

                                    for ($i = 0; $i < count($_POST['inspector_id']); $i++) {
                                        $inspector_id = $_POST['inspector_id'][$i];
                                        $inspector_name = trim(strtoupper($_POST['inspector_abbr'][$i]));
                                        $category = trim(strtoupper($_POST['category'][$i]));

                                    ?>
                                        <div class="verified-by-container">
                                            <div class="verified-by-names w-100 d-flex justify-content-center annual-data">
                                                <?php echo $inspector_name ?>
                                            </div>
                                            <p class="w-100 m-0 text-center verified-by-position"> <?php echo $category ?>
                                            </p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="annual-recommended-description">
                                THE ABOVE-DESCRIBED BUILDING/STRUCTURE COVERED BY CERTIFICATE OF OCCUPANCY NO.
                                <u>
                                    <?= $occupancy_no ?? 'N/A' ?></u>
                                ISSUED
                                ON <u><?= date('m/d/Y', strtotime($issued_on)) ?? 'N/A' ?></u> HAS BEEN VERIFIED AND
                                FOUND
                                SUBSTANTIALLY
                                SATISFACTORY COMPLIED, THEREFORE
                                THE
                                “CERTIFICATE OF ANNUAL INSPECTION” IS HEREBY RECOMMENDED FOR ISSUANCE.
                            </div>

                            <div class="annual-footer d-flex justify-content-center">
                                <div class="w-50 d-flex flex-column align-items-center">
                                    <div class="chief-name"><u>ENGR. GREGORY KARL D. SAN JUAN</u></div>
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="chief-title">SECTION CHIEF</div>
                                        <div class="inspection-division-title">
                                            INSPECTION AND ENFORCEMENT DIVISION
                                        </div>
                                        <div class="signature-title">
                                            (SIGNATURE OVER PRINTED NAME)
                                        </div>
                                    </div>
                                    <div class="annual-date d-flex justify-content-center w-100">
                                        <p class="m-0">DATE</p> <span class="annual-date-underline">
                                        </span>
                                    </div>
                                </div>
                                <div class="w-50 d-flex flex-column align-items-center">
                                    <div class="chief-name"><u>ENGR. EMMANUEL T. AWAYAN</u></div>
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="chief-title">DIVISION CHIEF</div>
                                        <div class="inspection-division-title">
                                            INSPECTION AND ENFORCEMENT DIVISION
                                        </div>
                                        <div class="signature-title">
                                            (SIGNATURE OVER PRINTED NAME)
                                        </div>
                                    </div>
                                    <div class="annual-date d-flex justify-content-center w-100">
                                        <p class="m-0">DATE</p> <span class="annual-date-underline">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="annual-sheet-right">
                            <div class="d-flex justify-content-end official-bin">BIN: <?= strtoupper($bin); ?></div>
                            <table class="table table-bordered mb-2 table-one">
                                <thead>
                                    <tr class="font-seven border-0">
                                        <th colspan="2" class="text-left">CERTIFICATE ANNUAL INSPECTION</th>
                                        <th colspan="2">DATE INSPECTED: <?= $date_inspected ?></th>
                                    </tr>
                                    <tr>
                                        <th class="font-seven p-2 text-center">NAME OF LESSEE</th>
                                        <th colspan="3" class="lessee-name text-center">
                                            <?= $owner_name . ' / ' . $bus_name ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="font-seven p-3">LOCATION</th>
                                        <th colspan="3" class="location text-center align-middle"> <?= $bus_address ?>
                                        </th>
                                    </tr>

                                    <tr class="font-seven inspector_head">
                                        <th class="align-middle" style="width: 15%">DATE SIGNED</th>
                                        <th class="align-middle" style="width: 55%">NAME OF INSPECTOR</th>
                                        <th style="width: 15%">TIME IN (SIGNED)</th>
                                        <th style="width: 15%">TIME OUT (SIGNED)</th>
                                    </tr>
                                </thead>
                                <tbody class="inspector_body">
                                    <?php
                                    // Initialize an empty array to store unique inspector names
                                    $uniqueInspectorIds = array();

                                    for ($i = 0; $i < count($_POST['inspector_id']); $i++) {

                                        // Check if the inspector name already exists in the unique array
                                        if (!in_array($_POST['inspector_id'][$i], $uniqueInspectorIds)) {
                                            // If not, add it to the array
                                            $uniqueInspectorIds[] = $_POST['inspector_id'][$i];
                                            $inspector_id = $_POST['inspector_id'][$i];
                                            $date_signed = $_POST['date_signed'][$i];
                                            $inspector_name = trim(strtoupper($_POST['inspector_abbr'][$i]));
                                            $date_signed_format = date('m/d/Y', strtotime($date_signed[$i]));
                                            $time_in = date('h:i A', strtotime($_POST['time_in'][$i]));
                                            $time_out = date('h:i A', strtotime($_POST['time_out'][$i]));

                                    ?>
                                            <tr>
                                                <td><?= $date_signed_format ?></td>
                                                <td><?= $inspector_name ?></td>
                                                <td><?= $time_in ?></td>
                                                <td><?= $time_out ?></td>
                                            </tr>

                                            <input type="hidden" name="inspectors_id[]" value="<?= $inspector_id ?>">
                                            <input type="hidden" name="inspectors_name[]" value="<?= $inspector_name ?>">
                                            <input type="hidden" name="categories[]" value="<?= $category ?>">
                                            <input type="hidden" name="dates_signed[]" value="<?= $date_signed ?>">
                                            <input type="hidden" name="time_ins[]" value="<?= $time_in ?>">
                                            <input type="hidden" name="time_outs[]" value="<?= $time_out ?>">
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between inspector">
                                <div>
                                    ANNUAL INSPECTION TEAM:
                                    <b>
                                        <?php
                                        $uniqueLastnames = array();

                                        for ($i = 0; $i < count($_POST['inspector_lastname']); $i++) {
                                            if (!in_array($_POST['inspector_lastname'][$i], $uniqueLastnames)) {

                                                $uniqueLastnames[] = $_POST['inspector_lastname'][$i];

                                                $lastname = strtoupper($_POST['inspector_lastname'][$i]) . ', ';

                                                // Check if this is the last iteration of the loop
                                                if ($i == count($_POST['inspector_lastname']) - 1) {
                                                    $lastname = strtoupper($_POST['inspector_lastname'][$i]); // Output the last name without a comma

                                                }

                                        ?>

                                                <?php echo $lastname; ?>

                                        <?php
                                            }
                                        }

                                        ?>
                                    </b>

                                </div>
                                <div>
                                    DATE COMPLIED: <span><b>
                                            <?= date('m/d/Y', strtotime($date_complied)); ?>
                                        </b></span>
                                </div>
                            </div>

                            <div class="checkbox-container w-100 d-flex justify-content-center pl-5">
                                <div class="w-75 d-flex flex-wrap">
                                    <div class="d-flex w-50 flex-gap">
                                        <div class="box d-flex justify-content-center align-items-center">
                                            <?php if ($application_type === 'NEW') : ?>
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            <?php endif ?>
                                        </div>
                                        <div>NEW</div>
                                    </div>
                                    <div class="d-flex w-50 flex-gap mb-2">
                                        <div class="box d-flex justify-content-center align-items-center">
                                            <?php if ($application_type === 'ANNUAL') : ?>
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            <?php endif ?>
                                        </div>
                                        <div>ANNUAL</div>
                                    </div>
                                    <div class="d-flex w-50 flex-gap">
                                        <div class="box d-flex justify-content-center align-items-center">
                                            <?php if ($application_type === 'ADDITIONAL LINE') : ?>
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            <?php endif ?>
                                        </div>
                                        <div>ADDITIONAL LINE</div>
                                    </div>
                                    <div class="d-flex w-50 flex-gap">
                                        <div class="box d-flex justify-content-center align-items-center">
                                            <?php if ($application_type === 'CHANGE ADDRESS') : ?>
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            <?php endif ?>
                                        </div>
                                        <div>CHANGE ADDRESS</div>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="p-0 m-0">
                                        <td style="width: 15%"></td>
                                        <td class="text-center m-0" style="width: 55%">ENGR. GREGORY KARL D. SAN JUAN
                                        </td>
                                        <td style="width: 15%"></td>
                                        <td style="width: 15%"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%"></td>
                                        <td class="text-center" style="width: 55%">INSPECTION AND ENFORCEMENT SECTION
                                            CHIEF</td>
                                        <td style="width: 15%"></td>
                                        <td style="width: 15%"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%"></td>
                                        <td class="text-center no-data" style="width: 55%"></td>
                                        <td style="width: 15%"></td>
                                        <td style="width: 15%"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%"></td>
                                        <td class="text-center" style="width: 55%">ENGR. EMMANUEL T. AWAYAN</td>
                                        <td style="width: 15%"></td>
                                        <td style="width: 15%"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%"></td>
                                        <td class="text-center" style="width: 55%">INSPECTION AND ENFORCEMENT DIVISION
                                            CHIEF</td>
                                        <td style="width: 15%"></td>
                                        <td style="width: 15%"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%"></td>
                                        <td class="text-center no-data" style="width: 55%"></td>
                                        <td style="width: 15%"></td>
                                        <td style="width: 15%"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%"></td>
                                        <td class="text-center" style="width: 55%">ENGR. AUREA M. PASCUAL</td>
                                        <td style="width: 15%"></td>
                                        <td style="width: 15%"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%"></td>
                                        <td class="text-center" style="width: 55%"> BUILDING OFFICIAL</td>
                                        <td style="width: 15%"></td>
                                        <td style="width: 15%"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%"></td>
                                        <td class="text-center no-data" style="width: 55%"></td>
                                        <td style="width: 15%"></td>
                                        <td style="width: 15%"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <section class="position-absolute left bottom-0 end-0 d-print-none">
                            <button class="btn btn-primary btn-md-block mr-3 px-3" id="print-button">Print
                                Report</a>
                        </section>
                    </div>

                </div>

            </div>

            <input type="hidden" name="bus_id" value="<?= $bus_id ?>">
            <input type="hidden" name="owner_id" value="<?= $owner_id ?>">
            <input type="hidden" name="bin" value="<?= $bin ?>">
            <input type="hidden" name="application_type" value="<?= $application_type ?>">
            <input type="hidden" name="character_occupancy" value="<?= $character_occupancy ?>">
            <input type="hidden" name="occupancy_group" value="<?= $group ?>">
            <input type="hidden" name="occupancy_no" value="<?= $occupancy_no ?>">
            <input type="hidden" name="issued_on" value="<?= $issued_on ?>">
            <input type="hidden" name="date_complied" value="<?= $date_complied ?>">

        </form>
    </div>
</div>

<a class=" scroll-to-top rounded d-print-none" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php
require './../../includes/footer.php';
?>
</body>

</html>