<?php 

$title = "Update Business";
include './../includes/side-header.php';
$fullname = $_SESSION['fullname'];

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php

            if (filter_has_var(INPUT_GET, 'bus_id') && filter_has_var(INPUT_GET, 'owner_id') && filter_has_var(INPUT_GET, 'location_id')) {
                $clean_bus_id = filter_var($_GET['bus_id'], FILTER_SANITIZE_NUMBER_INT);
                $bus_id = filter_var($clean_bus_id, FILTER_VALIDATE_INT);

                $clean_owner_id = filter_var($_GET['owner_id'], FILTER_SANITIZE_NUMBER_INT);
                $owner_id = filter_var($clean_owner_id, FILTER_VALIDATE_INT);

                $clean_location_id = filter_var($_GET['location_id'], FILTER_SANITIZE_NUMBER_INT);
                $location_id = filter_var($clean_location_id, FILTER_VALIDATE_INT);
                
                $businessQuery = "SELECT bus_id, o.owner_id, l.location_id, bus_name, owner_name, bus_desc, street, purok, barangay, city, contact_no 
                FROM business b
                LEFT JOIN owner o ON o.owner_id = b.owner_id
                LEFT JOIN location l ON l.location_id = b.location_id
                WHERE bus_id = :bus_id AND o.owner_id = :owner_id AND l.location_id = :location_id
                ORDER BY bus_id";

                $businessStatement = $pdo->prepare($businessQuery);
                $businessStatement->bindParam(':bus_id', $bus_id);
                $businessStatement->bindParam(':owner_id', $owner_id);
                $businessStatement->bindParam(':location_id', $location_id);
                $businessStatement->execute();

                $businessCount = $businessStatement->rowCount();

                if ($businessCount === 1) {
                    $business = $businessStatement->fetch(PDO::FETCH_ASSOC);
                }
            }

            if (isset($_SESSION['add'])) //Checking whether the session is set or not
            {	//DIsplaying session message
                echo $_SESSION['add'];
                //Removing session message
                unset($_SESSION['add']);
            }
        ?>

        <?php require './../includes/top-header.php'?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800"><?php echo $title?></h1>

        </div>


        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-4 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><?php echo $title?></h1>
                                    </div>
                                    <form action="./controller/update.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="text" name="owner_name" class="form-control form-control-user"
                                                id="exampleInputownername" aria-describedby="ownernameHelp"
                                                placeholder="Enter Owner Name..."
                                                value="<?php echo $business['owner_name'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="business_name"
                                                class="form-control form-control-user" id="exampleInputbusinessname"
                                                aria-describedby="businessnameHelp" placeholder="Enter Business Name..."
                                                value="<?php echo $business['bus_name'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="business_desc"
                                                class="form-control form-control-user"
                                                id="exampleInputbusinessdescription"
                                                aria-describedby="businessdescriptionHelp"
                                                placeholder="Enter Business Description..."
                                                value="<?php echo $business['bus_desc'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="street" class="form-control form-control-user"
                                                id="exampleInputstreet" aria-describedby="streetHelp"
                                                placeholder="Enter Street Name..."
                                                value="<?php echo $business['street'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="purok" class="form-control form-control-user"
                                                id="exampleInputpurok" aria-describedby="purokHelp"
                                                placeholder="Enter Purok Name..."
                                                value="<?php echo $business['purok'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="barangay" class="form-control form-control-user"
                                                id="exampleInputbarangay" aria-describedby="barangayHelp"
                                                placeholder="Enter Barangay Name..."
                                                value="<?php echo $business['barangay'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="city" class="form-control form-control-user"
                                                id="exampleInputcity" aria-describedby="cityHelp"
                                                placeholder="Enter City Name..."
                                                value="<?php echo $business['city'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <input type="number" name="contact_number"
                                                class="form-control form-control-user" id="exampleInputcontactno"
                                                aria-describedby="contactnoHelp" placeholder="Enter Contact Number..."
                                                maxlength="11" value="<?php echo $business['contact_no'] ?>">
                                        </div>

                                        <input type="submit" name="submit" class="btn btn-primary btn-user btn-block"
                                            value="Edit">
                                        <input type="hidden" name="bus_id" value="<?php echo $business['bus_id']; ?>">
                                        <input type="hidden" name="owner_id"
                                            value="<?php echo $business['owner_id']; ?>">
                                        <input type="hidden" name="location_id"
                                            value="<?php echo $business['location_id']; ?>">
                                    </form>
                                </div>
                            </div>
                        </div>
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
    
    require './../modals/logout.php';
    require './../includes/footer.php';
    
    ?>
</body>

</html>