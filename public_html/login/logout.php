<?php
//Start session to reset the session variable
session_start();
//reset
session_unset();
//Go to login page
echo '<script>window.location="login.php"</script>';
?>