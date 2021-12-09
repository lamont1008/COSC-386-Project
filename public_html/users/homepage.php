<!DOCTYPE html> 
<body class = "background">

<?php include "../nav.php";?>
<link rel="stylesheet" href="../search/search.css">

<?php 


	$s = ($_SESSION['email']);

	if(!isset($s))
		header("Location: ".$root."/login/login.php");

  include("../connect/connect_db.php"); 
	if(mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " .$mysqli -> connect_error;
		exit();
	}
	echo '<br>';
	$sqlN = "select distinct name from UserTags";
	$sqlQ = mysqli_query($conn,$sqlN); 
	 echo '<table class = "userTable">
	 <thead> 
	<tr>';  

	 while($row2= mysqli_fetch_array($sqlQ)) {
		echo '<th class = "userTab">'.$row2['name'].'</th>';
		$arr1[] = $row2['name'];
}

echo "</tr> </thead>"; 
	$sql =  "Select value from UserTags where username = '".$s."'";
	$result=mysqli_query($conn,$sql);
	echo "<tr>";
$k = 0;
while ($row=mysqli_fetch_array($result)) {
	echo '<td class ="userData">' .$row['value'].'</td>';
	$arr2[] = $row['value'];
} 
	echo "</tr> </table>";
$array = array_combine($arr1,$arr2);

$max1val = max($array);
$max1 = array_search($max1val, $array);
unset($arr[$max1]);

$max2val = max($array);
$max2 = array_search($max2val, $array);
unset($array[$max2]);

$max3val = max($array);
$max3 = array_search($max3val, $array);
unset($array[$max3]);

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


?>
<script type="text/javascript" src="../search/CollapseModal/search.js"></script>

</body>
</html>
