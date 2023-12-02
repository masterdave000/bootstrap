<?php 

$title = "Update Category";
include './../includes/side-header.php';
$fullname = $_SESSION['fullname'];
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php
            if (filter_has_var(INPUT_GET, 'category_id')) {
                $clean_id = filter_var($_GET['category_id'], FILTER_SANITIZE_NUMBER_INT);
                $category_id = filter_var($clean_id, FILTER_VALIDATE_INT);
                
                $categoryQuery = "SELECT * from category where category_id = :category_id";
                $categoryStatement = $pdo->prepare($categoryQuery);
                $categoryStatement->bindParam(':category_id', $category_id, PDO::PARAM_INT);

                //Check whether the query is executed or not.
                $categoryStatement->execute();
                $categoryCount = $categoryStatement->rowCount();
                    
                if ($categoryCount === 1) {
                    $category = $categoryStatement->fetch(PDO::FETCH_ASSOC);
                    
                    $categoryname = $category['category_name'];
                            
                } else {
                    $_SESSION['no_category_data_found'] = "
                        <div class='msgalert alert--danger' id='alert'>
                            <div class='alert__message'>	
                                Admin Profile Data Not Found
                            </div>
                        </div>
                    ";
                    header('location:' . SITEURL . 'inspection/category/');
                }
            }
                

        ?>

        <?php
        if (isset($_SESSION['update'])) //Checking whether the session is set or not
        { //DIsplaying session message
        echo $_SESSION['update'];
        //Removing session message
        unset($_SESSION['update']);
        }

        ?>


        <?php 
            require './../includes/top-header.php';
        ?>

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
                                            <input type="text" name="category_name"
                                                class="form-control form-control-user" id="exampleInputcategoryname"
                                                aria-describedby="categorynameHelp" placeholder="Enter Category Name..."
                                                value="<?php echo $category['category_name']; ?>">
                                        </div>

                                        <input type="submit" name="submit" class="btn btn-primary btn-user btn-block"
                                            value="Edit">
                                        <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
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