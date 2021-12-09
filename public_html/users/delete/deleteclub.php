<?php 

    session_start(); 

    include "../../connect/connect_db.php";

    if(!$conn) {

		die("Could not connect".mysqli_error());

    }

    $club =  $_SESSION['clubname'];

    $club = mysqli_real_escape_string($conn, $club);

    $meetingQ = mysqli_query($conn, "DELETE from Meetings WHERE clubName = '".$club."'");
    $facultyQ = mysqli_query($conn, "DELETE from Faculty_Advisor where clubName = '".$club."'");
    $clubtagsQ = mysqli_query($conn, "DELETE from ClubTags where clubName = '".$club."'");
    $memberQ = mysqli_query($conn, "DELETE from Members where clubName = '".$club."'");
    $clubQ = mysqli_query($conn, "DELETE from Club where clubName = '".$club."'");

    if($meetingQ and $facultyQ and $clubtagsQ and $memberQ and $clubQ) {

      mysqli_close($conn);
	    unset($_SESSION['clubname']);
      header("location:delete.php");
      exit;

    } else {

      echo "Deletion failed";
      
    }	


?>
