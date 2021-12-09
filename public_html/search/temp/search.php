<!DOCTYPE html>
<html>
<?php include "../nav.php"?>
<link rel="stylesheet" href="search.css">

	<body class = "search"><br>
	<div class="search-container">
    <form action="search.php" method="POST">
      By Club Name: <input type="text" placeholder="Search.." name="search" style="width: 30%"><i class="fa fa-search"></i>
	<input type="submit" value="submit" style="background-color: #FBC010;;">
    </form>
  </div>
 </br>
 </br>
 </br>

<?php
	include("../connect/connect_db.php"); /*Connect to Database*/
	
	//Get size of the tags
	$tag="SELECT count(DISTINCT name) as count FROM ClubTags";
	$t=mysqli_query($conn, $tag);
	$trow=mysqli_fetch_array($t);
	$tagSize = $trow['count'];
	
	$check = 1;
	$checkNum = -1;
	//Gets response from the club sorting button
	$cName=$_POST['clubName'][0];
	if($cName == "Name"){
		$cName = 'clubName';
		$checkNum = $tagSize+1;
		$check = 2;
	}
	
	//Get the corresponding tags order button to corresponding array
	$tag="SELECT DISTINCT name FROM ClubTags";
	$t=mysqli_query($conn, $tag);
	$counter = 0;
	while($trow=mysqli_fetch_array($t)){
		$arr[] = $_POST[$trow['name']];
		if(!(empty($arr[$counter]))) {
			$checkNum = $counter;
			$check = 2;
		}
		$counter++;
	}
	
	$dirNum = -1;
	//Get corresponding direction
	for($x=0; $x <$tagSize+1; $x++) {
		$arrDir[] = $_POST['DIR'.$x];
		$arrow[]="";
		if($x == $tagSize) {
			$arrDir[]=$_POST['clubName'][2];
			$arrow[]="";
		}
		if(!(empty($arrDir[$x])))
			$dirNum = $x;
	}

	$arrow;
	//Means sort has not been pressed
	if($check == 1) {
		$result = $conn->real_escape_string($_POST['search']);
		$rtnSearch = $result;
		if($dirNum != -1)
			$checkNum = $dirNum;
		else {
			$arrDir[$tagSize+1] = "ASC";
			$arrow[$tagSize+1] = "arrow down";
		}
	}
	//Sort has been pressed: Keep previous search
	else
	{
		//It is value from cName
		if($checkNum > $tagSize) {
			$rtnSearch=$_POST['clubName'][1];
			//Change direction
			if(empty($arrDir[$checkNum])) { 
				$arrDir[$checkNum]="ASC";
				$arrow[$checkNum]="arrow down";
			}
			else if($arrDir[$checkNum]=="ASC") {
				$arrDir[$checkNum]="DESC";
				$arrow[$checkNum]="arrow up";
			}
			else {
				$arrDir[$checkNum]="ASC";
				$arrow[$checkNum]="arrow down";
			}
		}
		//One of the tags has been pressed
		else {
			$rtnSearch=$_POST['rtnSearch'.$checkNum];

			//Change the asc and des
			if(empty($arrDir[$checkNum])){
				$arrDir[$checkNum]="ASC";
				$arrow[$checkNum]="arrow down";
			}
			else if($arrDir[$checkNum]=="ASC"){
				$arrDir[$checkNum] = "DESC";
				$arrow[$checkNum]="arrow up";
			}
			else {
				$arrDir[$checkNum] = "ASC";
				$arrow[$checkNum]="arrow down";
			}
		}
		$result = $rtnSearch;
	}
	
	/*SQL command to search through the database using search result */
	if(empty($result)){
		$cNnoTag="SELECT distinct clubName FROM ClubTags order by clubName ";
		$cNTag="SELECT clubName FROM ClubTags where name='".$arr[$checkNum]."' order by value ";
	}
	else {
		$cNnoTag="SELECT distinct clubName FROM ClubTags where clubName like '%".$result."%' order by clubName";
		$cNTag="SELECT clubName FROM ClubTags where clubName like '%".$result."%' and name='".$arr[$checkNum]."' order by value ";
	}
	
	//Set query to corresponding input
	//Name sort
	if($checkNum == 9)
		$query=$cNnoTag." ".$arrDir[$tagSize+1];
	//Tag sort
	else if($checkNum >=0 && $checkNum < $tagSize)
		$query=$cNTag." ".$arrDir[$checkNum];
	//None or search no sort
	else 
		$query=$cNnoTag;

	echo 'Your search result:'.$result;

	/*Search through database to get distinct names of ClubTags */
	$tag="SELECT DISTINCT name FROM ClubTags";
	$t=mysqli_query($conn, $tag);
	/*Finding the number of tags + Name header*/
	$NumTag = 1;
	while($trow=mysqli_fetch_array($t)){
		$NumTag++;
	}
	/*Table header format*/
	$sort=0;
	$t=mysqli_query($conn, $tag);
	echo '<table ID="Club">
		<thead>
		<tr><th><form action="search.php" method="POST"><input style="width:100%; cursor:pointer;" type="submit" value="Name" name="clubName[]"><i class="'.$arrow[$tagSize+1].'"></i>
		<input type="hidden" value="'.$rtnSearch.'" name="clubName[]">
		<input type="hidden" value="'.$arrDir[$tagSize+1].'" name="clubName[]">
		</form></th>';
		
		$rtnNum =0;
		while($trow=mysqli_fetch_array($t)){
		echo '<th>
			<form action="search.php" method="POST">
			<input style="width:100%; cursor:pointer;" type="submit" value="'.$trow['name'].'" name="'.$trow['name'].'"><i class="'.$arrow[$rtnNum].'"></i>
			<input type="hidden" value="'.$rtnSearch.'" name="rtnSearch'.$rtnNum.'">
			<input type="hidden" value="'.$arrDir[$rtnNum].'" name="DIR'.$rtnNum.'"></form></th>';
			$rtnNum++;
		}
	echo '</tr></thead>';
	
	//Display the data in table
	$r=mysqli_query($conn, $query);/*Connect to database to search query for Club */
	while($row=mysqli_fetch_array($r)){/*Fetch the tuple of data until there is no more tuple*/
		echo '<tr>';
		
		//Calls the collapse and modal element from the file
		include "collapseModal.php";
		
		/*Get Tags again to display the values on table*/
		$tag="SELECT value FROM ClubTags where clubName='".$row['clubName']."'";
		$t=mysqli_query($conn, $tag);
		while($trow=mysqli_fetch_array($t)){
		echo '<td class="main" style="text-align:center">'.$trow['value'].'</td>';
		}
		echo '</tr>';
	}
	echo'</table>';
?>
<!-This calls javascript functions ->
<script type="text/javascript" src="search.js"></script>

	<br></br>

	</body>
	<footer>
  <p class ="foot"><sub>&copy;2021</sub></p>
</footer>
</html>
