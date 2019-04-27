<?php
error_reporting(E_ALL ^ E_NOTICE );
//error_reporting(E_ERROR | E_PARSE);E_PARSE
//session based login system
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Register</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Main CSS-->
    <link href="../css/Register/main.css" rel="stylesheet" type="text/css">
</head>

<?php

if(isset($_POST['register-btn']))
{
    $flag=0;
    $firstName = $_POST['first_name'];
    $secondName = $_POST['last_name'];
    $username = $_POST['Username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirmPass = $_POST['confirm-password'];


    $name = $firstName." ".$secondName;
    if($password === $confirmPass)
    {
        $conn = mysqli_connect("127.0.0.1","root","","Research-Conclave");
        $query = mysqli_query($conn,"SELECT * FROM Users WHERE username ='$username' ");
        $numrows = mysqli_num_rows($query);

        if($numrows==1)
        {
//            echo "Username already exists";
            $flag=1;
            mysqli_close($conn);
        }
        else
        {
            $password = md5($password);
            $sql1 = "INSERT INTO Participants (Name,username,password,address,email,Phone) VALUES ('$name','$username','$password','$address','$email','$phone')";
            $sql2 = "INSERT INTO Users (userid,username,password,usertype,email,Name) VALUES (DEFAULT ,'$username','$password','Participant','$email','$name')";
            if($conn->query($sql1)===TRUE)
            {
                if($conn->query($sql2)===TRUE)
                    header("location:./login.php");
            }
            mysqli_close($conn);
        }
    }
    else
    {
//        $message = "Passwords did not match";
//        echo "<script type='text/javascript'>alert('$message');</script>";
        $flag=2;
    }

}

?>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Event Registration Form</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-row m-b-55">
                            <div class="name">Name</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="first_name" required>
                                            <label class="label--desc">first name</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="last_name">
                                            <label class="label--desc">last name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Username</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="Username" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Phone</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="phone" pattern="[0-9]{10}" oninvalid="this.setCustomValidity('This is a required field and Phone number should be 10 digits long')"required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Address</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="address" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="password" name="password" minlength="8" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Confirm Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="password" name="confirm-password" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value" >
                                <?php
                                    if($flag==1)
                                        echo '<span style="color:#FF0000;text-align:center;">*Username already exists</span>';
                                    if($flag==2)
                                        echo '<span style="color:#FF0000;text-align:center;">*Passwords did not match!</span>';
                                ?>
                            </div>
<!--                            <div class="value">-->
<!--                                <div class="input-group">-->
<!--                                    <input class="input--style-5" type="password" name="confirm-password" required>-->
<!--                                </div>-->
<!--                            </div>-->
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit" name="register-btn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>