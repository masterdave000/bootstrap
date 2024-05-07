<?php

$title = "Add Building Billing";
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

                            <div class="col col-12 p-0 form-group">
                                <label for="building-category">Category <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="building_category" class="form-control p-4" id="building-category" value="Buidling" required readonly>
                            </div>

                            <div class="form-group d-flex flex-column flex-md-grow-1">
                                <label for="section">Section<span class="text-danger">*</span>
                                </label>
                                <div class="d-flex align-items-center justify-content-center select-container">
                                    <select name="section" class="form-control form-select px-3">
                                        <option selected disabled hidden value="">Select</option>
                                        <option value="Division A-1">Division A-1</option>
                                        <option value="Division A-2">Division A-2</option>
                                        <option value="Division B-1">Division B-1</option>
                                        <option value="Division D-1">Division D-1</option>
                                        <option value="Division D-2">Division D-2</option>
                                        <option value="Division D-3">Division D-3</option>
                                        <option value="Division E-1">Division E-1</option>
                                        <option value="Division E-2">Division E-2</option>
                                        <option value="Division E-3">Division E-3</option>
                                        <option value="Division F-1">Division F-1</option>
                                        <option value="Division G-1">Division G-1</option>
                                        <option value="Division G-2">Division G-2</option>
                                        <option value="Division G-3">Division G-3</option>
                                        <option value="Division G-4">Division G-4</option>
                                        <option value="Division G-5">Division G-5</option>
                                        <option value="Division H-1">Division H-1</option>
                                        <option value="Division H-2">Division H-2</option>
                                        <option value="Division H-3">Division H-3</option>
                                        <option value="Division H-4">Division H-4</option>
                                        <option value="I-1">I-1</option>
                                        <option value="Commercial">Commercial</option>
                                        <option value="Industrial Institutional Building">Industrial Institutional Building</option>
                                        <option value="Appendages">Appendages</option>
                                        <option value="First Class Cinematographs or Theaters">First Class Cinematographs or Theaters</option>
                                        <option value="Second Class Cinematographs or Theaters">Second Class Cinematographs or Theaters</option>
                                        <option value="Third Class Cinematographs or Theaters">Third Class Cinematographs or Theaters</option>
                                        <option value="Grandstands/Bleachers">Grandstands/Bleachers</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col col-12 p-0 form-group">
                                <label for="property-attribute">Property Attribute <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="property_attribute" class="form-control p-4" id="property-attribute" placeholder="Enter Capacity..." required>
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