<?php

// var_dump($_POST);
// exit;

$title = "Equipment List Certificate";
include './../../includes/side-header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clean_owner_id = filter_var($_POST['owner_id'], FILTER_SANITIZE_NUMBER_INT);
    $owner_id = filter_var($clean_owner_id, FILTER_VALIDATE_INT);

    $clean_business_id = filter_var($_POST['business_id'], FILTER_SANITIZE_NUMBER_INT);
    $business_id = filter_var($clean_business_id, FILTER_VALIDATE_INT);

    $clean_sanitary_id = filter_var($_POST['sanitary_id'], FILTER_SANITIZE_NUMBER_INT);
    $sanitary_id = filter_var($clean_sanitary_id, FILTER_VALIDATE_INT);

    $clean_bldg_billing_id = filter_var($_POST['bldg_billing_id'], FILTER_SANITIZE_NUMBER_INT);
    $bldg_billing_id = filter_var($clean_bldg_billing_id, FILTER_VALIDATE_INT);

    $clean_signage_id = filter_var($_POST['signage_id'], FILTER_SANITIZE_NUMBER_INT);
    $signage_id = filter_var($clean_signage_id, FILTER_VALIDATE_INT);


    $owner_name = trim(ucwords($_POST['owner_name']));

    $bus_name = trim(ucwords($_POST['bus_name']));
    $bus_address = trim(ucwords($_POST['bus_address']));
    $bus_type = trim(ucwords($_POST['bus_type']));
    $bus_contact_number = trim(ucwords($_POST['bus_contact_number']));

    $floor_area = $_POST['floor_area'];
    $signage_area = $_POST['signage_area'];

    $application_type = $_POST['application_type'];
    $remarks = $_POST['remarks'];

    $building_fee = $_POST['bldg_fee'];
    $sanitary_fee = $_POST['sanitary_fee'];
    $sanitary_quantity = $_POST['sanitary_quantity'];
    $signage_fee = $_POST['signage_fee'];

    $totalElectronicsFee = 0.00;
    $totalElectricalFee = 0.00;
    $totalMechanicalFee = 0.00;
}
?>



