<?php
error_reporting(E_ALL ^ E_NOTICE );
error_reporting(E_ERROR | E_PARSE);
//session based login system
session_start();
?>



<?php



if (!isset($_SESSION['logged_in']))
    header("Location: login.php");

$conn = mysqli_connect("127.0.0.1","root","","Research-Conclave");

    $query1 = mysqli_query($conn,"SELECT * FROM PosterPresentation");
    $query2 = mysqli_query($conn,"SELECT * FROM OralPresentation");

    $flag=0;
    while($row11 = mysqli_fetch_assoc($query1))
    {
        if($row11['Approved']==0)
        {
            $flag=1;
            ?> <div class="jumbotron">
            <h1>Report Generation is on the way as all abstracts are not reviewed yet!</h1>
            </div>
            <?php
            return;
        }
        if($row11['Marks1']===NULL||$row11['Marks2']===NULL)
        {
            $flag=1;
            ?> <div class="jumbotron">
            Report Generation is on the way as all abstracts are not reviewed yet!
            </div>
            <?php
            return;
        }
    }
    while($row12 = mysqli_fetch_assoc($query2))
    {
        if($row12['Approved']==0)
        {
            $flag=1;
            ?> <div class="jumbotron">
            Report Generation is on the way as all abstracts are not reviewed yet!
            </div>
            <?php
            return;
        }
        if($row12['Marks1']===NULL||$row12['Marks2']===NULL)
        {
            $flag=1;
            ?> <div class="jumbotron">
            Report Generation is on the way as all abstracts are not reviewed yet!
            </div>
            <?php
            return;
        }
    }

    if($flag==0)
    {

//        $pdf->SetTitle('Report of Participant',true);
        $query1 = mysqli_query($conn,"SELECT * FROM PosterPresentation");
        $query2 = mysqli_query($conn,"SELECT * FROM OralPresentation");
        require ("../fpdf181/fpdf.php");
        $pdf = new FPDF('p','mm','A3');
        $pdf->AddPage();

//        $pdf->SetTitle('Report of Participants',true);
//        $pdf->SetTitle("Report of Participants",false);
        $pdf->SetFont('Arial','IB',20);
        $pdf->Cell(280,25,"Report of Participants",0,1,'C');
        $pdf->SetFont('Arial','B',14);
        $pdf->cell(40,10,"Name",1,0,'C');
        $pdf->cell(50,10,"Email",1,0,'C');
        $pdf->cell(30,10,"Type",1,0,'C');
        $pdf->cell(40,10,"Reviewer1",1,0,'C');
        $pdf->cell(40,10,"Reviewer2",1,0,'C');
        $pdf->cell(20,10,"Marks 1",1,0,'C');
        $pdf->cell(20,10,"Marks 2",1,0,'C');
        $pdf->cell(40,10,"Average Marks",1,1,'C');

        $pdf->SetFont('Arial','',14);

        while($row1 = mysqli_fetch_array($query1))
        {
            $username_participant = $row1['Username'];
            $username_r1 = $row1['Reviewer1'];
            $username_r2 = $row1['Reviewer2'];

//            $pdf->cell(40,10,"Average Marks",1,1,'C');

            $sql1 = mysqli_query($conn,"SELECT * FROM Participants WHERE username ='$username_participant'");
            $sql2 = mysqli_query($conn,"SELECT * FROM Reviewer WHERE Username ='$username_r1'");
            $sql3 = mysqli_query($conn,"SELECT * FROM Reviewer WHERE Username ='$username_r2'");

            $row4 = mysqli_fetch_assoc($sql1);
            $row5 = mysqli_fetch_assoc($sql2);
            $row6 = mysqli_fetch_assoc($sql3);

            $marks_1 = $row1['Marks1'];
            $marks_2 = $row1['Marks2'];

            $marks_avg = ($marks_1 + $marks_2)/2;

            $pdf->cell(40,10,$row4['Name'],1,0,'C');
            $pdf->cell(50,10,$row4['email'],1,0,'C');
            $pdf->cell(30,10,"Poster",1,0,'C');
            $pdf->cell(40,10,$row5['Name'],1,0,'C');
            $pdf->cell(40,10,$row6['Name'],1,0,'C');
            $pdf->cell(20,10,$row1['Marks1'],1,0,'C');
            $pdf->cell(20,10,$row1['Marks2'],1,0,'C');
            $pdf->cell(40,10,$marks_avg,1,1,'C');
        }

        while($row2 = mysqli_fetch_array($query2))
        {
            $username_participant = $row2['Username'];
            $username_r1 = $row2['Reviewer1'];
            $username_r2 = $row2['Reviewer2'];

            $sql4 = mysqli_query($conn,"SELECT * FROM Participants WHERE username ='$username_participant'");
            $sql5 = mysqli_query($conn,"SELECT * FROM Reviewer WHERE Username ='$username_r1'");
            $sql6 = mysqli_query($conn,"SELECT * FROM Reviewer WHERE Username ='$username_r2'");

            $row4 = mysqli_fetch_assoc($sql4);
            $row5 = mysqli_fetch_assoc($sql5);
            $row6 = mysqli_fetch_assoc($sql6);

            $marks_1 = $row2['Marks1'];
            $marks_2 = $row2['Marks2'];

            $marks_avg = ($marks_1 + $marks_2)/2;

            $pdf->cell(40,10,$row4['Name'],1,0,'C');
            $pdf->cell(50,10,$row4['email'],1,0,'C');
            $pdf->cell(30,10,"Oral",1,0,'C');
            $pdf->cell(40,10,$row5['Name'],1,0,'C');
            $pdf->cell(40,10,$row6['Name'],1,0,'C');
            $pdf->cell(20,10,$row2['Marks1'],1,0,'C');
            $pdf->cell(20,10,$row2['Marks2'],1,0,'C');
            $pdf->cell(40,10,$marks_avg,1,1,'C');
        }

        $pdf->Output();
    }

    if($flag==1)
    {
?> <div>
        <h1>Report Generation is on the way as all abstracts are not reviewed yet!</h1>
</div>
<?php
    }
?>
