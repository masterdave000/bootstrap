<?php 

$title = "Add Category";
include './../includes/side-header.php';
$fullname = $_SESSION['fullname'];

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php
        
            if (isset($_SESSION['add'])) //Checking whether the session is set or not
            {	//DIsplaying session message
                echo $_SESSION['add'];
                //Removing session message
                unset($_SESSION['add']);
            }
        ?>

        <?php require './../includes/top-header.php'?>

        <div class="row d-flex align-items-center justify-content-center overflow-hidden" style="height: 88vh">
            <div class="col-xl-4 col-lg-8 col-md-11 col-sm-11 p-3">
                <div class="card card-body o-hidden shadow-lg p-3 pt-5">
                    <!-- Nested Row within Card Body -->
                    <div class="d-flex flex-column col-lg-12 p-3">
                        <div class="text-center mb-4">
                            <h1 class="h4 text-gray-900"><?php echo $title?></h1>
                        </div>
                        <form action="./controller/create.php" method="POST" class="user">
                            <div class="form-group">
                                <input type="text" name="category_name"
                                    class="form-control form-control-user squared-border" id="exampleInputcategoryname"
                                    aria-describedby="categorynameHelp" placeholder="Enter Category Name...">
                            </div>

                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Add">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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