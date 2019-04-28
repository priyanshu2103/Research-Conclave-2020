<?php
error_reporting(E_ALL ^ E_NOTICE );
error_reporting(E_ERROR | E_PARSE);
//session based login system
session_start();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="../images/login/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../css/Login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../css/Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../css/Login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../css/Login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../css/Login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../css/Login/util.css">
    <link rel="stylesheet" type="text/css" href="../css/Login/main.css">
    <!--===============================================================================================-->
</head>
<body>

<!--login backend -->


<?php

if(isset($_POST['login_btn']))
//if ($_POST['login_btn'])
{
    // Login mein error message echo ho raha hai, ganda lag raha hai
    $flag=0;
    $user = $_POST['username'];
    $password = $_POST['pass'];
    if ($user)
    {
        if($password)
        {
            echo md5($password);
            $conn = mysqli_connect("127.0.0.1","root","","Research-Conclave");
            $query = mysqli_query($conn,"SELECT * FROM Users WHERE username ='$user' ");
            $numrows = mysqli_num_rows($query);
            if($numrows==1)
            {
                $row = mysqli_fetch_assoc($query);
                $dbname = $row['Name'];
                echo "$dbname";
                $dbemail = $row['email'];
                $dbuser = $row['username'];
                $dbpass = $row['password'];
                $dbusertype = $row['usertype'];
//                echo "$dbpass";
                if(md5($password) == $dbpass)
                {
                    if($dbusertype=="Participant")
                    {
                        header("location:./ParticipantPage.php");
                        $_SESSION['username']=$user;
                        $_SESSION['name']=$dbname;
                        $_SESSION['email']=$dbemail;
                        $_SESSION['usertype']=$dbusertype;
                    }
                    else if($dbusertype=="FacultyConvener")
                    {
                        header("location:FacultyConvenerPage.php");
                        $_SESSION['username']=$user;
                        $_SESSION['name']=$dbname;
                        $_SESSION['email']=$dbemail;
                        $_SESSION['usertype']=$dbusertype;
                    }
                    else if($dbusertype=="Reviewer")
                    {
                        header("location:ReviewerPage.php");
                        $_SESSION['username']=$user;
                        $_SESSION['name']=$dbname;
                        $_SESSION['email']=$dbemail;
                        $_SESSION['usertype']=$dbusertype;
                    }
                    else if($dbusertype=="StudentConvener")
                    {
                        header("location:StudentConvenerPage.php");
                        $_SESSION['username']=$user;
                        $_SESSION['name']=$dbname;
                        $_SESSION['email']=$dbemail;
                        $_SESSION['usertype']=$dbusertype;
                    }
                    else
                    {
                        header("location:register.php");
                    }
                }
                else
                {
                    $flag=1;
//                    echo "Password is wrong ";
                }
            }
            else
            {
                $flag=2;
//                echo "$numrows Username does not exist ";
            }

            mysqli_close($conn);
        }
        else
        {
            $flag=3;
//            echo "You must enter your password ";
        }
    }
    else
    {
        $flag=4;
//        echo "You must enter your username ";
    }
}
?>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="../images/login/logo.png" alt="IMG">
            </div>

            <form class="login100-form validate-form" action="./login.php" method="post">
					<span class="login100-form-title">
						 Login
					</span>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name='username' placeholder="Username">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100" type="password" name='pass' placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" name='login_btn' type="submit" >
                        Login
                    </button>
                </div>

                <div class="text-center p-t-12">
						<span class="txt1">
<!--							Forgot-->
						</span>
<!--                    <a class="txt2" href="#">-->
                        <?php
                            if($flag==1){echo "Password is wrong";}
                            if($flag==2){echo "$numrows Username does not exist ";}
                            if($flag==3){ echo "You must enter your password ";}
                            if($flag==4){ echo "You must enter your username ";}
                        ?>
<!--                        Username / Password?-->
<!--                    </a>-->
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="#">
<!--                        Create your Account-->
<!--                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>-->
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="../css/Login/vendor/jquery/jquery-3.2.1.min.js"></script>-->

<script src="../css/Login/vendor/bootstrap/js/popper.js"></script>-->
<script src="../css/Login/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../css/Login/vendor/select2/select2.min.js"></script>
<script src="../css/Login/vendor/tilt/tilt.jquery.min.js"></script>
<script >
   $('.js-tilt').tilt({
      scale: 1.1
 })
</script>
<script src="js/main.js"></script>

</body>
</html>
