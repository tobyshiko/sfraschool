<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/img/apple-icon.png');?>">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Special Forces Regiment (Airbone) : School</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/css/light-bootstrap-dashboard.css?v=2.0.0');?> " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?php echo base_url('assets/css/demo.css');?>" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php';?>
        <div class="main-panel">
            <!-- Navbar -->
            <?php include 'headernavbar.php';?>
            <!-- End Navbar -->
            <div class="content">
                <?php include $user_role.'/'.$page_name.'.php';?>
            </div>
            <!-- Footer -->
            <?php include 'footer.php';?>
            <!-- End Footer -->
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/core/jquery.3.2.1.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/core/popper.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/core/bootstrap.min.js');?>" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="<?php echo base_url('assets/js/plugins/bootstrap-switch.js');?>"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/bootstrap-notify.js');?>"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js?v=2.0.0');?>" type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url('assets/js/demo.js');?>"></script>

</html>
