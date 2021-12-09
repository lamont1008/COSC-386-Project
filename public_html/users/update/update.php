<!DOCTYPE html>
<?php
include("../../connect/connect_db.php"); 
if(isset($_POST['clubs'])) {
      $c = $_POST['clubs'];
  } else {
      $c = $_POST['ch'];
  }

	//Update club
    if($_POST['upClub'] == "sent") {
   $clubN = "update Club set clubWebsite = '".$_POST['cWeb']."', description = '".$_POST['cDescript']."' where clubName = '".$c."'";
        $sqlQ = mysqli_query($conn,$clubN);
        $clubN = "update Meetings set location = '".$_POST['meetLoc']."', dateTime = '".$_POST['meetDt']."' where clubName = '".$c."'";
        $sqlQ = mysqli_query($conn,$clubN);
        $clubN = "update Faculty_Advisor set name = '".$_POST['fan']."', email = '".$_POST['fae']."' , deptAffiliation = '".$_POST['fad']."' 
        where clubName = '".$c."'";
        $sqlQ = mysqli_query($conn,$clubN);
        $dist = "Select distinct name from ClubTags";
        $sqlQ = mysqli_query($conn,$dist);

        while($row = mysqli_fetch_array($sqlQ)) {
            $clubN = "update ClubTags set value = '".$_POST[$row['name']]."' where clubName = '".$c."' and name = '".$row['name']."'";
        $sql2 = mysqli_query($conn,$clubN); 
     } 
    }

	//Update member
    if($_POST['downClub'] == "sent" && $_POST['sName'] != "") {
        $clubN = "update Members set studentName = '".$_POST['sName']."', semesterJoined = '".$_POST['sJoin']."',
        major = '".$_POST['major']."', position = '".$_POST['pos']."', email = '".$_POST['email']."' where clubName = '".$c."'";
        $sqlQ = mysqli_query($conn,$clubN);
    }


include "../adminNav.php";
?>
<link rel="stylesheet" href="update.css" type="text/css"/>
<div class="box">

<?php
//Get club name
echo '<form action = "update.php" method= "POST">';
echo '<label> Club Name: </labe><input type="text" id = "clubs"  value ="'.$c.'"name="clubs" placeholder="Club name">';
echo '<input type = "hidden" id = "ch" name = "ch" value = "'.$c.'">';
echo '<input type = "submit" name = "submit" value = "submit">';
echo '</form></br>'; 

