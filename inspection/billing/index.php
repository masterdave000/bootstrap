<?php

$title = "Business List";
require "./../includes/side-header.php";

?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">

        <?php require './../includes/top-header.php' ?>

        <div class="container-fluid mt-4">
            <!-- Page Heading -->

            <!-- DataTales Example -->
            <div class="billing-container d-flex justify-content-center align-items-center flex-gap">
                <div class="billing-link-container d-flex justify-content-center align-items-center card shadow pointer-event">
                    <a href="./equipment-billing/" class="text-decoration-none text-dark">Equipment Billing
                    </a>
                </div>

                <div class="billing-link-container d-flex justify-content-center align-items-center card shadow pointer-event">
                    <a href="./building-billing/" class="text-decoration-none text-dark">Building Billing</a>
                </div>

                <div class="billing-link-container d-flex justify-content-center align-items-center card shadow pointer-event">
                    <a href="./signage-billing/" class="text-decoration-none text-dark">Signage Billing</a>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
require './../includes/footer.php';
?>

</body>

</html>