<!-- Bootstrap core JavaScript-->
<script src="<?php echo SITEURL ?>assets/js/main.js"></script>
<script src="<?php echo SITEURL ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo SITEURL ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="<?php echo SITEURL ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="<?php echo SITEURL ?>assets/js/sb-admin-2.min.js"></script>
<script src="<?php echo SITEURL ?>assets/js/sb-admin-2.js"></script>


<?php
if ($title === 'Dashboard') :?>
<!-- Page level plugins -->
<script src="<?php echo SITEURL ?>vendor/chart.js/Chart.min.js"></script>
<!-- Page level custom scripts -->
<script src="<?php echo SITEURL ?>assets/js/demo/chart-area-demo.js"></script>
<script src="<?php echo SITEURL ?>assets/js/demo/chart-pie-demo.js"></script>

<?php elseif ($title === 'Manage Admin'): ?>

<!-- Page level plugins -->
<script src="<?php echo SITEURL ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!--Page level custom scripts -->
<script src="<?php echo SITEURL ?>asets/js/demo/datatables-demo.js"></script>

<?php endif;?>










?>