<?php
/*writes session variables takes in a post request from the login page*/
session_start();
if (isset($_POST['email'])) {$_SESSION['email'] = $_POST['email'];}

?>