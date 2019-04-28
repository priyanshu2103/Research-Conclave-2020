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
        $filename = $_FILES['file']['name'];
        $file = file_get_contents($_FILES['file']['tmp_name']);

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
                $approved = 0;
                $insertquery = mysqli_query($conn,"INSERT INTO PosterPresentation (Posterid,Username,Approved,File,FileName,AbstractTitle,AbstractDescription,Email)
                                        VALUES ('$posterid','$user','$approved','$file','$filename','$title','$description','$email')");
//                $insertquery->execute();

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
//                echo "$posterid";
                $approved = 0;
                $insertquery = mysqli_query($conn,"INSERT INTO OralPresentation (Oralid,Username,Approved,File,FileName,AbstractTitle,AbstractDescription,Email)
                                        VALUES ('$oralid','$user','$approved','$file','$filename','$title','$description','$email')");
            }




        }

    }
}

?>

<!--<nav class="navbar navbar-expand navbar-dark bg-dark static-top">-->

<!--    <a class="navbar-brand mr-1" href="index.html">Start Bootstrap</a>-->

<!--    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">-->
<!--        <i class="fas fa-bars"></i>-->
<!--    </button>-->

<!-- Navbar Search -->
<!--    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">-->
<!--        <div class="input-group">-->
<!--            <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">-->
<!--            <div class="input-group-append">-->
<!--                <button class="btn btn-primary" type="button">-->
<!--                    <i class="fas fa-search"></i>-->
<!--                </button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </form>-->

<!-- Navbar -->
<!--    <ul class="navbar-nav ml-auto ml-md-0">-->
<!--        <li class="nav-item dropdown no-arrow mx-1">-->
<!--            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                <i class="fas fa-bell fa-fw"></i>-->
<!--                <span class="badge badge-danger">9+</span>-->
<!--            </a>-->
<!--            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">-->
<!--                <a class="dropdown-item" href="#">Action</a>-->
<!--                <a class="dropdown-item" href="#">Another action</a>-->
<!--                <div class="dropdown-divider"></div>-->
<!--                <a class="dropdown-item" href="#">Something else here</a>-->
<!--            </div>-->
<!--        </li>-->
<!--        <li class="nav-item dropdown no-arrow mx-1">-->
<!--            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                <i classhttps://colorlib.com/wp/free-bootstrap-admin-dashboard-templates/="fas fa-envelope fa-fw"></i>-->
<!--                <span class="badge badge-danger">7</span>-->
<!--            </a>-->
<!--            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">-->
<!--                <a class="dropdown-item" href="#">Action</a>-->
<!--                <a class="dropdown-item" href="#">Another action</a>-->
<!--                <div class="dropdown-divider"></div>-->
<!--                <a class="dropdown-item" href="#">Something else here</a>-->
<!--            </div>-->
<!--        </li>-->
<!--        <li class="nav-item dropdown no-arrow">-->
<!--            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                <i class="fas fa-user-circle fa-fw"></i>-->
<!--            </a>-->
<!--            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">-->
<!--                <a class="dropdown-item" href="#">Settings</a>-->
<!--                <a class="dropdown-item" href="#">Activity Log</a>-->
<!--                <div class="dropdown-divider"></div>-->
<!--                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>-->
<!--            </div>-->
<!--        </li>-->
<!--    </ul>-->

</nav>

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