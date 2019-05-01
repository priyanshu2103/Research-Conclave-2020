<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Events</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .jumbotron img{
            display:block;
            margin-left:auto;
            margin-right:auto;
        }
    </style>
</head>

<?php
    $conn = mysqli_connect("127.0.0.1","root","","Research-Conclave");
    $query1 = mysqli_query($conn,"SELECT * FROM Event WHERE Type ='Poster Presentation' ");
    $query3 = mysqli_query($conn,"SELECT Image FROM Event WHERE Type ='Poster Presentation' ");
    $query2 = mysqli_query($conn,"SELECT * FROM Event WHERE Type ='Oral Presentation' ");

    $row1 = mysqli_fetch_assoc($query1);
    $row2 = mysqli_fetch_assoc($query2);
    $row3 = mysqli_fetch_array($query3);

    $image1 = $row1['Image'];
    $image2 = $row2['Image'];
    $image3 = $row3['Image'];
    $posterStart = $row1['StartDate'];
    $posterEnd = $row1['EndDate'];
    $oralStart = $row2['StartDate'];
    $oralEnd = $row2['EndDate'];
    $desription_poster = $row1['Description'];
    $desription_oral = $row2['Description'];

?>

<body>
<div class="jumbotron" >
    <h1 style="text-align: center">Poster Presentation</h1>
    <h5 style="text-align: center">Start Date: <?php echo $posterStart;?></h5>
    <h5 style="text-align: center">End Date: <?php echo $posterEnd?></h5>
    <img src="../images/Events/poster.png" class="img-circle center ">
    <p style="margin-top: 20px"><?php echo $desription_poster; ?></p>
</div>
<div class="jumbotron">
    <h1 style="text-align: center">Oral Presentation</h1>
    <h5 style="text-align: center">Start Date: <?php echo $oralStart;?></h5>
    <h5 style="text-align: center">End Date: <?php echo $oralEnd?></h5>
    <img src="../images/Events/oral.png" class="img-circle center ">
    <p style="margin-top: 20px"><?php echo $desription_oral; ?></p>
</div>

<!--<div class="card-group">-->
<!--    <div class="card">-->
<!--        <img class="card-img-top" src="../images/Events/poster.png" alt="Card image cap">-->
<!--        <div class="card-body">-->
<!--            <h4 class="card-title">Poster Presentation</h4>-->
<!--            <p class="card-text">--><?php //$desription_poster ?><!--</p>-->
<!--            <h5 class="card-text">Start Date: --><?php //$posterStart ?><!--</h5>-->
<!--            <h5 class="card-text">End Date: --><?php //$posterEnd ?><!--</h5>-->
<!--<!--            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="card">-->
<!--        <img class="card-img-top" src="..." alt="Card image cap">-->
<!--        <div class="card-body">-->
<!--            <h5 class="card-title">Card title</h5>-->
<!--            <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>-->
<!--            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="card">-->
<!--        <img class="card-img-top" src="..." alt="Card image cap">-->
<!--        <div class="card-body">-->
<!--            <h5 class="card-title">Card title</h5>-->
<!--            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>-->
<!--            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

</body>
</html>