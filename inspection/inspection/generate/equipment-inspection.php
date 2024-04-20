<?php 

    $title = "Equipment List Certificate";
    include './../../includes/side-header.php';

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
                                    <p class="owner-name">Matthew Joseph F. Bilaos</p>
                                    <p>Name of Owner (Signature over Printed Name)</p>
                                </div>
                                <p>Date: <u>01-12-2023</u></p>
                            </div>
                            <div class="d-flex justify-content-between m-0">
                                <p class="m-0">Autorized Reresentative: </p>
                                <span class="underline"></span>
                                <p class="m-0">Contact No: <u>09166111422</u></p>
                            </div>
                            <div class="d-flex justify-content-between m-0">
                                <p class="m-0">Name of Business: </p>
                                <span class="underline"></span>
                            </div>

                            <div class="d-flex justify-content-between m-0">
                                <p class="m-0">Type of Business: </p>
                                <span class="underline"></span>
                            </div>

                            <div class="d-flex justify-content-between m-0">
                                <p class="m-0">Business Address: </p>
                                <span class="underline"></span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <p class="m-0">Application Type: </p>
                                <span class="underline"></span>
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
                                <tr>
                                    <td class="text-right px-2"><b>TOTAL</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
                                    <span class="underline">
                                    </span> <span>m<sup>2</sup> </span>
                                </div>

                                <div class="d-flex flex-column align-items-center m-0 mb-2">
                                    <div class="d-flex justify-content-between w-100">
                                        <p class="m-0">Sinage Area: </p>
                                        <span class="underline"></span>
                                        <span>m<sup>2</sup> </span>
                                    </div>
                                    <div>(Painted/Lighted)</div>

                                </div>

                                <div class="w-50 d-flex flex-column align-items-end other-fee">
                                    <div>Building Fee =</div>
                                    <div>Plumbing/Sanitary Fee =</div>
                                    <div>Signage Fee =</div>
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