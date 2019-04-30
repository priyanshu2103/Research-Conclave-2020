<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Reviewer Registration</title>

    <link href="../vendor/AddReviewer/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../vendor/AddReviewer/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    
    <link href="../vendor/AddReviewer/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../vendor/AddReviewer/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../css/AddReviewer/main.css" rel="stylesheet" media="all">
</head>

<?php

$flag=0;
if(isset($_POST['btn-add-reviewer']))
{
    $flag=0;
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $institute = $_POST['insti'];
    $department = $_POST['department'];
    $type = $_POST['type'];
    $password = $_POST['pass'];
    $confirmPass = $_POST['confirm_pass'];


    if($password === $confirmPass)
    {
        $conn = mysqli_connect("127.0.0.1","root","","Research-Conclave");
        $query = mysqli_query($conn,"SELECT * FROM Reviewer WHERE Username ='$username' ");
        $numrows = mysqli_num_rows($query);

        if($numrows==1)
        {
            $flag=1;
            mysqli_close($conn);
        }
        else
        {
            $password = md5($password);
            $sql1 = "INSERT INTO Reviewers (id,Username,Name,Address,Type,Designation,Department,Institute,Email) VALUES (DEFAULT ,'$username','$name','$address','$type','Professor','$department','$institute','$email')";
            $sql2 = "INSERT INTO Users (userid,username,password,usertype,email,Name) VALUES (DEFAULT ,'$username','$password','Reviewer','$email','$name')";
            if($conn->query($sql1)===TRUE)
            {
                if($conn->query($sql2)===TRUE)
                    header("location:./FacultyConvenerPage.php");
            }
            mysqli_close($conn);
        }
    }
    else
    {
        $flag=2;
    }

}

?>

<body>
    <div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Reviewer Registration Info</h2>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Name" name="name" required>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="department" required>
                                            <option disabled="disabled" selected="selected">Department</option>
                                            <option>BT</option>
                                            <option>CL</option>
                                            <option>CST</option>
                                            <option>CE</option>
                                            <option>CSE</option>
                                            <option>Design</option>
                                            <option>ECE</option>
                                            <option>EEE</option>
                                            <option>EPH</option>
                                            <option>MA</option>
                                            <option>ME</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Institute" name="insti" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Address" name="address" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Email" name="email" required>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="type" required>
                                            <option disabled="disabled" selected="selected">Type of Reviewer</option>
                                            <option>Poster Presentation</option>
                                            <option>Oral Presentation</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Username" name="username" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="password" placeholder="Password" name="pass" minlength="8" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="password" placeholder="Confirm Password" name="confirm_pass" minlength="8" required>
                        </div>
                        <div>
                            <?php
                            if($flag==1)
                                echo '<span style="color:#FF0000;text-align:center;">*Username already exists</span>';
                            if($flag==2)
                                echo '<span style="color:#FF0000;text-align:center;">*Passwords did not match!</span>';
                            ?>
                        </div>
                        <div class="p-t-30">
                            <button class="btn btn--radius btn--green" type="submit" name="btn-add-reviewer">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="../vendor/AddReviewer/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="../vendor/AddReviewer/select2/select2.min.js"></script>
    <script src="../vendor/AddReviewer/datepicker/moment.min.js"></script>
    <script src="../vendor/AddReviewer/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="../js/AddReviewer/global.js"></script>

</body>

</html>
<!-- end document-->