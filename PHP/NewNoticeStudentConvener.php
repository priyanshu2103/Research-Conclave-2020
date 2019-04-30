<?php
error_reporting(E_ALL ^ E_NOTICE );
error_reporting(E_ERROR | E_PARSE);
//session based login system
session_start();
?>

<?php
if(!isset($_SESSION['logged_in']))
    header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add notice</title>

    <!-- Custom fonts for this template-->
    <link href="../css/Participant/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/AddNotice/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/AddNotice/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="../css/AddNotice/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="../css/AddNotice/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="../css/AddNotice/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../css/AddNotice/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="../css/AddNotice/css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/AddNotice/css/main.css">

    <!-- Page level plugin CSS-->
    <link href="../css/Participant/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/Participant/sb-admin.css" rel="stylesheet">

</head>

<?php

if(isset($_POST['notice-add-btn']))
{
    $title = $_POST['title'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $date = date("Y-m-d");
    $submitted_by = $_SESSION['usertype'];

    $conn = mysqli_connect("127.0.0.1","root","","Research-Conclave");
    $sql1 = "INSERT INTO Notice (Noticeid,Title,Description,Date,SubmittedBy,Type) VALUES (DEFAULT ,'$title','$description','$date','$submitted_by','$type')";
    if($conn->query($sql1)===TRUE) {
        $message = "Notice successfully added";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header("location:./FacultyConvenerPage.php");
//        <script type="text/javascript">
//        alert("Notice successfully added");
//        location="./FacultyConvenerPage.php";
//        </script>
    }
    mysqli_close($conn);
}

?>

<body id="page-top">

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="./AssignReviewers.php">
                <span>Back</span>
            </a>
        </li>
        <!--        <li class="nav-item dropdown">-->
        <!--            <a class="nav-link " href="./ParticipantApplyEvent.php" >-->
        <!--                <i class="fas fa-fw fa-folder"></i>-->
        <!--                <span>Add notice</span>-->
        <!--            </a>-->
        <!--        </li>-->
        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link" href="./MySubmissionsParticipant.php">-->
        <!--                <i class="fas fa-fw fa-chart-area"></i>-->
        <!--                <span>Approve reviewers</span></a>-->
        <!--        </li>-->
        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link" href="./Home.php">-->
        <!--                <i class="fas fa-fw fa-table"></i>-->
        <!--                <span>Reports</span></a>-->
        <!--        </li>-->
        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link" href="./Home.php">-->
        <!--                <i class="fas fa-fw fa-table"></i>-->
        <!--                <span>Logout</span></a>-->
        <!--        </li>-->
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

            <div class="container-contact100">
                <div class="wrap-contact100">
                    <form class="contact100-form validate-form" method="post" action="./NewNotice.php">
				<span class="contact100-form-title">
					Add Notice!
				</span>

                        <div class="wrap-input100 validate-input" data-validate="Name is required">
                            <span class="label-input100">Title</span>
                            <input class="input100" type="text" name="title" placeholder="Enter notice title here" required>
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100 input100-select">
                            <span class="label-input100">Event Type</span>
                            <div>
                                <select class="selection-2" name="type" datatype="text">
                                    <option>Poster Presentation</option>
                                    <option>Oral Presentation</option>
                                </select>
                            </div>
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate = "Message is required">
                            <span class="label-input100">Description</span>
                            <textarea class="input100" name="description" placeholder="Event Description here..." required></textarea>
                            <span class="focus-input100"></span>
                        </div>

                        <div class="container-contact100-form-btn">
                            <div class="wrap-contact100-form-btn">
                                <div class="contact100-form-bgbtn"></div>
                                <button class="contact100-form-btn" type="submit" name="notice-add-btn">
							<span>
								Submit
								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
							</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="dropDownSelect1"></div>


        </div>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!--===============================================================================================-->
<script src="../css/AddNotice/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="../css/AddNotice/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="../css/AddNotice/vendor/bootstrap/js/popper.js"></script>
<script src="../css/AddNotice/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="../css/AddNotice/vendor/select2/select2.min.js"></script>
<script>
    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
</script>
<!--===============================================================================================-->
<script src="../css/AddNotice/vendor/daterangepicker/moment.min.js"></script>
<script src="../css/AddNotice/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="../css/AddNotice/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="../css/AddNotice/js/main.js"></script>



</body>

</html>