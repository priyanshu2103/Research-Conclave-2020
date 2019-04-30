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

    <title>Dashboard-Faculty</title>

    <!-- Custom fonts for this template-->
    <link href="../css/Participant/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../css/Participant/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/Participant/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">
<?php

if (isset($_POST['posterapprove']))
{
    echo $_POST['posterapprove'];
    $index =number_format($_POST['posterapprove']);
    $comment = $_POST['comment'];
    $posterid = $_POST['posterapprove'];
    $conn = new mysqli("127.0.0.1","root","","Research-Conclave");
    $posterapprovequery = mysqli_query($conn,"UPDATE PosterPresentation SET Approved=1, Remark='$comment' WHERE Posterid='$posterid'");
    echo "reviewer approved for ".$posterid;


}
if (isset($_POST['posterdisapprove']))
{
    echo $_POST['posterdisapprove'];
    $index =number_format($_POST['posterdisapprove']);
    $comment = $_POST['comment'];
    $posterid = $_POST['posterdisapprove'];
    $conn = new mysqli("127.0.0.1","root","","Research-Conclave");
    $posterdisapprovequery = mysqli_query($conn,"UPDATE PosterPresentation SET Approved=0, Remark='$comment' WHERE Posterid='$posterid'");
    echo "reviewer disapproved for ".$posterid;


}
if (isset($_POST['oralapprove']))
{
    echo $_POST['oralapprove'];
    $index =number_format($_POST['oralapprove']);
    $comment = $_POST['comment'];
    $oralid = $_POST['oralapprove'];
    $conn = new mysqli("127.0.0.1","root","","Research-Conclave");
    $oralapprovequery = mysqli_query($conn,"UPDATE OralPresentation SET Approved=1, Remark='$comment' WHERE Oralid='$oralid'");
    echo "reviewer approved for ".$oralid;


}
if (isset($_POST['oraldisapprove']))
{
    echo $_POST['oraldisapprove'];
    $index =number_format($_POST['oraldisapprove']);
    $comment = $_POST['comment'];
    $oralid = $_POST['oraldisapprove'];
    $conn = new mysqli("127.0.0.1","root","","Research-Conclave");
    $oraldisapprovequery = mysqli_query($conn,"UPDATE OralPresentation SET Approved=0, Remark='$comment' WHERE Oralid='$oralid'");
    echo "reviewer disapproved for ".$oralid;


}
?>
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="./FacultyConvenerPage.php ">
                <span>
                    <?php
                    echo $_SESSION['name'];
                    ?></span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link " href="./NewNotice.php" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Add notice</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./ApproveReviewersFaculty.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Approve reviewers</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./Home.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Reports</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./ShowNoticeFaculty.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Show Notices</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./AddReviewer.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Add Reviewer</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./Home.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Logout</span></a>
        </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

            <?php
            $conn = new mysqli("127.0.0.1","root","","Research-Conclave");
            $posterquery = mysqli_query($conn,"SELECT * FROM PosterPresentation WHERE Approved='0'");

            $posteridarray = array();
            $posterindex=0;
            while($row=mysqli_fetch_assoc($posterquery))
            {

                $posteridarray[$posterindex]=$row['Posterid'];

//                echo $posteridarray[$posterindex];
                echo '<div class="card mb-5">
                    <h5 class="card-header">';
                echo "Poster Presentation";
                echo '</h5><div class="card-body"><h5 class="card-title">';
                echo $row['AbstractTitle'];
                echo '</h5>';
                echo '<p class="card-text">';
                echo $row['AbstractDescription'];
                echo '</div><h5 class="card-header"> Reviewer1:';
                echo $row['Reviewer1'];
                echo '<br>Reviewer2:';
                echo $row['Reviewer2'];
                echo '</h5>';
                echo '<form method="post"><textarea type="text" name="comment" placeholder="comment"></textarea>
                        <button class="btn btn-danger" type="submit" name="posterdisapprove" value="';echo $posteridarray[$posterindex]; echo '">Disapprove</button>
                        <button class="btn btn-primary" type="submit"  name="posterapprove" value="';echo $posteridarray[$posterindex]; echo '">Approve</button></form></div>';
//                echo '</p><a href="#" class="btn btn-primary">File</a>
//                        </div>
//                    </div>';
                $posterindex++;
            }
            $oralquery = mysqli_query($conn,"SELECT * FROM OralPresentation WHERE Approved='0'");
            $oralidarray=array();
            $oralindex=0;
            while($row=mysqli_fetch_assoc($oralquery))
            {
                $oralidarray[$oralindex]=$row['Oralid'];

                echo '<div class="card mb-5">
                    <h5 class="card-header">';
                echo "Oral Presentation";
                echo '</h5><div class="card-body"><h5 class="card-title">';
                echo $row['AbstractTitle'];
                echo '</h5>';
                echo '<p class="card-text">';
                echo $row['AbstractDescription'];
                echo '</div><h5 class="card-header"> Reviewer1:';
                echo $row['Reviewer1'];
                echo '<br>Reviewer2:';
                echo $row['Reviewer2'];
                echo '</h5>';
                echo '<form method="post"><textarea type="text" name="comment" placeholder="comment"></textarea>
                        <button class="btn btn-danger" type="submit" name="oraldisapprove" value="';echo $oralidarray[$oralindex];echo '">Disapprove</button>
                        <button class="btn btn-primary" name="oralapprove" value="';echo $oralidarray[$oralindex];echo '">Approve</button></form></div>';
                $oralindex++;
            }



            ?>

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