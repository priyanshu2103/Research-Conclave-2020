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
$conn = new mysqli("127.0.0.1","root","","Research-Conclave");
if(isset($_POST['postermarksassign']))
{
    $posterid_and_marks = $_POST['postermarksassign'];
//    echo $posterid_and_marks[strlen($posterid_and_marks)-1];
    if($posterid_and_marks[strlen($posterid_and_marks)-1]==1)
    {
        if($_POST['marks']!=NULL)
        {
            $marks = $_POST['marks'];
            $posterid = substr($posterid_and_marks,0,strlen($posterid_and_marks)-1);
//            echo $posterid;
            $poster_1_marks_update = mysqli_query($conn,"UPDATE PosterPresentation SET Marks1=$marks WHERE Posterid='$posterid'");
            echo "Marks updated successfully";
        }
      else  echo "Please enter marks";
    }
    else if($posterid_and_marks[strlen($posterid_and_marks)-1]==2)
    {
        if($_POST['marks']!=NULL)
        {

            $marks = $_POST['marks'];
//            echo $marks;
            $posterid = substr($posterid_and_marks,0,strlen($posterid_and_marks)-1);
//            echo $posterid;
            $poster_2_marks_update = mysqli_query($conn,"UPDATE PosterPresentation SET Marks2=$marks WHERE Posterid='$posterid'");
            echo "Marks updated successfully";
        }
      else  echo "Please enter marks";
    }
}

if(isset($_POST['oralmarksassign']))
{
    $oralid_and_marks = $_POST['oralmarksassign'];
    if($oralid_and_marks[strlen($oralid_and_marks)-1]==1)
    {
        $marks = $_POST['marks'];
        $oralid = substr($oralid_and_marks,0,strlen($oralid_and_marks)-1);
//        echo $oralid;
        $oral_1_marks_update = mysqli_query($conn,"UPDATE OralPresentation SET Marks1=$marks WHERE Oralid='$oralid'");
        echo "Marks updated successfully";
    }
    else if($oralid_and_marks[strlen($oralid_and_marks)-1]==2)
    {
        $marks = $_POST['marks'];
        $oralid = substr($oralid_and_marks,0,strlen($oralid_and_marks)-1);
//        echo $oralid;
        $oral_2_marks_update = mysqli_query($conn,"UPDATE OralPresentation SET Marks2=$marks WHERE Oralid='$oralid'");
        echo "Marks updated successfully";
    }
}
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
    exit;
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
?>

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
            <a class="nav-link " href="./EvaluatePoster_OralReviewer.php" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Evaluate</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./ShowNoticeReviewer.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Notices</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./ChangeUsernamePasswordReviewer.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Change Password</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./logout.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Logout</span></a>
        </li>

    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

            <?php
            $flag=0;
            $username = $_SESSION['username'];
            $conn = new mysqli("127.0.0.1","root","","Research-Conclave");
            $posterquery = mysqli_query($conn,"SELECT * FROM PosterPresentation WHERE ((Reviewer1 = '$username' OR Reviewer2 = '$username') AND Approved=1 )");

            $posteridarray = array();
            $posterindex=0;
            while($row=mysqli_fetch_assoc($posterquery))
            {
                $reviewer1 = $row['Reviewer1'];
                $reviewer2 = $row['Reviewer2'];
                if($username==$reviewer1){$flag=1;}
                else $flag=2;
                if($flag==1 && $row['Marks1']==NULL)
                {
                    $posteridarray[$posterindex]=$row['Posterid'];
                    echo '<div class="card mb-5">
                    <h5 class="card-header">';
                    echo $row['AbstractTitle'];
                    echo '</h5>';
                    echo '</h5>';
                    echo '<div class="card-body"><p class="card-text">';
                    echo $row['AbstractDescription'];
                    echo '<form method="get"><button class="btn btn-info" type="submit" name="posterfile" value=';echo $posteridarray[$posterindex];echo '>File</button></form>';
                    echo '</div><form method="post"><input type="number" name="marks" placeholder="Marks"  max="10" min="0" minlength="1">
                        <button class="btn btn-primary" type="submit" name="postermarksassign" value="';echo $posteridarray[$posterindex].$flag; echo '">Assign Marks</button>
                        </form></div>';
                    $posterindex++;
                    $flag=0;
                }
                else if($flag==2 && $row['Marks2']==NULL)
                {
                    $posteridarray[$posterindex]=$row['Posterid'];
                    echo '<div class="card mb-5">
                    <h5 class="card-header">';
                    echo $row['AbstractTitle'];
                    echo '</h5>';
                    echo '</h5>';
                    echo '<div class="card-body"><p class="card-text">';
                    echo $row['AbstractDescription'];
                    echo '<form method="get"><button class="btn btn-info" type="submit" name="posterfile" value=';echo $posteridarray[$posterindex];echo '>File</button></form>';
                    echo '</div><form method="post"><input type="number" name="marks" placeholder="Marks"  max="10" min="0" minlength="1">
                        <button class="btn btn-primary" type="submit" name="postermarksassign" value="';echo $posteridarray[$posterindex].$flag; echo '">Assign Marks</button>
                        </form></div>';
                    $posterindex++; $flag=0;
                }

            }
            $oralquery = mysqli_query($conn,"SELECT * FROM OralPresentation WHERE ((Reviewer1 = '$username' OR Reviewer2 = '$username') AND Approved=1 )");
            $oralidarray=array();
            $oralindex=0;
            while($row=mysqli_fetch_assoc($oralquery))
            {
                $oralidarray[$oralindex]=$row['Oralid'];
                $reviewer1 = $row['Reviewer1'];
                $reviewer2 = $row['Reviewer2'];
                if($username==$reviewer1){$flag=1;}
                else $flag=2;
                if($flag==1 && $row['Marks1']==NULL)
                {
                    echo '<div class="card mb-5">
                    <h5 class="card-header">';
                    echo $row['AbstractTitle'];
                    echo '</h5>';
                    echo '</h5>';
                    echo '<div class="card-body"><p class="card-text">';
                    echo $row['AbstractDescription'];
                    echo '<form method="get"><button class="btn btn-info" type="submit" name="oralfile" value=';echo $row['Oralid'];echo '>File</button></form>';
                    echo '</div><form method="post"><input type="number" name="marks" placeholder="Marks" max="10" min="0" minlength="1">
                        <button class="btn btn-primary" type="submit" name="oralmarksassign" value="';echo $oralidarray[$oralindex].$flag; echo '">Assign Marks</button>
                        </form></div>';
                    $oralindex++; $flag=0;
                }
                if($flag==2 && $row['Marks2']==NULL)
                {
                    echo '<div class="card mb-5">
                    <h5 class="card-header">';
                    echo $row['AbstractTitle'];
                    echo '</h5>';
                    echo '</h5>';
                    echo '<div class="card-body"><p class="card-text">';
                    echo $row['AbstractDescription'];
                    echo '<form method="get"><button class="btn btn-info" type="submit" name="oralfile" value=';echo $row['Oralid'];echo '>File</button></form>';
                    echo '</div><form method="post"><input type="number" name="marks" placeholder="Marks"  max="10" min="0" minlength="1">
                        <button class="btn btn-primary" type="submit" name="oralmarksassign" value="';echo $oralidarray[$oralindex].$flag; echo '">Assign Marks</button>
                        </form></div>';
                    $oralindex++; $flag=0;
                }

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