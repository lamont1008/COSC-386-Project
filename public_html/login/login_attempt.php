<?php
/*this script takes in a form submission from the login page
it then searches the database for a valid email and password 
returns 1 on succes and null on false
need to add hashing to passwords
 */
include("../connect/connect_db.php");
if (mysqli_connect_errno()) {//test for connection errors
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

//$loggfile=fopen("logg.txt","a+");
//fwrite($loggfile,'opening log\n');//file io to keep track of things
$email=$_POST['email'];
$password=$_POST['password'];

if ($email==""){

        echo"ruiner";
        exit();
}
$sql="SELECT * from Users where email=\"$email\" and password=\"$password\""; //format query
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
if (($row['email']==$email) and ($row['password']==$password)){ //email and password match
       // fwrite($loggfile,$email);
       // fwrite($loggfile,$password);
       // fwrite($loggfile,"success\n");
       // fclose($loggfile);
        echo ("[0,\"$email\"]");
}
else{ //no match
       // fwrite($loggfile,$email);
       // fwrite($loggfile,$password);
       // fwrite($loggfile,"failure");
        //fclose($loggfile);
        echo ("[1]");
}
?>