<!DOCTYPE html>

<html>

<?php include "../nav.php"?>

<link rel="stylesheet" href="../search/search.css">

<body class = "background">

<?php

$q1 = $_POST['q1'];
$q2 = $_POST['q2'];
$q3 = $_POST['q3'];
$q4 = $_POST['q4'];
$q5 = $_POST['q5'];
$q6 = $_POST['q6'];
$q7 = $_POST['q7'];
$q8 = $_POST['q8'];
$q9 = $_POST['q9'];
$q10 = $_POST['q10'];
$q11 = $_POST['q11'];
$q12 = $_POST['q12'];
$q13 = $_POST['q13'];

$sportScore=0;
$techScore=0;
$outScore=0;
$cultScore=0;
$creatScore=0;
$langScore=0;
$genScore=0;
$astronScore=0;




//Q1
if($q1 == 1)
{
        $sportScore += .4;
        $outScore += .3;
}


//Q2
if($q2 == 1)
{
        $techScore += .5;
}

//Q3
if($q3 == 1)
{
        $cultScore += .6;
        $langScore += .2;
}
//Q4
if($q4 == 1)
{
        $creatScore += .6;
}
else if($q4 == 2)
{
        $creatScore += .4;
}
else if($q4 == 3)
{
        $createScore += .1;
}
//Q5
if($q5 == 1)
{
        $outScore += .6;
}

//Q6
if($q6 == 1)
{
        $langScore += .6;
        $cultScore += .2;
}
//Q7
if($q7 == 1)
{
        $techScore += .5;
}

//Q8
if($q8 == 1)
{
        $sportScore += .8;
}
else if($q8 == 2)
{
        $sportScore += .6;
}
else if($q8 == 3)
{
        $sportScore += .3;
}

//Q9
if($q9 == 4)
{
        $genScore += .8;
}
else if($q9 == 3)
{
        $genScore += .6;
}
else if($q9 == 2)
{
        $genScore += .3;
}

//Q10
if($q10 == 1)
{
        $astronScore += .5;
}

//Q11
if($q11 == 1)
{
        $creatScore += .5;
}

//Q12
if($q12 == 1)
{
        $astronScore += .6;
}
else if($q12 == 2)
{
        $astronScore += .4;
}
else if($q12 == 3)
{
        $astronScore += .2;
}

//Q13
if($q13 == 1)
{
        $langScore += .6;
}
else if($q13 == 2)
{
        $langScore += .4;
}
else if($q13 == 3)
{
        $langScore += .2;
}




?>

<!--  #Test Prints for Score Values
        <h3 class ="survey" style="font-size: 30 px;">Scores:</h3>
        <p class = "survey">
                <br><?php echo "Outside: $outScore"    ?></br>
                <br><?php echo "Sports: $sportScore"    ?></br>
                <br><?php echo "Technology: $techScore"    ?></br>
                <br><?php  echo "Culture: $cultScore"   ?></br>
                <br><?php echo "Creative: $creatScore" ?></br>
                <br><?php echo "Language: $langScore" ?></br>
                <br><?php echo "Astronomy: $astronScore" ?></br>
                <br><?php echo "General-Ed: $genScore" ?></br>
        </p>

-->






<?php

$array = ["Outside" => $outScore, "Sports" => $sportScore,"Technology"=>$techScore,
        "Culture"=>$cultScore,"Creative"=>$creatScore,"Language"=>$langScore,"Space"=>$astronScore,
        "General-Ed"=>$genScore];


$max1val = max($array);
$max1 = array_search($max1val, $array);
unset($array[$max1]);

$max2val = max($array);
$max2 = array_search($max2val, $array);
unset($array[$max2]);

$max3val = max($array);
$max3 = array_search($max3val, $array);
unset($array[$max3]);

?>







<!--  #Test Prints for Max Values:

<p class = "survey">

        <br><?php echo"$max1: $max1val" ?></br>
        <br><?php echo"$max2: $max2val" ?></br>
        <br><?php echo"$max3: $max3val" ?></br>

</p>
-->




<?php

//Connect to database by file
include("../connect/connect_db.php");
if (mysqli_connect_errno()) {//test for connection errors
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$query = "select distinct clubName from ClubTags where (name = '".$max1."' && value > .5)
                or (name = '".$max2."' && value > .5) or
                (name = '".$max3."' && value > .5) order by clubName";



$t = mysqli_query($conn, $query);


echo" <h1 display: block; font-weight: bold; style ='text-align: center'>
        <mark style='background-color: white'>
          <u><b>
                Recomended Clubs:</mark></h1></u></b>";

echo "<table style ='-color = black; background-color: white; margin-left:auto; margin-right:auto'; border = '5'; bordercolor =#000000;'>
        <thead>
                <tr>
                        <th> Name </th>
                </tr>
        </thead>";
$counter=0;
while($row = mysqli_fetch_array($t))
{
        echo '<tr>';
        include "../search/CollapseModal/collapseModal.php";
        echo '</tr>';
}
echo "</table>";

//Need to start the session inorder to get session variables
session_start();
//If Session variable exists insert data to database
if(isset($_SESSION['email'])){

	//Since we did not include time as a attribute to user tag delete the previous tags associated with the user
	$query = "delete from UserTags where username='".$_SESSION['email']."'";
	$r = mysqli_query($conn, $query);
	
	//Insert all the new data
	$out='insert into UserTags values("Outside", "'.$outScore.'", "'.$_SESSION['email'].'")';
	$r = mysqli_query($conn, $out);

	$out='insert into UserTags values("Sports", "'.$sportScore.'", "'.$_SESSION['email'].'")';
	$r = mysqli_query($conn, $out);

	$out='insert into UserTags values("Technology", "'.$techScore.'", "'.$_SESSION['email'].'")';
	$r = mysqli_query($conn, $out);

	$out='insert into UserTags values("Multi-Cultural", "'.$cultScore.'", "'.$_SESSION['email'].'")';
	$r = mysqli_query($conn, $out);

	$out='insert into UserTags values("Creative", "'.$creatScore.'", "'.$_SESSION['email'].'")';
	$r = mysqli_query($conn, $out);

	$out='insert into UserTags values("Language", "'.$langScore.'", "'.$_SESSION['email'].'")';
	$r = mysqli_query($conn, $out);

	$out='insert into UserTags values("Space", "'.$astronScore.'", "'.$_SESSION['email'].'")';
	$r = mysqli_query($conn, $out);

	$out='insert into UserTags values("General-Ed", "'.$genScore.'", "'.$_SESSION['email'].'")';
	$r = mysqli_query($conn, $out);
        
}


?>

<script type="text/javascript" src="../search/CollapseModal/search.js"></script>


</body>
</html>
