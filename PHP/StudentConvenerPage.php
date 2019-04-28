<?php
error_reporting(E_ALL ^ E_NOTICE );
error_reporting(E_ERROR | E_PARSE);
//session based login system
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../css/Participant/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../css/Participant/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/Participant/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="./ParticipantPage.php">
                <span><?php
                    echo $_SESSION['name'];?></span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link " href="./NewNoticeStudentConvener.php" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Add notice</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./AssignReviewers.php">

                <i class="fas fa-fw fa-chart-area"></i>
                <span>Assign reviewers</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./Home.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Reports</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./Home.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Logout</span></a>
        </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">



        </div>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->
<!--<script src="vendor/jquery/jquery.min.js"></script>-->
<!--<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>-->
<!---->
<!-- Core plugin JavaScript-->
<!--<script src="vendor/jquery-easing/jquery.easing.min.js"></script>-->
<!---->
<!-- Page level plugin JavaScript-->
<!--<script src="vendor/chart.js/Chart.min.js"></script>-->
<!--<script src="vendor/datatables/jquery.dataTables.js"></script>-->
<!--<script src="vendor/datatables/dataTables.bootstrap4.js"></script>-->
<!---->
<!-- Custom scripts for all pages-->
<!--<script src="js/sb-admin.min.js"></script>-->
<!---->
<!-- Demo scripts for this page-->
<!--<script src="js/demo/datatables-demo.js"></script>-->
<!--<script src="js/demo/chart-area-demo.js"></script>-->

</body>

</html>