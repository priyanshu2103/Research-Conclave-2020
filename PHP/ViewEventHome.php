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
<div class="jumbotron">
    <h1 style="text-align: center">Poster Presentation</h1>
    <h4>Start Date: <?php echo $posterStart;?></h4>
    <h4>End Date: <?php echo $posterEnd?></h4>
    <p style="margin-top: 20px"><?php echo $desription_poster; ?></p>
</div>
<div class="jumbotron">
    <h1 style="text-align: center">Oral Presentation</h1>
    <h4>Start Date: <?php echo $oralStart;?></h4>
    <h4>End Date: <?php echo $oralEnd?></h4>
    <p style="margin-top: 20px"><?php echo $desription_oral; ?></p>
</div>

</body>
</html>