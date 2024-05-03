<?php 

$title = "Certificate List";
require "./../includes/side-header.php";

?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">

        <?php require './../includes/top-header.php'?>

        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <div class="card shadow mb-4">
                <div class="d-flex align-items-center justify-content-between card-header h-75">
                    <h1 class="h3 text-gray-800 mt-2"><?php echo $title ?></h1>
                    <a href="./add-certificate.php"
                        class="btn btn-primary d-flex justify-content-center align-items-center">
                        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                        <span class="d-none d-lg-inline">Issue</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="obosTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="d-flex justify-content-between border-bottom">
                                    <th>
                                        Business
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php 
                                    $certificateQuery = "SELECT DISTINCT certificate_id, bus_name, bus_img_url, date_inspected FROM annual_inspection_certificate_view ORDER BY certificate_id DESC";
                                    $certificateStatement = $pdo->query($certificateQuery);
                                    $certificates = $certificateStatement->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                <?php 
                            
                                    foreach ($certificates as $certificate) :
                                ?>


                                <tr class="d-flex justify-content-between align-items-center border-bottom py-1">
                                    <td class="p-0 m-0">
                                        <a href="./view-certificate.php?certificate_id=<?php echo $certificate['certificate_id']?>"
                                            class="d-flex flex-row align-items-center justify-content-center text-decoration-none
                                text-gray-700 flex-gap">
                                            <div class="image-container img-fluid">
                                                <img src="./../business/images/<?php echo $certificate['bus_img_url'] ?? 'no-image.png'?>"
                                                    alt="inspector-image" class="img-fluid rounded-circle" />
                                            </div>

                                            <div>
                                                <div class="text">
                                                    <?php echo $certificate['bus_name']?>
                                                </div>
                                                <div class="sub-title d-none d-md-flex">Date Inspected:
                                                    <?php echo $certificate['date_inspected']?></div>

                                            </div>
                                        </a>
                                    </td>
                                </tr>

                                <?php
                                   
                                    endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
        
    if (isset($_SESSION['add'])) { //Checking whether the session is set or not
	//DIsplaying session message
        echo $_SESSION['add'];
        //Removing session message
        unset($_SESSION['add']);
    }

?>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php 
require './../includes/footer.php';
?>

</body>

</html>