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
                
                $categoryQuery = "SELECT * from category_list where category_id = :category_id";
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

        <div class="row d-flex align-items-center justify-content-center overflow-hidden" style="height: 88vh">
            <div class="col-xl-4 col-lg-8 col-md-11 col-sm-11 p-3">
                <div class="card card-body o-hidden shadow-lg p-3 pt-5">
                    <!-- Nested Row within Card Body -->
                    <div class="d-flex flex-column col-lg-12 p-3">
                        <div class="text-center mb-4">
                            <h1 class="h4 text-gray-900"><?php echo $title?></h1>
                        </div>
                        <form action="./controller/update.php" method="POST" class="user">
                            <div class="form-group">
                                <input type="text" name="category_name"
                                    class="form-control form-control-user squared-border" id="exampleInputcategoryname"
                                    aria-describedby="categorynameHelp" placeholder="Enter Category Name..."
                                    value="<?php echo $category['category_name']; ?>" required>
                            </div>

                            <input type="hidden" name="category_id" value="<?php echo $category_id; ?>" required>
                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block"
                                value="Update">
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

<?php 
    
    require './../modals/logout.php';
    require './../includes/footer.php';
    
?>

</body>

</html>