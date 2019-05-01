<!--TODO file upload and download to new folder inside your computer-->
<?php
error_reporting(E_ALL ^ E_NOTICE );
error_reporting(E_ERROR | E_PARSE);
//session based login system
session_start();
?>

<?php
if(!isset($_SESSION['logged_in']))
    header("Location: login.php");

if(isset($_GET['posterfile']))
{
//    echo $_GET['posterfile'];
    $posterid = $_GET['posterfile'];
    $conn = new mysqli("127.0.0.1","root","","Research-Conclave");
    $file_poster_query = mysqli_query($conn,"SELECT File,FileName,FileSize,FileType FROM PosterPresentation WHERE Posterid='$posterid'");
    list($content,$name,$size,$type) = mysqli_fetch_array($file_poster_query);
    header("Content-length: $size");
    header("Content-type: $type");
    header("Content-Disposition: attachment; filename=$name");
    ob_clean();
    flush();
    echo $content;
}
else if(isset($_GET['oralfile']))
{
//    echo "oral";
    $conn = new mysqli("127.0.0.1","root","","Research-Conclave");
    $oralid = $_GET['oralfile'];
    $file_oral_query = mysqli_query($conn,"SELECT File,FileName,FileSize,Filetype FROM OralPresentation WHERE Oralid='$oralid'");
    list($content,$name,$size,$type) = mysqli_fetch_array($file_oral_query);
    header("Content-length: $size");
    header("Content-type: $type");
    header("Content-Disposition: attachment; filename=$name");
    ob_clean();
    flush();
    echo $content;
    exit;
}
else if(!isset($_GET['oralfile']) && !isset($_GET['posterfile']))
{

}


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



<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="#">
                <span><?php
                    $name = $_SESSION['name'];
                    echo "$name";
                    ?></span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link " href="./ParticipantApplyEvent.php" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Apply</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./MySubmissionsParticipant.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>My Submissions</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./logout.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Logout</span></a>
        </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

<!--            <div class="card mb-3">-->
            <?php
            $user = $_SESSION['username'];
            $conn = new mysqli("127.0.0.1","root","","Research-Conclave");
            $posterquery = mysqli_query($conn,"SELECT * FROM PosterPresentation WHERE Username='$user'");
            $number_of_posters = mysqli_num_rows($posterquery);
            $oralquery = mysqli_query($conn,"SELECT * FROM OralPresentation WHERE Username='$user'");
            $number_of_orals = mysqli_num_rows($oralquery);
            if($number_of_posters==1)
            {
                $row = mysqli_fetch_assoc($posterquery);
                echo '<div class="card mb-5">
                    <h5 class="card-header">';
                    echo "Poster Presentation";
                    echo '</h5>
                        <div class="card-body"><h5 class="card-title">';
                    echo $row['AbstractTitle'];
                    echo '</h5>';
                            echo '<p class="card-text">';
                            echo $row['AbstractDescription'];
                            echo '</p><form method="get"><button type="submit" name="posterfile" value=';echo $row['Posterid'];echo ' class="btn btn-primary">File</button></form>
                        </div>
                    </div>';
            }
            if($number_of_orals==1)
            {
                $row = mysqli_fetch_assoc($oralquery);
                echo '<div class="card mb-5">
                    <h5 class="card-header">';
                echo "Oral Presentation";
                echo '</h5>
                        <div class="card-body"><h5 class="card-title">';
                echo $row['AbstractTitle'];
                echo '</h5>';
                echo '<p class="card-text">';
                echo $row['AbstractDescription'];
                echo '</p><form method="get"><button name="oralfile" type="submit" value=';echo $row['Oralid'];echo ' class="btn btn-primary">File</button></form>
                        </div>
                    </div>';
            }
            ?>


<!--            </div>-->

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
                <a class="btn btn-primary" href="./logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>


</body>

</html>
