<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Notice</title>


    <!-- CSS Files -->
    <link rel="stylesheet" href="../css/ShowNotice/animate-3.7.0.css">
    <link rel="stylesheet" href="../css/ShowNotice/font-awesome-4.7.0.min.css">
    <!-- <link rel="stylesheet" href="assets/fonts/flat-icon/flaticon.css"> -->
    <link rel="stylesheet" href="../css/ShowNotice/bootstrap-4.1.3.min.css">
    <link rel="stylesheet" href="../css/ShowNotice/owl-carousel.min.css">
    <link rel="stylesheet" href="../css/ShowNotice/nice-select.css">
    <link rel="stylesheet" href="../css/ShowNotice/style.css">
</head>
<body>
<!-- Preloader Starts -->
<div class="preloader">
    <div class="spinner"></div>
</div>


<!-- Notice area starts -->
<section class="feature-area section-padding2" style="padding: 0px 0px 0px">
    <div class="jumbotron">
        <h1>Notices</h1>
    </div>
    <div class="container">
        <div class="row">

            <?php
            $conn = mysqli_connect("127.0.0.1","root","","Research-Conclave");
            $query = mysqli_query($conn,"SELECT * FROM Notice");
            $numrows = mysqli_num_rows($query);

            while ($row = mysqli_fetch_assoc($query)) {
                echo "<div class=\"col-lg-4\">
                <div class=\"single-feature mb-4 mb-lg-0\"> <h3>" . $row['Title'] . "</h3>" .
                    "<h4 style='padding-top: 10px'>" . $row['SubmittedBy'] . "</h4>" .
                    "<h4>" . $row['Date'] . "</h4>" .
                    "<p class=\"py-3\">" . $row['Description'] . "</p>" .
                    "<a href=\"./login.php\" class=\"secondary-btn\">explore now<span class=\"flaticon-next\"></span></a>
                    </div>
                </div>";
            }
            ?>

    </div>
</section>
<!-- notice Area End -->



<!-- Javascript -->
<script src="../js/ShowNotice/vendor/jquery-2.2.4.min.js"></script>
<script src="../js/ShowNotice/vendor/bootstrap-4.1.3.min.js"></script>
<script src="../js/ShowNotice/vendor/wow.min.js"></script>
<script src="../js/ShowNotice/vendor/owl-carousel.min.js"></script>
<script src="../js/ShowNotice/vendor/jquery.nice-select.min.js"></script>
<script src="../js/ShowNotice/vendor/ion.rangeSlider.js"></script>
<script src="../js/ShowNotice/main.js"></script>
</body>
</html>