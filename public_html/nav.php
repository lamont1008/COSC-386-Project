<html>
<head>
	
	<?php
	//Root folder directory 
	$root = "/~kjenifer1";
	echo '<link rel="stylesheet" href="'.$root.'/SQL.css" type="text/css"/>';?>
		<title>Salisbury Club Database</title>
		<meta charset="UTF-8">
	</head>
	<div class="header">Salisbury Club Database</div>
	<?php
		session_start();
				header("Cache-Control: no-cache");
		header("Pragma: no-cache");
		if(isset($_SESSION['email'])){
			echo '<div class="header2"><a href="'.$root.'/login/logout.php">Logout</a></div><br>';
		}
		else {
			echo '<div class="header2"><a href="'.$root.'/login/login.php">Login</a></div><br>';
		}
	?>
	<br>
	<div class="topnav">

	<?php
	echo '<a id="'.$root.'/SQL.php" href="'.$root.'/SQL.php">Home</a>
	<a id="'.$root.'/search/search.php" href="'.$root.'/search/search.php" onclick="unset()">Search</a>
	<a id="'.$root.'/survey/survey.php" href="'.$root.'/survey/survey.php">Survey</a>';
	if(isset($_SESSION['email'])){
		if($_SESSION['email']!="admin"){
			echo '<a id="'.$root.'/users/homepage.php" href="'.$root.'/users/homepage.php">User</a>';

		}
		else{
			echo '<a id="'.$root.'/users/adminHome.php" href="'.$root.'/users/adminHome.php">Admin</a>';
		}
	}
	?>
	</div>
	<script>
	//Get current file location
	var loc = window.location.pathname;
	//if location is inside survey folder
	if(loc.includes("survey"))
	{
		loc = "<?php Print($root)?>/survey/survey.php";
	}
	else if(loc.includes("users"))
	{
		if(loc.includes("homepage.php")){
			loc = "<?php Print($root)?>/users/homepage.php";
		}
		else{
			loc = "<?php Print($root)?>/users/adminHome.php";
		}
	}
	
	var id = document.getElementById(loc);
	id.classList.add("active");
	
	//Unset admin update variable
	//Need to delete since it will remain on cache forever
	var update = window.location.pathname;
	if(!(update.includes("update"))){
		localStorage.removeItem("display");
	}
	if(!(update.includes("insert"))){
		localStorage.removeItem("iDisplay");
	}
	
	if(!(update.includes("delete"))){
		localStorage.removeItem("dDisplay");
	}
	if(update.includes("search"))
		<?php 
			unset($_SESSION['search']);
				unset($_SESSION['tag']); ?>

	function unset(){
		<?php
			$sql = "Select distinct name from ClubTags";
			$r = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($r)){
				unset($_SESSION[$row['name']]);
			}
			unset($_SESSION['clubName']);
			unset($_SESSION['search']);
		?>
	}
	</script>
</html>
