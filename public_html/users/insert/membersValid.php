
<?php 
$check = 0;

include("../../connect/connect_db.php"); 
$cl = "Select email from Members where clubName = '".$c."'";
$sqlQ = mysqli_query($conn,$cl);

while($row = mysqli_fetch_array($sq1Q)) {
    if(strcasecmp($_POST['email'], $row['email'])==0) {
        $check = 1;
    }
}

?>
