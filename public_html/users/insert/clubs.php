<!DOCTYPE html>
<body class = "background">
<?php 
session_start();
include("../../connect/connect_db.php"); 

?> 
<div class="check" id="ErrorName"></div>
<div class="check" id="ErrorTags"></div>



<?php
echo '
<form action = "insert.php" method = "POST"> 

<div class="row">
<div class="column"><div class="right">Club Name: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Club name" name="clubs" value ="'.$_POST['clubs'].'" required style="width: 50%;">
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Club Description: </div></div>
<div class="column"><div class="left"><textarea type="text" placeholder="Club description" name="cDescript" value="'.$_POST['cDescript'].'" style="width: 100%;">'.$_POST['cDescript'].'</textarea>
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Club Website: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Club website" name="cWeb" value="'.$_POST['cWeb'].'" style="width: 50%;">
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Meeting Location: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Meeting location" name="meetLoc" value="'.$_POST['meetLoc'].'" required style="width: 100%;">
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Meeting Date/Time: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Meeting date" name="meetDt" value="'.$_POST['meetDt'].'" style="width: 50%;">
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Faculty Advisor Name: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Faculty advisor name" name="fan" value="'.$_POST['fan'].'" style="width: 50%;">
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Faculty Advisor Email: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Faculty advisor email" name="fae" value="'.$_POST['fae'].'" required style="width: 50%;">
</div></div><br></div>

<div class="row">
<div class="column"><div class="right">Faculty Advisor Dept: </div></div>
<div class="column"><div class="left"><input type="text" placeholder="Faculty advisor department" name="fad" value="'.$_POST['fad'].'" style="width: 50%;">
</div></div><br></div>
';

$dist = "Select distinct name from ClubTags";
$sqlQ = mysqli_query($conn,$dist);
echo '<h3>Tags</h3>';
while($row = mysqli_fetch_array($sqlQ)) {
    echo '<div class="row">
			<div class="column"><div class="right">'.$row['name'].':</div></div> 
			<div class="column"><div class="left"><input type="text" placeholder="# 0-1" name="'.$row['name'].'" value="'.$_POST[$row['name']].'"><i class="fa fa-search"></i>
			</div></div><br></div>
    ';
}
echo '<input type = "submit" value = "submit" name ="submit" >
</form> ';
?>
</html>