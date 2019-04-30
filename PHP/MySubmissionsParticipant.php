<!--TODO file upload and download to new folder inside your computer-->
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

<?php

if(isset($_POST['posterfile']))
{
    $posterid = $_POST['posterfile'];
    $path = $posterid;
    $d=dir($path);
    echo $posterid;
    while (false !== ($entry = $d->read()))
    {
        $filename = $entry;
    }
    echo $filename;
    echo $filename;
    chmod($posterid.'/'.$filename,777);
    if(is_readable($filename))
    {
        echo "readable";
    }
    else
    {
        echo "not readable";
    }
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filename).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    readfile($filename);

}
if(isset($_POST['oralfile']))
{
//    echo "dff";
    $oralid = $_POST['oralfile'];
    echo $oralid;
    $path = $oralid;
    $d=dir($path);

    while (false !== ($entry = $d->read()))
    {
        $filename = $entry;
    }
    echo $filename;
    chmod($oralid.'/'.$filename,777);
    if(is_readable($filename))
    {
        echo "readable";
    }
    else
    {
        echo "not readable";
    }
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    readfile($filename);
    exit;
}

?>

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="./ParticipantPage.php">
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
            <a class="nav-link" href="./Home.php">
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
                            echo '</p><form method="post"><button type="submit" name="posterfile" value=';echo $row['Posterid'];echo ' class="btn btn-primary">File</button></form>
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
                echo '</p><form method="post"><button name="oralfile" type="submit" value=';echo $row['Oralid'];echo ' class="btn btn-primary">File</button></form>
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
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>


</body>

</html>