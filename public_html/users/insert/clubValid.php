
<?php 

include("../../connect/connect_db.php"); 
$cl = "Select clubName from Club";
$sqlQ = mysqli_query($conn,$cl);

while($row = mysqli_fetch_array($sqlQ)) {
    if($_POST['clubs'] == $row['clubName']) {
        $check = 1;
        break;
    }
}

$dist = "Select distinct name from ClubTags";
$sqlQ = mysqli_query($conn,$dist);


while($row = mysqli_fetch_array($sqlQ)) {
    if(!empty($_POST[$row['name']])){
        if(is_numeric( $_POST[$row['name']])) {
            if( $_POST[$row['name']] > 1 ||  $_POST[$row['name']] < 0) {
                $tags = 1;
            }
        } else {
            $tags = 1;
        }
    }
}

?>