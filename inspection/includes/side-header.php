<?php
require __DIR__ . "/../../config/constants.php";
require __DIR__ . "/../../login-check.php";

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$user_inspector_id = $_SESSION['inspector_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title ?></title>

    <!-- Custom fonts for this template-->
    <link rel="icon" type="image/x-icon" href="<?php echo SITEURL ?>assets/img/lgu_logo.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo SITEURL ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>assets/css/sb-admin-2.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <?php if ($title === 'Equipment List Certificate') : ?>
        <link href="../../assets/css/equipment-print.css" rel="stylesheet" media="print">
    <?php endif ?>

    <?php if ($title === 'Annual Certificate') : ?>
        <link href="../../assets/css/certificate-print.css" rel="stylesheet" media="print">
    <?php endif ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-sidebar-primary sidebar sidebar-dark accordion d-print-none" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo SITEURL; ?>inspection/dashboard/">
                <div class="sidebar-brand-icon rotate-n-15" style="width: 50px; height: 50px">
                    <img style="width: 100%; height: 100%" src="<?php echo SITEURL ?>assets/img/lgu_logo.png">
                </div>
                <div class="sidebar-brand-text mx-3">OBOS</div>
            </a>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo SITEURL; ?>inspection/dashboard/">
                    <i class="fas fa-fw fa-chart-line"></i>
                    <span>Dashboard</span></a>
            </li>

            <?php if ($role === 'Administrator') : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITEURL ?>inspection/category/">
                        <i class="fa-solid fa-layer-group"></i>
                        <span>Category</span></a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITEURL ?>inspection/item/">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    <span>Item</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITEURL ?>inspection/inspection/">
                    <i class="fas fa-fw fa-check-square"></i>
                    <span>Inspection</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITEURL ?>inspection/certificate/">
                    <i class="fas fa-fw fa-file-medical"></i>
                    <span>Certificate</span></a>
            </li>


            <?php if ($role === 'Administrator') : ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITEURL ?>inspection/business/">
                        <i class="fas fa-fw fa-business-time"></i>
                        <span>Business</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITEURL ?>inspection/owner/">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Owner</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITEURL ?>inspection/inspector/">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Inspector</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITEURL ?>inspection/billing/">
                        <i class="fa fa-credit-card-alt"></i>
                        <span>Billing</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITEURL ?>inspection/schedule/">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>Schedule</span></a>
                </li>

            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITEURL ?>inspection/violation/">
                    <i class="fa-solid fa-fw fa-triangle-exclamation"></i>
                    <span>Violation</span></a>
            </li>

            <?php if ($role === 'Administrator') : ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITEURL ?>inspection/user/">
                        <i class="fas fa-fw fa-circle-user"></i>
                        <span>User</span></a>
                </li>

            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->