<div id="content-wrapper">
    <div class="content">
        <?php require './../../includes/top-header.php' ?>

        <div class="container-fluid py-5 d-flex flex-row justify-content-center d-print-flex" id="equipmentListFees">
            <!-- Scroll to Top Button-->
            <form action="./../controller/create.php" method="POST">
                <section class="sheet-container">
                    <section class="sheet">
                        <img src="./../../../assets/img/list-of-equipments.jpg" alt="list-of-equipment" class="sheet-image">
                        <section class="section">
                            <div class="section-header">
                                <div class="d-flex justify-content-between w-100">
                                    <div class="d-flex flex-column align-items-center justify-content-center owner-container p-0">
                                        <p class="owner-name"><?php echo $owner_name ?></p>
                                        <p>Name of Owner (Signature over Printed Name)</p>
                                    </div>
                                    <p>Date: <u><?php echo date('m-d-Y') ?></u></p>
                                </div>
                                <div class="d-flex justify-content-between m-0">
                                    <p class="m-0">Autorized Representative: </p>
                                    <span class="underline"></span>
                                    <p class="m-0">Contact No: <u><?php echo $bus_contact_number ?></u></p>
                                </div>
                                <div class="d-flex justify-content-between m-0">
                                    <p class="m-0">Name of Business: </p>
                                    <span class="underline">
                                        <span class="ml-2"><?php echo $bus_name ?></span>
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between m-0">
                                    <p class="m-0">Type of Business: </p>
                                    <span class="underline"><span class="ml-2"><?php echo $bus_type ?></span></span>
                                </div>

                                <div class="d-flex justify-content-between m-0">
                                    <p class="m-0">Business Address: </p>
                                    <span class="underline"><span class="ml-2"><?php echo $bus_address ?></span></span>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <p class="m-0">Application Type: </p>
                                    <span class="underline"><span class="ml-2"><?php echo $application_type ?></span></span>
                                </div>
                            </div>

                            <table class="section-table w-100 mb-3">
                                <capton class="mt-4">
                                    <b>NOTE: This list is subject to verification by inspectors of the Office of the
                                        Building
                                        Official.</b>
                                </capton>

                                <thead>
                                    <tr>
                                        <th rowspan="2" style="width: 42%">
                                            Item
                                            Description
                                        </th>
                                        <th rowspan="2" style="width: 13%">Power Rating</th>
                                        <th rowspan="2">QTY</th>
                                        <th colspan="3" style="width: 37%;">Fees</th>
                                    </tr>

                                    <tr>
                                        <th class="font-weight-normal"><i>Electronics</i></th>
                                        <th class="font-weight-normal"><i>Electrical</i></th>
                                        <th class="font-weight-normal"><i>Mechanical</i></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    for ($i = 0; $i < count($_POST['item_id']); $i++) {
                                        $billing_id = $_POST['billing_id'][$i];
                                        $item_id = $_POST['item_id'][$i];
                                        $item_name = $_POST['item_name'][$i];
                                        $category_name = $_POST['category_name'][$i];
                                        $quantity = $_POST['quantity'][$i];
                                        $power_rating = $_POST['power_rating'][$i];
                                        $fee = $_POST['fee'][$i];

                                        switch ($category_name) {
                                            case 'Electronics':
                                                $totalElectronicsFee += $fee;
                                                break;
                                            case 'Electrical':
                                                $totalElectricalFee += $fee;
                                                break;
                                            case 'Mechanical':
                                                $totalMechanicalFee += $fee;
                                                break;
                                            default:
                                                break;
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $item_name ?></td>
                                            <td><?php echo $power_rating ?></td>
                                            <td><?php echo $quantity ?></td>
                                            <td><?php echo $category_name === 'Electronics' ? $fee : '' ?></td>
                                            <td><?php echo $category_name === 'Electrical' ? $fee : '' ?></td>
                                            <td><?php echo $category_name === 'Mechanical' ? $fee : '' ?></td>
                                        </tr>

                                        <input type="hidden" name="billings_id[]" value="<?php echo $billing_id ?>">
                                        <input type="hidden" name="items_id[]" value="<?php echo $item_id ?>">
                                        <input type="hidden" name="power_ratings[]" value="<?php echo $power_rating ?>">
                                        <input type="hidden" name="quantities[]" value="<?php echo $quantity ?>">
                                        <input type="hidden" name="fees[]" value="<?php echo $fee ?>">
                                    <?php

                                    }

                                    ?>

                                    <tr>
                                        <td class="text-right px-2"><b>TOTAL</b></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>₱ <?php echo number_format($totalElectronicsFee, 2) ?? 0.00 ?></b></td>
                                        <td><b>₱ <?php echo number_format($totalElectricalFee, 2) ?? 0.00 ?></b></td>
                                        <td><b>₱ <?php echo number_format($totalMechanicalFee, 2) ?? 0.00 ?></b></td>
                                    </tr>
                                </tbody>
                            </table>

                            <section class="section-footer d-flex justify-content-between">
                                <div class="left w-50">
                                    <div class="inspector-container mb-2 d-flex justify-content-between flex-gap">
                                        <div class="inspector-names w-50 d-flex flex-column align-items-center px-1">
                                            <div><b>Inspector Name & Signature</b></div>

                                            <?php



                                            for ($i = 0; $i < count($_POST['inspector_id']); $i++) {
                                                $inspector_id = $_POST['inspector_id'][$i];
                                                $inspector_name = $_POST['inspector_name'][$i];
                                            ?>

                                                <div class="d-flex justify-content-center m-0">
                                                    <?php echo $inspector_name ?>
                                                </div>

                                                <input type="hidden" name="inspectors_id[]" value="<?php echo $inspector_id ?>">


                                            <?php
                                            }
                                            ?>
                                            <div></div>
                                            <div></div>


                                        </div>
                                        <div class="date-inspected w-50 d-flex flex-column align-items-center px-1">
                                            <div><b>Remarks/Date Inspected</b></div>

                                            <div class="d-flex justify-content-center m-0">
                                                <span><?php echo date('m-d-Y'); ?></span>
                                            </div>

                                            <div class="d-flex justify-content-center m-0">
                                                <span><?php echo $remarks ?></span>
                                            </div>
                                            <div></div>
                                            <div></div>


                                        </div>
                                    </div>
                                    <div class="inspected-payment-container px-2">
                                        <div class="mb-3">
                                            <p class="font-weight-bolder m-0 text-center inspected-title pl-3 py-0">
                                                INSPECTED
                                            </p>
                                            <p class="font-weight-bolder m-0 text-center payment-title">for
                                                payment</p>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <div class="w-50">
                                                <div class="text-center city-building-official">ENGR. AUREA M. PASCUAL
                                                </div>
                                                <div class="text-center city-building-title">CITY BUILDING OFFICIAL
                                                </div>
                                            </div>
                                            <div class="w-50 d-flex flex-column align-items-center justify-content-end">
                                                <div class="w-75 underline"></div>
                                                <div class="date">Date</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="address-notice">
                                        PLEASE SKETCH CLEARLY THE LOCATION/ADDRESS OF THE ESTABLISHMENT AT THE BACK OF
                                        THIS
                                        FORM.
                                    </div>
                                </div>
                                <div class="right w-50">
                                    <div class="d-flex justify-content-between m-0">
                                        <p class="m-0">Floor Area: </p>
                                        <span class="underline"><span class="ml-2"><?php echo $floor_area ?></span>
                                        </span> <span>m<sup>2</sup> </span>
                                    </div>

                                    <div class="d-flex flex-column align-items-center m-0 mb-2">
                                        <div class="d-flex justify-content-between w-100">
                                            <p class="m-0">Sinage Area: </p>
                                            <span class="underline">
                                                <span class="ml-2"><?php echo $signage_area ?></span>
                                            </span>
                                            <span>m<sup>2</sup> </span>
                                        </div>
                                        <div>(Painted/Lighted)</div>

                                    </div>

                                    <div class="d-flex flex-column align-items-start other-fee">
                                        <div>Building Fee = ₱ <?php echo $building_fee ?></div>
                                        <div>Plumbing/Sanitary Fee = ₱ <?php echo $sanitary_fee ?></div>
                                        <div>Signage Fee = ₱ <?php echo $signage_fee ?></div>
                                    </div>

                                    <div>
                                        <div class="d-flex justify-content-start assessment-fee-title">
                                            <div>TOTAL ASSESSMENT FEE = ₱
                                                <?php
                                                $totalAssessmentFee = $totalElectronicsFee + $totalElectricalFee +
                                                    $totalMechanicalFee + $building_fee + $sanitary_fee + $signage_fee;

                                                echo number_format($totalAssessmentFee, 2);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column align-items-center violation-container">
                                            <div><b>VIOLATION/S:</b> (PLEASE CHECK)</div>
                                            <ul class="align-self-start">
                                                <?php

                                                if (filter_has_var(INPUT_POST, 'violation_id')) {
                                                    for ($i = 0; $i < count($_POST['violation_id']); $i++) {
                                                        $violation_id = $_POST['violation_id'][$i];
                                                        $description = $_POST['description'][$i];

                                                ?>

                                                        <li><?php echo $description ?></li>
                                                        <input type="hidden" name="violations_id[]" value="<?php echo $violation_id ?>">

                                                    <?php
                                                    }
                                                } else {

                                                    ?>
                                                    <li><?php echo 'No Violation' ?></li>
                                                <?php
                                                }
                                                ?>


                                            </ul>
                                        </div>
                                    </div>
                                    <div class="number">
                                        (083) 554-1570 | 09335436999
                                    </div>
                                </div>
                            </section>
                        </section>
                        <section class="position-absolute left bottom-0 start-50 translate-middle d-print-none">
                            <button class="btn btn-primary btn-md-block mr-3 px-3" id="print-button">Print
                                Report</a>
                        </section>
                    </section>
                </section>

                <input type="hidden" name="owner_id" value="<?php echo $owner_id ?>">
                <input type="hidden" name="business_id" value="<?php echo $business_id ?>">
                <input type="hidden" name="bldg_billing_id" value="<?php echo $bldg_billing_id ?>">
                <input type="hidden" name="signage_id" value="<?php echo $signage_id ?>">
                <input type="hidden" name="sanitary_id" value="<?php echo $sanitary_id ?>">
                <input type="hidden" name="application_type" value="<?php echo $application_type ?>">
                <input type="hidden" name="building_fee" value="<?php echo $building_fee ?>">
                <input type="hidden" name="sanitary_fee" value="<?php echo $sanitary_fee ?>">
                <input type="hidden" name="sanitary_quantity" value="<?php echo $sanitary_quantity ?>">
                <input type="hidden" name="signage_fee" value="<?php echo $signage_fee ?>">
                <input type="hidden" name="remarks" value="<?php echo $remarks ?>">
            </form>
        </div>
    </div>
</div>

<a class="scroll-to-top rounded d-print-none" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php

require './../../includes/footer.php';
?>
</body>

</html>