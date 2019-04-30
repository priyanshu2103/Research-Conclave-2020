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
    if(isset($_POST['submit_btn']))
    {
        $conn = mysqli_connect("127.0.0.1","root","","Research-Conclave");
        $username = $_SESSION['username'];
        if($username==$_POST['username'])
        {
            $userquery = mysqli_query($conn,"SELECT * FROM Users WHERE username='$username'");
//            echo $_POST['current_password'];
            $old_row = mysqli_fetch_assoc($userquery);
            $old_password = $old_row['password'];
//            echo $old_password;
            if(md5($_POST['current_password'])==$old_password)
            {
//                echo "Passwords matches";
                if($_POST['new_password']==$_POST['renter_password'])
                {
                    $new_password = md5($_POST['new_password']);
                    $passwordquery = mysqli_query($conn,"UPDATE Users SET password='$new_password' WHERE username='$username'");
                    echo "Password updated successfully";
                }
                else
                {
                    echo "Passwords do not match";
                }
            }
            else
            {
                echo "Please enter correct password";
            }
        }
        else
        {
            echo "Please enter correct username";
        }
    }
?>

</nav>

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

            <form method="post">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Username" name="username">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Current Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="current_password">
                        <input type="checkbox" onclick="myFunction('inputPassword3')">Show Password
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="new_password" minlength="8">
                        <input type="checkbox" onclick="myFunction1('inputPassword4')">Show Password
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Renter New Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword5" placeholder="Password" name="renter_password" minlength="8">
                        <input type="checkbox" onclick="myFunction2('inputPassword5')">Show Password
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary" name="submit_btn">Submit</button>
                    </div>
                </div>
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
                <a class="btn btn-primary" href="./logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>
<script >
    function myFunction(id) {
        var x = document.getElementById(id);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    function myFunction1(id) {
        var x = document.getElementById(id);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    function myFunction2(id) {
        var x = document.getElementById(id);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>


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

</body>

</html>