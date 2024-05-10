<?php

$title = "Update Business";
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

        if (isset($_SESSION['update'])) //Checking whether the session is set or not
        {    //DIsplaying session message
            echo $_SESSION['update'];
            //Removing session message
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['duplicate'])) //Checking whether the session is set or not
        {    //DIsplaying session message
            echo $_SESSION['duplicate'];
            //Removing session message
            unset($_SESSION['duplicate']);
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
                        <form action="./controller/update.php" method="POST" class="user" enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center">
                                <div class="image-container mb-3">
                                    <img src="./images/<?php echo $business['bus_img_url'] ?>" alt="default-bus-image" class="img-fluid rounded-circle" />
                                </div>

                                <p class="h3 text-gray-900 mb-4 "><?php echo $business['bus_name'] ?></p>

                                <div class="form-group d-flex flex-column align-items-center w-100">
                                    <input type="file" name="bus_img" id="bus-img" class="border w-75" accept="image/JPEG, image/JPG, image/PNG" />

                                    <input type="hidden" name="current_bus_img" value="<?php echo $business['bus_img_url'] ?>">
                                    <?php
                                    if (isset($_SESSION['error'])) {
                                        echo "<small class='text-danger text-center'>" . $_SESSION['error'] . "</small>";
                                        unset($_SESSION['error']); // clear the error message from the session
                                    }
                                    ?>

                                    <div class="text-danger text-center">
                                        <small>
                                            <i>Note: The maximum file size allowed is 1MB. <br>
                                                Only JPEG, JPG, and PNG formats are accepted.
                                            </i>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group d-flex flex-column">
                                    <label for="owner-name">Owner Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="d-flex align-items-center justify-content-center select-container">
                                        <select name="owner_name" id="owner-name" class="form-control form-select px-3" required>

                                            <option selected value="<?php echo $business['owner_id'] ?>">
                                                <?php echo $fullname ?>
                                            </option>
                                            <?php

                                            $ownerQuery = "SELECT owner.owner_id, owner_firstname, owner_midname, owner_lastname, owner_suffix 
                                                FROM owner LEFT JOIN business ON owner.owner_id = business.owner_id WHERE business.owner_id IS NULL";
                                            $ownerStatement = $pdo->query($ownerQuery);
                                            $owners = $ownerStatement->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($owners as $owner) {
                                                $firstname = htmlspecialchars(ucwords($owner['owner_firstname']));
                                                $midname = htmlspecialchars(ucwords($owner['owner_midname'] ? mb_substr($owner['owner_midname'], 0, 1, 'UTF-8') . "." : ""));
                                                $lastname = htmlspecialchars(ucwords($owner['owner_lastname']));
                                                $suffix = htmlspecialchars(ucwords($owner['owner_suffix']));
                                                $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);

                                            ?>

                                                <option value="<?php echo $owner['owner_id'] ?>">
                                                    <?php echo $fullname ?>
                                                </option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="bus-name">Business Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="bus_name" class="form-control p-4" id="bus-name" aria-describedby="businessnameHelp" placeholder="Enter Business Name..." value="<?php echo $business['bus_name'] ?>" required>
                                </div>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for=" bus-address">Address <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="bus_address" class="form-control p-4" id="bus-address" aria-describedby="businessaddressHelp" placeholder="Enter Business Address..." value="<?php echo $business['bus_address'] ?>" required>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-between">
                                <div class="form-group d-flex flex-column flex-md-grow-1">
                                    <label for="bus-type">Business Type <span class="text-danger">*</span>
                                    </label>
                                    <div class="d-flex align-items-center justify-content-center select-container">
                                        <select name="bus_type" id="bus-type" class="form-control form-select px-3">
                                            <option selected hidden value="<?php echo $business['bus_type'] ?>">
                                                <?php echo $business['bus_type'] ?></option>
                                            <option value="Retail">Retail</option>
                                            <option value="Food and Beverage">RetailFood and Beverage</option>
                                            <option value="Services">Services</option>
                                            <option value="Healthcare">Healthcare</option>
                                            <option value="Construction and Real Estate">Construction and Real
                                                Estate
                                            </option>
                                            <option value="Manufacturing">Manufacturing</option>
                                            <option value="Financial Services">Financial Services</option>
                                            <option value="Transportation and Logistics">Transportation and
                                                Logistics
                                            </option>
                                            <option value="Education">Education</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group flex-md-grow-1 d-none">
                                    <label for="other-bus-type">Other <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="other_bus_type" id="other-bus-type" class="form-control p-4" aria-describedby="businesstypeHelp" placeholder="Enter Other Business Type...">
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-between">
                                <div class="form-group d-flex flex-column flex-md-grow-1">
                                    <label for="bus-group">Business Group <span class="text-danger">*</span>
                                    </label>
                                    <div class="d-flex align-items-center justify-content-center select-container">
                                        <select name="bus_group" id="bus-group" class="form-control form-select px-3" required>
                                            <option selected hidden value="<?= $business['bus_group'] ?>"><?= $business['bus_group'] ?></option>
                                            <option value="Group A">Group A</option>
                                            <option value="Group B">Group B</option>
                                            <option value="Group C">Group C</option>
                                            <option value="Group D">Group D</option>
                                            <option value="Group E">Group E</option>
                                            <option value="Group F">Group F</option>
                                            <option value="Group G">Group G</option>
                                            <option value="Group H">Group H</option>
                                            <option value="Group I">Group I</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-between">
                                <div class="form-group d-flex flex-column flex-md-grow-1">
                                    <label for="character-of-occupancy">Character of Occupancy <span class="text-danger">*</span>
                                    </label>
                                    <div class="d-flex align-items-center justify-content-center select-container">
                                        <select name="character_of_occupancy" id="character-of-occupancy" class="form-control form-select px-3" required>
                                            <option selected hidden value="<?= $business['character_of_occupancy'] ?>"><?= $business['character_of_occupancy'] ?></option>
                                            <option value="Residential Dwellings">
                                                Residential Dwellings
                                            </option>
                                            <option value="Residentials, Hotels, and Apartments">
                                                Residentials, Hotels, and Apartments
                                            </option>
                                            <option value="Education and Recreation">
                                                Education and Recreation
                                            </option>
                                            <option value="Institutional">Institutional</option>
                                            <option value="Business and Mercantile">Business and Mercantile</option>
                                            <option value="Industrial">Industrial</option>
                                            <option value="Storage and Hazardous">Storage and Hazardous</option>
                                            <option value="Assembly Other Than Group I">Assembly Other Than Group I</option>
                                            <option value="Assembly Occupant Load 1000 or More">Assembly Occupant Load 1000 or More</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="contact-number">Contact Number <span class="text-danger">*</span> <small class="font-italic">(i.e. 09433637223)</small>
                                    </label>
                                    <input type="text" name="contact_number" class="form-control p-4" id="contact-number" aria-describedby="contactnoHelp" placeholder="Enter Contact Number..." maxlength="11" pattern="^(09)\d{9}$" oninvalid="this.setCustomValidity('Characters are not allowed. 11 digit numnber starting with 09')" onchange="try{setCustomValidity('')}catch(e){}" oninput="setCustomValidity(' ')" value="<?php echo $business['bus_contact_number'] ?>" required>
                                </div>

                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="email">Email <span class="text-danger">*</span> <small class="font-italic">(i.e. sample@gmail.com)</small>
                                    </label>
                                    <input type="email" name="email" class="form-control p-4" id="email" aria-describedby="contactnoHelp" placeholder="Enter Contact Number..." pattern="[A-Za-z0-9-._]+@[A-Za-z0-9.-_]+\.[a-zA-Z]{2,}" value="<?php echo $business['email'] ?>">
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center justify-content-center flex-gap">
                                <div class="col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="floor-area">Floor Area <span class="text-danger">*</span> </label>
                                    <input type="number" name="floor_area" class="form-control p-4" id="floor-area" aria-describedby="floorareaHelp" placeholder="Enter Floor Area..." step="0.1" value="<?php echo $business['floor_area'] ?>">
                                </div>

                                <div class=" col col-md-6 p-1 form-group flex-md-grow-1">
                                    <label for="signage-area">Signage Area <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="signage_area" class="form-control p-4" id="signage-area" aria-describedby="signageareaHelp" placeholder="Enter Signage Area..." step="0.1" value="<?php echo $business['signage_area'] ?>">
                                </div>
                            </div>

                            <input type="hidden" name="bus_id" value="<?php echo $business['bus_id'] ?>">
                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block mt-3" value="Edit">
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