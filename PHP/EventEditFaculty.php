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

    <title>Dashboard-Faculty</title>

    <!-- Custom fonts for this template-->
    <link href="../css/Participant/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../css/Participant/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/Participant/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body id="page-top">

<?php
    $conn = mysqli_connect("127.0.0.1","root","","Research-Conclave");
    $query1 = mysqli_query($conn,"SELECT * FROM Event WHERE Type ='Poster Presentation'");
    $row1 = mysqli_fetch_assoc($query1);

    $start_date_poster = $row1['StartDate'];
    $end_date_poster = $row1['EndDate'];

    $query2 = mysqli_query($conn,"SELECT * FROM Event WHERE Type ='Oral Presentation' ");
    $row2 = mysqli_fetch_assoc($query2);

    $start_date_oral = $row2['StartDate'];
    $end_date_oral = $row2['EndDate'];

    ?>
<?php


if(isset($_POST['btn-change-date-poster']))
{
    $flag=2;
    $newStartPoster = $_POST['posterStart'];
    $newEndPoster = $_POST['posterEnd'];

    if($newStartPoster===''&&$newEndPoster==='')
    {
        $flag=1;
    }
    else
    {
        $sql1 = "UPDATE Event SET StartDate='$newStartPoster', EndDate='$newEndPoster' WHERE Type='Poster Presentation'";
        if($conn->query($sql1)===TRUE)
        {
            echo '<script language="javascript">';
            echo 'alert("Event Date Successfully changed")';
            echo '</script>';
            header("location:./EventEditFaculty.php");
        }
    }
}

if(isset($_POST['btn-change-date-oral']))
{
    $flag=2;
    $newStartOral = $_POST['oralStart'];
    $newEndOral = $_POST['oralEnd'];

    if($newStartOral===''&&$newEndOral==='')
    {
        $flag=1;
    }
    else
    {
        $sql2 = "UPDATE Event SET StartDate='$newStartOral', EndDate='$newEndOral' WHERE Type='Oral Presentation'";
        if($conn->query($sql2)===TRUE)
        {
            echo '<script language="javascript">';
            echo 'alert("Event Date Successfully changed")';
            echo '</script>';
            header("location:./EventEditFaculty.php");
        }
    }
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
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" href="./Home.php">-->
<!--                <i class="fas fa-fw fa-table"></i>-->
<!--                <span>Reports</span></a>-->
<!--        </li>-->
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
            <a class="nav-link" href="./EventEditFaculty.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Edit event date</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./logout.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Logout</span></a>
        </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

            <h2>Poster Presentation</h2><br>
            <h4>Current Start Date: <?php echo $start_date_poster; ?></h4>
            <h4>Current End Date  : <?php echo $end_date_poster; ?></h4><br>
            <form method="POST">

                <div class="form-group" style="width: 30%">
                    <label for="exampleInputPassword1">Choose New Start Date</label>
                    <input type="date" name="posterStart" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="form-group" style="width: 30%">
                    <label for="exampleInputPassword1">Choose New End Date</label>
                    <input type="date" name = "posterEnd" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary" name="btn-change-date-poster">Change Dates</button>
            </form>

            <hr>

            <h2 style="margin-top: 20px">Oral Presentation</h2><br>
            <h4>Current Start Date: <?php echo $start_date_oral; ?></h4>
            <h4>Current End Date  : <?php echo $end_date_oral; ?></h4><br>
            <form method="POST">

                <div class="form-group" style="width: 30%">
                    <label for="exampleInputPassword1">Choose New Start Date</label>
                    <input type="date" name = "oralStart" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="form-group" style="width: 30%">
                    <label for="exampleInputPassword1">Choose New End Date</label>
                    <input type="date" name = "oralEnd"  class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary" name="btn-change-date-oral">Change Dates</button>
            </form>

            <div>
                <?php
                if($flag==1){
                    echo '<script language="javascript">';
                    echo 'alert("No field must be empty, date was not changed")';
                    echo '</script>';
                }
                ?>
            </div>

        </div>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


</body>

</html>