<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Research Conclave 2020</title>
    <link href="../css/Home/bootstrap.min.css" rel="stylesheet">
    <link href="../css/Home/font-awesome.min.css" rel="stylesheet">
    <link href="../css/Home/pe-icons.css" rel="stylesheet">
    <link href="../css/Home/prettyPhoto.css" rel="stylesheet">
    <link href="../css/Home/animate.css" rel="stylesheet">
    <link href="../css/Home/style.css" rel="stylesheet">
    <script src="../js/Home/jquery.js"></script>
<!--    <link rel="shortcut icon" href="images/ico/favicon.ico">-->
<!--    <link rel="apple-touch-icon" sizes="144x144" href="images/ico/apple-touch-icon-144x144.png">-->
<!--    <link rel="apple-touch-icon" sizes="114x114" href="images/ico/apple-touch-icon-114x114.png">-->
<!--    <link rel="apple-touch-icon" sizes="72x72" href="images/ico/apple-touch-icon-72x72.png">-->
<!--    <link rel="apple-touch-icon" href="images/ico/apple-touch-icon-57x57.png">-->

    <script type="text/javascript">
        jQuery(document).ready(function($){
            'use strict';
            jQuery('body').backstretch([
                "../images/Home/bg/bg1.jpg",
                "../images/Home/bg/bg2.jpg",
                "../images/Home/bg/bg3.jpg"
            ], {duration: 5000, fade: 500, centeredY: true });

            $("#mapwrapper").gMap({ controls: false,
                scrollwheel: false,
                markers: [{
                    latitude:40.7566,
                    longitude: -73.9863,
                    icon: { image: "../images/Home/marker.png",
                        iconsize: [44,44],
                        iconanchor: [12,46],
                        infowindowanchor: [12, 0] } }],
                icon: {
                    image: "../images/Home/marker.png",
                    iconsize: [26, 46],
                    iconanchor: [12, 46],
                    infowindowanchor: [12, 0] },
                latitude:40.7566,
                longitude: -73.9863,
                zoom: 14 });
        });
    </script>
</head>
<body>
<div id="preloader"></div>
<header class="navbar navbar-inverse navbar-fixed-top " role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="index.html"><h1><span class="pe-7s-gleam bounce-in"></span>Research Conclave</h1></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.html">Notices</a></li>
                <li><a href="./login.php">Login</a></li>
                <li><a href="./register.php">Register</a></li>
                <li><a href="#here">About Us</a></li>
                <li><a href="http://www.iitg.ac.in/researchconclave/">Official Website</a></li>
            </ul>
        </div>
    </div>
</header>

<section id="main-slider" class="no-margin">
    <div class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="carousel-content center centered">
                                <!-- <span class="home-icon pe-7s-gleam bounce-in"></span> -->
                                <h2 class="boxed animation animated-item-1 fade-down">RESEARCH CONCLAVE 2020</h2><br>
                                <h4  class="boxed animation animated-item-1 fade-down">An amalgamation of Academia,Industry & Start-ups</h4>
                                    <!-- <p class="boxed animation animated-item-2 fade-up">Our expertise will guide you to success. Without Fail.</p> -->
                                    <br>
                                    <a class="btn btn-md animation bounce-in" href="./register.php">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->
        </div><!--/.carousel-inner-->
    </div><!--/.carousel-->
</section><!--/#main-slider-->

<div id="content-wrapper">

    <section id="about-us" class="white">
        <div class="container">
            <div class="gap"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="center gap fade-down section-heading">
                        <h2 class="main-title" id="here">A Little About Us</h2>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1 fade-up">
                    <p>
                        Research Conclave is organized under the banner of Students' Academic Board (SAB) of Indian Institute of Technology Guwahati (IITG). It is a staunch platform to nurture the young minds towards research, innovation and entrepreneurship, which intends to bring the integrity of the students towards both industries and academia to redress the academic research challenges, concerns of the entire student community and upcoming entrepreneurs around the globe. It is a forum to harness innovative mind to level-up the economic strata of current society from research to industries. The Research Conclave work as catalyst for building leaders through holistic, transformable and innovative ideas. It has started in 2015 with great rhythm and passion, and this year with the same enthusiasm we are conducting this event in a broader spectrum.
                    </p>
                </div>
                <div class="col-md-4 fade-up">

                </div>
            </div>
        </div>
    </section>

</div>


<script src="../js/Home/plugins.js"></script>
<script src="../js/Home/bootstrap.min.js"></script>
<script src="../js/Home/jquery.prettyPhoto.js"></script>
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWDPCiH080dNCTYC-uprmLOn2mt2BMSUk&amp;sensor=true"></script> -->
<script src="../js/Home/init.js"></script>
</body>
</html>
