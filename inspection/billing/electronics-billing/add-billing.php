<?php

$title = "Add Electronics Billing";
include './../../includes/side-header.php';

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php

        if (isset($_SESSION['add'])) //Checking whether the session is set or not
        {    //DIsplaying session message
            echo $_SESSION['add'];
            //Removing session message
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['duplicate'])) //Checking whether the session is set or not
        {    //DIsplaying session message
            echo $_SESSION['duplicate'];
            //Removing session message
            unset($_SESSION['duplicate']);
        }
        ?>

        <?php require './../../includes/top-header.php' ?>

        <!-- Outer Row -->
        <div class="row d-flex align-items-center justify-content-center overflow-hidden" style="height: 90%;">
            <div class="col-xl-6 col-lg-8 col-md-11 col-sm-11 p-3">
                <div class="card card-body o-hidden shadow-lg p-4">
                    <!-- Nested Row within Card Body -->
                    <div class="d-flex flex-column justify-content-center col-lg-12">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $title ?></h1>
                        </div>
                        <form action="./controller/create.php" method="POST" class="user" enctype="multipart/form-data">

                            <div class="form-group d-flex flex-column flex-md-grow-1">
                                <label for="section">Section<span class="text-danger">*</span>
                                </label>
                                <div class="d-flex align-items-center justify-content-center select-container">
                                    <select name="section" class="form-control form-select px-3">
                                        <option selected disabled hidden value="">Select</option>
                                        <option value="Central Office switching equipment, remote switching units, etc.">Central Office switching equipment, remote switching units, etc.</option>
                                        <option value="Broadcast Station for Radion and TV">Broadcast Station for Radion and TV</option>
                                        <option value="Automated Teller Machines, Ticketing,Vending, etc.">Automated Teller Machines, Ticketing,Vending, etc.</option>
                                        <option value="ELectronics and Communications Outlets, etc.">ELectronics and Communications Outlets, etc.</option>
                                        <option value="Station/Terminal/Control, etc.">Station/Terminal/Control, etc.</option>
                                        <option value="Studios, Auditoriums, Theaters, etc.">Studios, Auditoriums, Theaters, etc.</option>
                                        <option value="Antenna Towers/Masts or Other Structures for Installation">Antenna Towers/Masts or Other Structures for Installation</option>
                                        <option value="Electronic or Electronically-COntrolled Indoors and Outdoor Signages">Electronic or Electronically-COntrolled Indoors and Outdoor Signages</option>
                                        <option value="Poles and Attachment">Poles and Attachment</option>
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for="fee">Fee <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>

                                    <input type="number" name="fee" class="form-control p-4" id="fee" placeholder="Enter Fee..." step="0.01" value="0.00" min="0.00" required>
                                </div>
                            </div>

                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block mt-3" value="Add">
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

<?php require './../../includes/footer.php'; ?>
</body>

</html>