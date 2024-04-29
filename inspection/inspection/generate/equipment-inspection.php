<?php 

    $title = "Equipment List Certificate";
    include './../../includes/side-header.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $clean_owner_id = filter_var($_POST['owner_id'], FILTER_SANITIZE_NUMBER_INT);
        $owner_id = filter_var($clean_owner_id, FILTER_VALIDATE_INT);

        $clean_business_id = filter_var($_POST['business_id'], FILTER_SANITIZE_NUMBER_INT);
        $business_id = filter_var($clean_business_id, FILTER_VALIDATE_INT);

        $owner_name = trim(ucwords($_POST['owner_name']));

        $bus_name = trim(ucwords($_POST['bus_name']));
        $bus_address = trim(ucwords($_POST['bus_address']));
        $bus_type = trim(ucwords($_POST['bus_type']));
        $bus_contact_number = trim(ucwords($_POST['bus_contact_number']));

        $floor_area = $_POST['floor_area'];
        $signage_area = $_POST['signage_area'];

        $application_type = $_POST['application_type'];

        $building_fee = $_POST['building_fee'];
        $sanitary_fee = $_POST['sanitary_fee'];
        $signage_fee = $_POST['signage_fee'];

        
    }
?>



<div id="content-wrapper">
    <div class="content">
        <?php require './../../includes/top-header.php' ?>

        <div class="container-fluid py-5 d-flex flex-row justify-content-center" id="equipmentListFees">
            <!-- Scroll to Top Button-->
            <form action="./../controller/create.php" method="POST">

            </form>

            <section class="sheet-container">
                <section class="sheet">
                    <img src="./../../../assets/img/list-of-equipments.jpg" alt="list-of-equipment" class="sheet-image">
                    <section class="section">
                        <div class="section-header">
                            <div class="d-flex justify-content-between w-100">
                                <div
                                    class="d-flex flex-column align-items-center justify-content-center owner-container p-0">
                                    <p class="owner-name"><?php echo $owner_name?></p>
                                    <p>Name of Owner (Signature over Printed Name)</p>
                                </div>
                                <p>Date: <u><?php echo date('m-d-Y')?></u></p>
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
                                    $item_id = $_POST['item_id'];
                                    

                                    for ($i = 0; $i < count($item_id); $i++) {
                                        $itemId = $_POST['item_id'][$i];
                                        $item_name = $_POST['item_name'][$i];
                                        $category_name = $_POST['category_name'][$i];
                                        $section = $_POST['section'][$i];
                                        $capacity = $_POST['capacity'][$i];
                                        $quantity = $_POST['quantity'][$i];
                                        $power_rating = $_POST['power_rating'][$i];
                                        $fee = $_POST['fee'][$i];

                                        ?>
                                <tr>
                                    <td><?php echo $item_name?></td>
                                    <td><?php echo $power_rating?></td>
                                    <td><?php echo $quantity?></td>
                                    <td><?php echo $category_name === 'Electronics'? $fee : ''?></td>
                                    <td><?php echo $category_name === 'Electrical'? $fee : ''?></td>
                                    <td><?php echo $category_name === 'Mechanical'? $fee : ''?></td>
                                </tr>

                                <?php
                                        
                                    }
                                
                                ?>

                                <tr>
                                    <td class="text-right px-2"><b>TOTAL</b></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>₱</b></td>
                                    <td><b>₱</b></td>
                                    <td><b>₱</b></td>
                                </tr>
                            </tbody>
                        </table>

                        <section class="section-footer d-flex justify-content-between">
                            <div class="left w-50">
                                <div class="inspector-container mb-2 d-flex justify-content-between flex-gap">
                                    <div class="inspector-names w-50 d-flex flex-column align-items-center px-1">
                                        <div><b>Inspector Name & Signature</b></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                    <div class="date-inspected w-50 d-flex flex-column align-items-center px-1">
                                        <div><b>Remarks/Date Inspected</b></div>
                                        <div></div>
                                        <div></div>
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
                                            <div class="text-center city-building-title">CITY BUILDING OFFICIAL</div>
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

                                <div class="w-50 d-flex flex-column align-items-end other-fee">
                                    <div>Building Fee = <?php echo $building_fee ?></div>
                                    <div>Plumbing/Sanitary Fee = <?php echo $sanitary_fee ?></div>
                                    <div>Signage Fee = <?php echo $signage_fee ?></div>
                                </div>

                                <div>
                                    <div class="w-50 d-flex justify-content-end assessment-fee-title">
                                        <div>TOTAL ASSESSMENT FEE =</div>
                                    </div>
                                    <div class="d-flex flex-column align-items-center violation-container">
                                        <div><b>VIOLATION/S:</b> (PLEASE CHECK)</div>
                                        <div></div>
                                    </div>

                                </div>
                                <div class="number">
                                    (083) 554-1570 | 09335436999
                                </div>
                            </div>
                        </section>
                    </section>
                </section>
            </section>
        </div>
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