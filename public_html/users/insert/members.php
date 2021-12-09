<!DOCTYPE html>
<body class = "background">

<?php 
session_start();
if(empty($_POST['clubs'])) {
	if(!(empty($_POST['hid'])))
		$c = $_POST['hid'];
	else
		$c = $_SESSION['clubs'];
} else {
    $c = $_POST['clubs'];
}

echo '<form action="insert.php" method="POST">
Enter Club: <input type="text" name="clubs" value="'.$c.'" placeholder="Club name">
<input type="submit" name="msubmit" value="submit">
</form>';

echo '<div class="check" id="ErrorEmail"></div>';

$sqlIn = "Select clubName from Club";
$IN = mysqli_query($conn, $sqlIn);
$checkClub = 1;
while($rowIN = mysqli_fetch_array($IN)){
	if(strcasecmp($c, $rowIN['clubName'])==0){
		$c = $rowIN['clubName'];
		$checkClub = 2;
		break;
	}
}
if(isset($_POST['msubmit'])){
if($checkClub == 1){
	echo '<div class="check">Invalid club</div>';
}
else{
echo '
<form action="insert.php" method="POST">

<div class="row">
<div class="column"><div class="right">Student Name: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Student name" name="sName" value="'.$_POST['sName'].'" required style="width: 50%;">
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Semester Joined: </div></div>
<div class="column"><div class="left"><select  name="Semester">
<option value="Fall">Fall</option>
<option value="Spring">Spring</option>
</select>
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Semester Year: </div></div>
<div class="column"><div class="left"><input type="text" pattern="\d*" minlength="4" maxlength="4" placeholder="Semester year" name="sJoin" value="'.$_POST['sJoin'].'" style="width: 50%;">
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Major: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Major" name="major" value="'.$_POST['major'].'" style="width: 50%;">
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Position: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Position" name="pos" value="'.$_POST['pos'].'" style="width: 50%;">
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Email: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Email" name="email" value="'.$_POST['email'].'" required style="width: 50%;">
</div></div><br></div>

<input type="hidden" name = "hid" value="'.$c.'">
<input type = "submit" value = "submit" name = "ssubmit">
</form> ';
}}
unset($_SESSION['clubs']);
?>

</html>