?>
<?php
//Check if club exists in the database
$sqlC = "Select clubName from Club";
$sqlQ = mysqli_query($conn,$sqlC);
$b = false;
while($row = mysqli_fetch_array($sqlQ)) {
    if(strcasecmp($row['clubName'], $c) == 0) {
		$c = $row['clubName'];
        $b = true;
        break;
    }
}
if($b == false && isset($_POST['submit'])){
    echo '<div class="check">Invalid Club</div>';
}
else if($b){
//Club and member switch button
    echo'Club Name: '.$c;
	echo '<br><br>';
	echo '<b style="cursor:pointer;" onclick="display(\'up\')" id="butup">Club</b>
	<b style="cursor:pointer;" onclick="display(\'down\')" id="butdown">Members</b>';
echo '<div class = "upClub" id="up">';

$upQ = "Select * from Club where clubName = '".$c."'";
$sqlQ = mysqli_query($conn,$upQ);

$row= mysqli_fetch_array($sqlQ);
echo'<br></br>';
echo '<form action = "update.php" method = "POST">
<div class="row">
<div class="column"><div class="right">Club Description: </div></div>
<div class="column"><div class="left"><textarea type="text" placeholder="Club description" name="cDescript" value ="'.$row['description'].'" style="width: 100%;">'.$row['description'].'</textarea>
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Club Website: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Club website" name="cWeb" value="'.$row['clubWebsite'].'" style="width: 100%;">
</div></div><br></div>
';
$upQ = "Select * from Meetings where clubName = '".$c."'";
$sqlQ = mysqli_query($conn,$upQ);

$row= mysqli_fetch_array($sqlQ);

echo '
<div class="row">
<div class="column"><div class="right">Meeting Location: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Meeting location" name="meetLoc" value="'.$row['location'].'" required style="width: 100%;">
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Meeting Date/Time: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Meeting date/time" name="meetDt" value="'.$row['dateTime'].'" style="width: 100%;">
</div></div><br></div>';

$upQ = "Select * from Faculty_Advisor where clubName = '".$c."'";
$sqlQ = mysqli_query($conn,$upQ);

$row= mysqli_fetch_array($sqlQ);

echo '
<div class="row">
<div class="column"><div class="right">Faculty Advisor Name: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Faculty advisor name" name="fan" value="'.$row['name'].'" required style="width: 100%;">
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Faculty Advisor Email: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Faculty advisor email" name="fae" value="'.$row['email'].'" required style="width: 100%;">
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Faculty Advisor Dept: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Faculty advisor department" name="fad" value="'.$row['deptAffiliation'].'" style="width: 100%;">
</div></div><br></div>';

$upQ = "Select distinct name from ClubTags";
$sqlQ = mysqli_query($conn,$upQ);
echo '<h3>Tags</h3>';
while($row = mysqli_fetch_array($sqlQ)) {
    echo '<div class="row">
	<div class="column"><div class="right">'.$row['name'].': </div></div>';
    $inQ = "Select * from ClubTags where clubName ='".$c."' and name = '".$row['name']."'";
    $inSql = mysqli_query($conn, $inQ);
    $inrow = mysqli_fetch_array($inSql);
	echo '<div class="column"><div class="left"><input type="text" placeholder="# 0-1" name="'.$row['name'].'" value="'.$inrow['value'].'"><i class="fa fa-search"></i>
	</div></div><br></div>';
}

echo '<input type = "hidden" name = "ch" value = "'.$c.'">';

echo '
<input type = "submit" name = "upClub" value ="sent">
</form>';
echo '</div>

<div class="upMem" id="down">
<form action = "update.php" method = "POST">';

if(isset($_POST['student'])) {
    $s = $_POST['student'];
} else {
    $s = $_POST['sh'];
}

echo '<br><br>
<div class="row">
<div class="column"><div class="right">Student Searching:</div></div>
<div class="column"><div class="left"><input type = "text" placeholder="Student name" name = "student" value="'.$s.'" id = "student" style="width:50%"><i class="fa fa-search"></i>
</div></div><br></div>
<input type="hidden" name = "sh" id = "sh" value="'.$s.'">';

echo '<input type = "hidden" name = "ch" value = "'.$c.'">';
echo '<input type = "submit" name = "ss" value ="submit">';
echo '</form>';
$upQ = "Select * from Members where clubName = '".$c."' and studentName like '".$s."'";
$sqlQ = mysqli_query($conn,$upQ);

$row = mysqli_fetch_array($sqlQ);

$upQ = "Select * from Members where clubName = '".$c."'";
$sql = mysqli_query($conn,$upQ);
$y = False;
while($row2 = mysqli_fetch_array($sql)) {
    if(strcasecmp($row2['studentName'], $s) == 0) {
		$s = $row2['studentName'];
        $y = True;
    }
}

if($y) {
echo '<br><br>';
echo '<form action = "update.php" method = "POST">
<div class="row">
<div class="column"><div class="right">Student Name: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Student name" name="sName" value="'.$row['studentName'].'" required style="width:50%"><i class="fa fa-search"></i>
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Semester Join: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Semester Join" name="sJoin" value="'.$row['semesterJoined'].'" style="width:50%"><i class="fa fa-search"></i>
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Major: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Major" name="major" value="'.$row['major'].'" style="width:50%"><i class="fa fa-search"></i>
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Position: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Position" name="pos" value="'.$row['position'].'" style="width:50%"><i class="fa fa-search"></i>
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Email: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Email" name="email" value="'.$row['email'].'" required style="width:50%"><i class="fa fa-search"></i>
</div></div><br></div>

<input type="hidden" name = "sh" id = "sh" value="'.$s.'">';

echo '<input type = "hidden" name = "ch" value = "'.$c.'">';
echo '<input type = "submit" name = "downClub" value ="sent">';
}
}
?>
</form>

</div>

	<script>
		window.onload = function(){
			var x = localStorage.getItem("display");
			if(x)
				display(x);
			else
				display("up");
		}
	
		function display(x){
			if(x === "up"){
                var b = document.getElementById("butdown");
				var c = document.getElementById("down");
			}else{
                var b = document.getElementById("butup");
				var c = document.getElementById("up");
			}
			if(c){
				c.style.display = "none";
                b.classList.remove("active");
			}
			localStorage.setItem("display", x);
			var d=document.getElementById(x);
			d.style.display="block";	
            var bOpposit = document.getElementById("but"+x);
			bOpposit.classList.add("active");
		}
    </script>

    
</div>
</div>
</html>
