<?php
session_start();
include("../../connect/connect_db.php"); 
$check = 0;

include "membersValid.php"; 
if(isset($_POST['ssubmit'])) {
    if($check == 0) {
        $clubN = 'insert into Members values ("'.$_POST['sName'].'","'.$_POST['Semester'].' '.$_POST['sJoin'].'","'.$_POST['major'].'"
        ,"'.$_POST['pos'].'" ,"'.$_POST['email'].'","'.$_POST['hid'].'")';
        $sqlQ = mysqli_query($conn,$clubN);
    } else {
        echo 'Error';
    }
	if($check == 1){
		echo '<script>
        window.addEventListener("load", function(){
        document.getElementById("ErrorEmail").innerHTML="Email is already registerd";
        });</script>';
	}
}

$check = 0;
$tags = 0;
include "clubValid.php"; 
if(!(empty($_POST['submit']))) {
    if($check == 0 && $tags == 0) {
        $clubN = 'insert into Club values ("'.$_POST['clubs'].'","'.$_POST['cWeb'].'","'.$_POST['cDescript'].'")';
        $sqlQ = mysqli_query($conn,$clubN);
        $meetC = 'insert into Meetings values ("'.$_POST['meetLoc'].'","'.$_POST['meetDt'].'","'.$_POST['clubs'].'")';
        $sqlQ = mysqli_query($conn,$meetC);
        $fac = 'insert into Faculty_Advisor values ("'.$_POST['fan'].'","'.$_POST['fae'].'","'.$_POST['fad'].'","'.$_POST['clubs'].'")';
        $sqlQ = mysqli_query($conn,$fac);
        $dist = "Select distinct name from ClubTags";
        $sqlQ = mysqli_query($conn,$dist);

        while($row = mysqli_fetch_array($sqlQ)) {
            if(!empty($_POST[$row['name']]))
                $set = $_POST[$row['name']];
            else
                $set = 0;

                $clubN = 'insert into ClubTags values ("'.$row['name'].'","'.$set.'","'.$_POST['clubs'].'")';

            $sql2 = mysqli_query($conn,$clubN);
        }
		$_SESSION['clubs']= $_POST['clubs'];
		?>

		<?php
        header("location:insert.php");
    }

	if($check == 1 ) {
        echo '<script>
        window.addEventListener("load", function(){
        document.getElementById("ErrorName").innerHTML="Club Name already in use!!!";
        });</script>';
    }
    if($tags == 1) {
        echo '<script>
        window.addEventListener("load", function(){
        document.getElementById("ErrorTags").innerHTML="Number must be between 0 and 1";
        });</script>';
    }
}
?>
