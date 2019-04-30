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

    <title>Submit abstract</title>

    <!-- Custom fonts for this template-->
    <link href="../css/Participant/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../css/Participant/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/Participant/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">
<?php

if(isset($_POST['submit_btn']))
{
    $conn = new mysqli("127.0.0.1","root","","Research-Conclave");
    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
        echo "failed";

    }
    if($_POST['title']=="")
    {
        echo '<script language="javascript">';
        echo 'alert("please enter title of abstract")';
        echo '</script>';
    }
    else if($_POST['description']=="")
    {
        echo '<script language="javascript">';
        echo 'alert("please enter description")';
        echo '</script>';
    }
    else if(empty($_FILES['file']['name']))
    {
        echo '<script language="javascript">';
        echo 'alert("please select file")';
        echo '</script>';
    }
    else
    {
        $user = $_SESSION['username'];
        $email = $_SESSION['email'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['option'];
//        $filename = $_FILES['file']['name'];
//        $file = file_get_contents($_FILES['file']['tmp_name']);

//        echo "$file";
        if($type=="Poster Presentation")
        {

            $selectquery =  mysqli_query($conn,"SELECT * FROM `PosterPresentation`");
            $numrows = mysqli_num_rows($selectquery);
            $numrows+=1;
            $posterid = "Poster".(string)$numrows;
            // check if user already exists
            $userexistsquery = mysqli_query($conn,"SELECT * FROM `PosterPresentation` WHERE Username='$user';");
            $numrows_user = mysqli_num_rows($userexistsquery);
//            echo "$numrows_user";
            $datequery = mysqli_query($conn,"SELECT * FROM Event WHERE Type='Poster Presentation'");
            $todaydate = date("Y-m-d");
//            echo "Todays date: $todaydate";
            $row = mysqli_fetch_assoc($datequery);
            $eventstartdate = $row['StartDate'];
            $eventenddate = $row['EndDate'];
//            echo "$eventenddate";
            if($numrows_user>0)
            {
                echo '<script language="javascript">window.alert("you have already submitted")</script>';
            }
            else if ($todaydate<$eventstartdate)
            {
                echo "Event applications have not yet started";
            }
            else if($todaydate>$eventenddate)
            {
                echo "Registration closed";
            }
            else

            {
                // file upload from here

//                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png","pdf"=>"/");
                $filename = $_FILES['file']['name'];
                $filetype = $_FILES['file']['type'];
                $filesize = $_FILES['file']['size'];
                $file = $_FILES['file']['tmp_name'];

                // verify extension
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $max_size = 50*1024*1024;       // max size in 50MB
                if($ext!="pdf" && $ext!="jpg" && $ext!="jpeg" && $ext!="png" && $ext!="txt" && $ext!="docx"){die("Error: Please select a valid file format.");}
                if($filesize > $max_size) {die("Error: File size is larger than the allowed limit.");}
                if(is_dir($posterid))
                {
                    echo "Directory exists";
                    move_uploaded_file($_FILES['file']['tmp_name'],$posterid."/".$filename);
                    echo "File added";
                    $approved = 0;
                    $insertquery = mysqli_query($conn,"INSERT INTO PosterPresentation (Posterid,Username,Approved,File,FileName,AbstractTitle,AbstractDescription,Email)
                                        VALUES ('$posterid','$user','$approved','$file','$filename','$title','$description','$email')");
                }
                else
                {
                    echo "Directory does not exist";
                    mkdir($posterid);
                    move_uploaded_file($_FILES['file']['tmp_name'],$posterid."/".$filename);
                    echo "File uploaded";
                    $approved = 0;
                    $insertquery = mysqli_query($conn,"INSERT INTO PosterPresentation (Posterid,Username,Approved,File,FileName,AbstractTitle,AbstractDescription,Email)
                                        VALUES ('$posterid','$user','$approved','$file','$filename','$title','$description','$email')");
                }



            }


        }
        else if($type=="Oral Presentation")
        {

            $selectquery =  mysqli_query($conn,"SELECT * FROM `OralPresentation`");

            $numrows = mysqli_num_rows($selectquery);
            $numrows+=1;
            $oralid = "Oral".(string)$numrows;
//            check if user has already submitted oral presentation
            $userexistsquery = mysqli_query($conn,"SELECT * FROM `OralPresentation` WHERE Username='$user'");
            $numrows_user = mysqli_num_rows($userexistsquery);
//            echo "$numrows_user";
            $datequery = mysqli_query($conn,"SELECT * FROM Event WHERE Type='Oral Presentation'");
            $todaydate = date("Y-m-d");
//            echo "Todays date: $todaydate";
            $row = mysqli_fetch_assoc($datequery);
            $eventstartdate = $row['StartDate'];
            $eventenddate = $row['EndDate'];
//            echo "$eventenddate";
            if($numrows_user>0)
            {
                echo '<script language="javascript">window.alert("you have already submitted")</script>';
            }
            else if ($todaydate<$eventstartdate)
            {
                echo "Event applications have not yet started";
            }
            else if($todaydate>$eventenddate)
            {
                echo "Applications closed";
            }
            else
            {
                // file upload from here

//                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png","pdf"=>"/");
                $filename = $_FILES['file']['name'];
                $filetype = $_FILES['file']['type'];
                $filesize = $_FILES['file']['size'];
                $file = $_FILES['file']['tmp_name'];

                // verify extension
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $max_size = 50*1024*1024;       // max size in 50MB
                if($ext!="pdf" && $ext!="jpg" && $ext!="jpeg" && $ext!="png" && $ext!="txt" && $ext!="docx"){die("Error: Please select a valid file format.");}
                if($filesize > $max_size) {die("Error: File size is larger than the allowed limit.");}
                if(is_dir($oralid))
                {
                    echo "Directory exists";
                    move_uploaded_file($_FILES['file']['tmp_name'],$oralid."/".$filename);
                    echo "File added";
                    $approved = 0;
                    $insertquery = mysqli_query($conn,"INSERT INTO OralPresentation (Oralid,Username,Approved,File,FileName,AbstractTitle,AbstractDescription,Email)
                                        VALUES ('$oralid','$user','$approved','$file','$filename','$title','$description','$email')");
                }
                else
                {
                    echo "Directory does not exist";
                    mkdir($oralid);
                    move_uploaded_file($_FILES['file']['tmp_name'],$oralid."/".$filename);
                    echo "File uploaded";
                    $approved = 0;
                    $insertquery = mysqli_query($conn,"INSERT INTO OralPresentation (Oralid,Username,Approved,File,FileName,AbstractTitle,AbstractDescription,Email)
                                        VALUES ('$oralid','$user','$approved','$file','$filename','$title','$description','$email')");
                }
            }




        }

    }
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
            <form action="./ParticipantApplyEvent.php" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Abstract Title" name="title">
                    </div>

                </div>
                <div class="form-group">
                    <label for="inputAddress">Description</label>
                    <textarea  style="height:200px;padding-top: 0px" type="text" class="form-control input-lg" id="Description" placeholder="This Abstract is based on ...." name="description">
                    </textarea>
                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="inputState">Event</label>
                        <select id="inputState" class="form-control" name="option">
                            <option selected>Poster Presentation</option>
                            <option>Oral Presentation</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4" style="vertical-align: middle">
<!--                        <label for="customFile">Upload File</label>-->
                        Upload file
                        <input type="file" name="file" id="file" />
<!--                        <input type="file" class="custom-file-input" id="customFile" name="file">-->
<!--                        <label class="custom-file-label" for="customFile">Choose file</label>-->
                    </div>



                </div>
                <div class="form-group">

                </div>
                <button type="submit" class="btn btn-primary" name="submit_btn">Submit</button>
            </form>
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