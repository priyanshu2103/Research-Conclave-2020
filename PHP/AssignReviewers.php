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

    <title>SB Admin - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../css/Participant/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../css/Participant/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/Participant/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

<?php
$conn = new mysqli("127.0.0.1","root","","Research-Conclave");
if(isset($_POST['PosterReviewer']))
{
    $r1=$_POST['Reviewer1'];
    $r2=$_POST['Reviewer2'];
    if($r1=="Choose..." or $r2=="Choose...")
    {
        echo "You have not selected some reviewer";
    }
    else if($r1==$r2)
    {
        echo "You have assigned same reviewer to both";
    }
    else
    {
        echo $r1;
        echo $r2;

        $posterid = $_POST['PosterReviewer'];
        echo $posterid;
        $setReviewerquery = mysqli_query($conn,"UPDATE PosterPresentation SET Reviewer1='$r1', Reviewer2='$r2' WHERE Posterid='$posterid'");

    }

}
else if(isset($_POST['OralReviewer']))
{
    $r1=$_POST['Reviewer1'];
    $r2=$_POST['Reviewer2'];
    if($r1=="Choose..." or $r2=="Choose...")
    {
        echo "You have not selected some reviewer";
    }
    else if($r1==$r2)
    {
        echo "You have same assigned reviewer to both";
    }
    else
    {
        echo $r1;
        echo $r2;

        $oralid = $_POST['OralReviewer'];
        echo $oralid;
        $setReviewerquery = mysqli_query($conn,"UPDATE OralPresentation SET Reviewer1='$r1', Reviewer2='$r2' WHERE Oralid='$oralid'");

    }

}
?>

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="#">
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
            <a class="nav-link" href="./ShowNoticeStudent.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Show Notice</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./generateStudentConvReport.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Show Report</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./logout.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Logout</span></a>
        </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

            <h2>Poster Presentation</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Poster Presentaiton No.</th>
                        <th>Name of Participant</th>
                        <th>Title</th>
                        <th>Remark</th>
                        <th>Reviewer_1</th>
                        <th>Reviewer_2</th>
                        <th>Assign Reviewer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $conn = new mysqli("127.0.0.1","root","","Research-Conclave");
                    $posterquery = mysqli_query($conn,"SELECT * FROM PosterPresentation WHERE Approved=0");
                    $reviewerquery = mysqli_query($conn,"SELECT * FROM Reviewer WHERE Type='Poster Presentation'");
                    $poster_reviewer_name = array();
                    $poster_reviewer_id = array();
                    $poster_reviewer_index=0;
                    $selectOption = "";

                    $datequery = mysqli_query($conn, "SELECT * FROM Event WHERE Type='Poster Presentation'");
                    $todaydate = date("Y-m-d");
                    $posterevent = mysqli_fetch_assoc($datequery);

                    while ($row=mysqli_fetch_assoc($reviewerquery))
                    {
                        $poster_reviewer_id[$poster_reviewer_index]=$row['Username'];
                        $poster_reviewer_name[$poster_reviewer_index]=$row['Name'];

                        $selectOption = $selectOption."<option value='".$row['Username']."'>".$row['Name'].",".$row['Department']."</option>";
                        $poster_reviewer_index++;
                    }
                    while ($row = mysqli_fetch_array($posterquery)) {
                        if( $todaydate>$posterevent['EndDate'])
                        {
                            echo "<tr>";
                            echo "<td>".$row['Posterid']."</td>";
                            echo "<td>".$row['Username']."</td>";
                            echo "<td>".$row['AbstractTitle']."</td>";
                            echo "<td>".$row['Remark']."</td>";
                            echo "<td><form method='post'><select name='Reviewer1'><option>Choose...</option>".$selectOption."</select></td>";
                            echo "<td><select name='Reviewer2'><option>Choose...</option>".$selectOption."</select></td>";
                            echo "<td>"."<button name='PosterReviewer' value='";echo $row['Posterid'];echo "'>"."Assign</button></form></td>";
                            echo "</tr>";
                        }


                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <h2>Oral Presentation</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Oral Presentation No.</th>
                        <th>Name of Participant</th>
                        <th>Title</th>
                        <th>Remark</th>
                        <th>Reviewer_1</th>
                        <th>Reviewer_2</th>
                        <th>Assign Reviewer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $oralquery = mysqli_query($conn,"SELECT * FROM OralPresentation WHERE Approved=0");
                    $reviewerquery = mysqli_query($conn,"SELECT * FROM Reviewer WHERE Type='Oral Presentation'");
                    $oral_reviewer_name = array();
                    $oral_reviewer_id = array();
                    $oral_reviewer_index=0;
                    $selectOption = "";

                    $datequery = mysqli_query($conn, "SELECT * FROM Event WHERE Type='Oral Presentation'");
                    $todaydate = date("Y-m-d");
                    $posterevent = mysqli_fetch_assoc($datequery);

                    while ($row=mysqli_fetch_assoc($reviewerquery))
                    {
                        $oral_reviewer_id[$oral_reviewer_index]=$row['Username'];
                        $poster_reviewer_name[$oral_reviewer_index]=$row['Name'];
                        $oral_reviewer_index++;
                        $selectOption = $selectOption."<option value='".$row['Username']."'>".$row['Name'].",".$row['Department']."</option>";
                    }
//                    $oral_index=0;
                    while ($row = mysqli_fetch_array($oralquery)) {
                    if($todaydate>$posterevent['EndDate'])
                    {
                        echo "<tr>";
                        echo "<td>" . $row['Oralid'] . "</td>";
                        echo "<td>" . $row['Username'] . "</td>";
                        echo "<td>" . $row['AbstractTitle'] . "</td>";
                        echo "<td>" . $row['Remark'] . "</td>";
                        echo "<td><form method='post'><select name='Reviewer1'><option>Choose...</option>" . $selectOption . "</select></td>";
                        echo "<td><select name='Reviewer2'><option>Choose...</option>" . $selectOption . "</select></td>";
                        echo "<td>" . "<button name='OralReviewer' value='";
                        echo $row['Oralid'];
                        echo "'>" . "Assign</button></form></td>";
                        echo "</tr>";
                    }
                    }
                    ?>

                    </tbody>
                </table>
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