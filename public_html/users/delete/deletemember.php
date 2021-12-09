<?php 

    session_start(); 

    include "../../connect/connect_db.php";

    if(!$conn) {

		die("Could not connect".mysqli_error());

    }

    if(!empty($_GET['studentName'])) {

        $student = $_GET['studentName'];

        echo $studentName;
    
        $student = mysqli_real_escape_string($conn, $student);
    
        $studentQ = mysqli_query($conn, "DELETE from Members where studentName = '".$student."'");
    
        if($studentQ) {
    
            mysqli_close($conn);
            header('location:delete.php');
            exit;
    
        } else {
    
            echo "Deletion failed";
    
        }
    }
    
?>