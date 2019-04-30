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

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../css/Participant/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../css/Participant/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/Participant/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

</nav>

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="./FacultyConvenerPage.php">
                <span>Back</span>
            </a>
        </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

            <section class="feature-area section-padding2" style="padding: 0px 0px 0px">
                <div class="jumbotron">
                    <h1 style="text-align: center">Notices</h1>
                </div>
                <div class="container">
                    <div class="row">

                        <?php
                        $conn = mysqli_connect("127.0.0.1","root","","Research-Conclave");
                        $query = mysqli_query($conn,"SELECT * FROM Notice");
                        $numrows = mysqli_num_rows($query);

                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<div class=\"col-lg-4\">
                <div class=\"single-feature mb-4 mb-lg-0\"> <h3>" . $row['Title'] . "</h3>" .
                                "<h4 style='padding-top: 10px'>" . $row['SubmittedBy'] . "</h4>" .
                                "<h4>" . $row['Date'] . "</h4>" .
                                "<p class=\"py-3\">" . $row['Description'] . "</p>" .
                                "
                    </div>
                </div>";
                        }
                        ?>
                    </div>

            </section>


        </div>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<!--<script src="vendor/jquery/jquery.min.js"></script>-->
<!--<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>-->

<!-- Core plugin JavaScript-->
<!--<script src="vendor/jquery-easing/jquery.easing.min.js"></script>-->

<!-- Page level plugin JavaScript-->
<!--<script src="vendor/chart.js/Chart.min.js"></script>-->
<!--<script src="vendor/datatables/jquery.dataTables.js"></script>-->
<!--<script src="vendor/datatables/dataTables.bootstrap4.js"></script>-->

<!-- Custom scripts for all pages-->
<!--<script src="js/sb-admin.min.js"></script>-->

<!-- Demo scripts for this page-->
<!--<script src="js/demo/datatables-demo.js"></script>-->
<!--<script src="js/demo/chart-area-demo.js"></script>-->

<script src="../js/ShowNotice/vendor/jquery-2.2.4.min.js"></script>
<script src="../js/ShowNotice/vendor/bootstrap-4.1.3.min.js"></script>
<script src="../js/ShowNotice/vendor/wow.min.js"></script>
<script src="../js/ShowNotice/vendor/owl-carousel.min.js"></script>
<script src="../js/ShowNotice/vendor/jquery.nice-select.min.js"></script>
<script src="../js/ShowNotice/vendor/ion.rangeSlider.js"></script>
<script src="../js/ShowNotice/main.js"></script>

</body>

</html>