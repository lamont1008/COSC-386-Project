<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script>
	 //Load the DB without having to redirect to the page

	$(document).ready(function(){
		sortDB('clubName');
	});

	 function sortDB(tag){
		$.ajax({
			type: 'post',
			url: 'sort.php',
			data: {sort:tag},
			success:function(result){
				$("#clubDB").html(result);
			}

		});
	 }

</script>
<?php include "../nav.php";
	include("../connect/connect_db.php"); /*Connect to Database*/
	session_start();
	if(isset($_POST['search']))
		$_SESSION['search'] = $_POST['search'];
?>
<link rel="stylesheet" href="search.css">

	<body class="search"><br>
	<div class="searchBorder">
	<div class="search-container">
    <form action="search.php" method="POST">
      By Club Name: <input type="text" placeholder="Search.." name="search" value="<?php $_SESSION['search'] ?>"><i class="fa fa-search"></i>
	  <input type="submit" value="submit">
    </form>
  </div>
 </br>
 </br>
 </br>



<?php
	echo 'Your search result:'.$_SESSION['search'];
	echo '<span id="clubDB"></span>';
	
	

?>



	<br></br>
	</div>
	</body>
	<footer>
  <p class ="foot"><sub>&copy;2021</sub></p>
</footer>
</html>
