<!-- Bootstrap core JavaScript-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="<?php echo SITEURL ?>assets/js/main.js"></script>
<script src="<?php echo SITEURL ?>assets/js/sb-admin-2.js"></script>


<?php
if ($title === 'Dashboard') :?>
<!-- Page level plugins -->
<script src="<?php echo SITEURL ?>vendor/chart.js/Chart.min.js"></script>
<!-- Page level custom scripts -->
<script src="<?php echo SITEURL ?>assets/js/demo/chart-area-demo.js"></script>
<script src="<?php echo SITEURL ?>assets/js/demo/chart-pie-demo.js"></script>

<?php elseif ($title === 'Manage User'): ?>

<!-- Page level plugins -->
<script src="<?php echo SITEURL ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!--Page level custom scripts -->
<script src="<?php echo SITEURL ?>asets/js/demo/datatables-demo.js"></script>



<?php endif;?>