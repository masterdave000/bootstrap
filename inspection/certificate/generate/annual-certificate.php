<?php 

    $title = "Equipment List Certificate";
    include './../../includes/side-header.php';


    // var_dump($_POST);
    // exit;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $clean_bus_id = filter_var($_POST['business_id'], FILTER_SANITIZE_NUMBER_INT);
        $bus_id = filter_var($clean_bus_id, FILTER_VALIDATE_INT);

        $clean_owner_id = filter_var($_POST['owner_id'], FILTER_SANITIZE_NUMBER_INT);
        $owner_id = filter_var($clean_owner_id, FILTER_VALIDATE_INT);
     
        $owner_name = trim(strtoupper($_POST['owner_name']));

        $bus_name = trim(strtoupper($_POST['bus_name']));
        $bus_address = trim(strtoupper($_POST['bus_address']));
        
        $application_type = trim(strtoupper($_POST['application_type']));
        $character_occupancy = trim(strtoupper($_POST['character_occupancy']));
        $group = trim(strtoupper($_POST['group']));
        $occupancy_no = $_POST['occupancy_no'];
        $date_inspected = date('m-d-Y');
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
                        <img src="./../../../assets/img/annual-certificate.jpg" alt="annual-certificate"
                            class="annual-sheet-image">
                        <div class="annual-sheet-left">
                            <div
                                class="d-flex justify-content-center annual-header annual-business-name mb-2 pb-1 annual-data">
                                <?= $owner_name . ' / ' . $bus_name?>
                            </div>

                            <div
                                class="d-flex justify-content-center annual-header annual-business-address pb-1 mb-1 annual-data">
                                <?= $bus_address?>
                            </div>

                            <div class="w-100 d-flex justify-content-between flex-gap annual-owner-wrapper">
                                <div class=" w-50 d-flex flex-column justify-content-center align-items-center ">
                                    <div class="w-100 d-flex justify-content-center annual-owner p-1 annual-data">
                                        <?= $character_occupancy?>
                                    </div>
                                    <p class="w-100 m-0 text-center annual-owner-title">CHARACTER OF OCCUPANCY</p>
                                </div>


                                <div class="w-50 d-flex flex-column justify-content-center align-items-center">
                                    <div class="w-100 d-flex justify-content-center annual-group p-1 annual-data">
                                        <?= $group?>
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

                                <div class="verified-by-wrapper d-flex justify-content-center flex-wrap">

                                    <?php for ($i = 0; $i < count($_POST['inspector_id']); $i++) {
                                    $inspector_id = $_POST['inspector_id'][$i];
                                    $inspector_name = trim(strtoupper($_POST['inspector_abbr'][$i]));
                                    $category = trim(strtoupper($_POST['category'][$i]));

                                    ?>
                                    <div class="verified-by-container">
                                        <div class="verified-by-names w-100 d-flex justify-content-center annual-data">
                                            <?php echo $inspector_name?>
                                        </div>
                                        <p class="w-100 m-0 text-center verified-by-position"> <?php echo $category?>
                                        </p>
                                    </div>

                                    <input type="hidden" name="inspectors_id[]" value="<?= $inspector_id?>">
                                    <input type="hidden" name="inspectors_name[]" value="<?= $inspector_name?>">
                                    <input type="hidden" name="categories[]" value="<?= $category?>">

                                    <?php } ?>


                                    <div class="verified-by-container">
                                        <div class="verified-by-names w-100 d-flex justify-content-center annual-data">
                                            sfsdf
                                        </div>
                                        <p class="w-100 m-0 text-center verified-by-position"> sdfsdf
                                        </p>
                                    </div>


                                    <div class="verified-by-container">
                                        <div class="verified-by-names w-100 d-flex justify-content-center annual-data">
                                            sfsdf
                                        </div>
                                        <p class="w-100 m-0 text-center verified-by-position"> sdfsdf
                                        </p>
                                    </div>


                                    <div class="verified-by-container">
                                        <div class="verified-by-names w-100 d-flex justify-content-center annual-data">
                                            sfsdf
                                        </div>
                                        <p class="w-100 m-0 text-center verified-by-position"> sdfsdf
                                        </p>
                                    </div>


                                    <div class="verified-by-container">
                                        <div class="verified-by-names w-100 d-flex justify-content-center annual-data">
                                            sfsdf
                                        </div>
                                        <p class="w-100 m-0 text-center verified-by-position"> sdfsdf
                                        </p>
                                    </div>


                                    <div class="verified-by-container">
                                        <div class="verified-by-names w-100 d-flex justify-content-center annual-data">
                                            sfsdf
                                        </div>
                                        <p class="w-100 m-0 text-center verified-by-position"> sdfsdf
                                        </p>
                                    </div>


                                    <div class="verified-by-container">
                                        <div class="verified-by-names w-100 d-flex justify-content-center annual-data">
                                            sfsdf
                                        </div>
                                        <p class="w-100 m-0 text-center verified-by-position"> sdfsdf
                                        </p>
                                    </div>


                                    <div class="verified-by-container">
                                        <div class="verified-by-names w-100 d-flex justify-content-center annual-data">
                                            sfsdf
                                        </div>
                                        <p class="w-100 m-0 text-center verified-by-position"> sdfsdf
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="annual-recommended-description">
                                THE ABOVE-DESCRIBED BUILDING/STRUCTURE COVERED BY CERTIFICATE OF OCCUPANCY NO.
                                <u>
                                    <?= $occupancy_no ?? 'N/A' ?></u>
                                ISSUED
                                ON <u><?= $issued_on ?? 'N/A' ?></u> HAS BEEN VERIFIED AND FOUND SUBSTANTIALLY
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
                            <div class="d-flex justify-content-end official-bin">BIN:</div>
                            <table class="mb-2 table-one">
                                <thead>
                                    <tr class="font-seven">
                                        <th colspan="3" class="text-left">CERTIFICATE ANNUAL INSPECTION</th>
                                        <th>DATE INSPECTED</th>
                                    </tr>
                                    <tr>
                                        <th class="font-seven p-2">NAME OF LESSEE</th>
                                        <th colspan="3" class="lessee-name"> <?= $owner_name . ' / ' . $bus_name?></th>
                                    </tr>
                                    <tr>
                                        <th class="font-seven p-3">LOCATION</th>
                                        <th colspan="3" class="location"> <?= $bus_address?></th>
                                    </tr>
                                    <tr class="font-seven">
                                        <th style="width: 15%">DATE SIGNED</th>
                                        <th style="width: 55%">NAME OF INSPECTOR</th>
                                        <th style="width: 15%">TIME IN (SIGNED)</th>
                                        <th style="width: 15%">TIME OUT (SIGNED)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>try</td>
                                        <td>try</td>
                                        <td>try</td>
                                        <td>try</td>
                                    </tr>

                                    <tr>
                                        <td>try</td>
                                        <td>try</td>
                                        <td>try</td>
                                        <td>try</td>
                                    </tr>

                                    <tr>
                                        <td>try</td>
                                        <td>try</td>
                                        <td>try</td>
                                        <td>try</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between inspector">
                                <div>
                                    ANNUAL INSPECTION TEAM: <b>ERNESTO, VILLAFUERTE, MALARAN</b>
                                </div>
                                <div>
                                    DATE COMPLIED: <span><b>01-09-2024</b></span>
                                </div>
                            </div>

                            <div class="checkbox-container w-100 d-flex justify-content-center pl-5">
                                <div class="w-75 d-flex flex-wrap">
                                    <div class="d-flex w-50 flex-gap">
                                        <div class="box d-flex justify-content-center align-items-center">
                                            <?php if ($application_type === 'NEW') :?>
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            <?php endif?>
                                        </div>
                                        <div>NEW</div>
                                    </div>
                                    <div class="d-flex w-50 flex-gap mb-2">
                                        <div class="box d-flex justify-content-center align-items-center">
                                            <?php if ($application_type === 'ANNUAL') :?>
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            <?php endif?>
                                        </div>
                                        <div>ANNUAL</div>
                                    </div>
                                    <div class="d-flex w-50 flex-gap">
                                        <div class="box d-flex justify-content-center align-items-center">
                                            <?php if ($application_type === 'ADDITIONAL LINE') :?>
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            <?php endif?>
                                        </div>
                                        <div>ADDITIONAL LINE</div>
                                    </div>
                                    <div class="d-flex w-50 flex-gap">
                                        <div class="box d-flex justify-content-center align-items-center">
                                            <?php if ($application_type === 'CHANGE ADDRESS') :?>
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            <?php endif?>
                                        </div>
                                        <div>CHANGE ADDRESS</div>
                                    </div>
                                </div>
                            </div>

                            <table>
                                <tr>
                                    <td style="width: 15%">sdfsdf</td>
                                    <td style="width: 55%">sdfsdf</td>
                                    <td style="width: 15%">sdfsdf</td>
                                    <td style="width: 15%">sdfsdf</td>
                                </tr>
                            </table>
                        </div>
                        <section class="position-absolute left bottom-0 end-0 d-print-none">
                            <button class="btn btn-success btn-md-block mr-3 px-3" id="print-button">Print
                                Report</a>
                        </section>
                    </div>

                </div>

            </div>

            <input type="hidden" name="bus_id" value="<?= $bus_id?>">
            <input type="hidden" name="owner_id" value="<?= $owner_id?>">
            <input type="hidden" name="application_type" value="<?= $application_type?>">
            <input type="hidden" name="character_occupancy" value="<?= $character_occupancy?>">
            <input type="hidden" name="bus_group" value="<?= $group?>">
            <input type="hidden" name="occupancy_no" value="<?= $occupancy_no?>">
            <input type="hidden" name="issued_on" value="<?= $issued_on?>">

        </form>
    </div>
</div>

<a class=" scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php 
require './../../includes/footer.php'; 
?>
</body>

</html>