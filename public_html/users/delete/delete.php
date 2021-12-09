<?php

	session_start(); 
?>

<!DOCTYPE html> 
<html>
	<?php
	include "../adminNav.php";
	?>
	
	
	<div class="box">
		<b style="cursor:pointer;" onclick="Display('up')" id="butup">Club</b>
		<b style="cursor:pointer;" onclick="Display('down')" id="butdown">Members</b>
		<br>
	<body class = "search">
	<br>
	<div class = "deleteheader">
		Delete Database Information
	</div>
	</br>
	<div class = "deleteClub">
		Input your Club to Delete:
			<div class = "input">
				<form action= "delete.php" id = "clubname" method="POST">
					<input type="text" placeholder="Club Name" name = "searchClubName" id="searchClubName" style="width:50%">
					<input type="submit" value = "Submit" name = "Submit" />
				</form>
			</div>
	</div>
	<div class = "deleteMember">
		<div class = "input"> 
			<form action= "delete.php" id = "member" method="POST">
				Input a Club and member to Delete:<br>
				<input type="text" placeholder="Club Name" name = "searchClubinMemberName" id="searchClubinMemberName" style="width:50%">
				<input type="text" placeholder="Member Name" name = "searchMemberName" id="searchMemberName" style="width:50%">
				<br>
				<input type="submit" value = "Submit" name = "Submit2"/>
			</form>
		</div>
	</div>
	<br>
	<div class = "deleteClub">
		<b> Club information </b>
			<br>

				<?php 

					include "../../connect/connect_db.php";

					if(!$conn) {

						die("Could not connect".mysqli_error());

					} 

					if(isset($_POST['Submit'])) {

						$clubname = $_POST['searchClubName'];
						$_SESSION['clubname'] = $clubname;
						
					}

					if(isset($_SESSION['clubname'])) {

						$club = $_SESSION['clubname'];
						
						$clubQuery = mysqli_query($conn, "SELECT * from Club where clubName = '".$club."'");


					}

				while($rows = mysqli_fetch_array($clubQuery)) {

				?>
		
					<p>
						<table>
							<thead>
					<tr><th style='text-align:left'> Club Name: <span style='font-weight:normal'> <?php echo $rows['clubName']; ?> </span></th></tr>
					<tr><th style='text-align:left'> Club Website: <span style='font-weight:normal'> <?php echo $rows['clubWebsite']; ?> </span></th></tr>
					<tr><th style='text-align:left'> Club Description: <span style='font-weight:normal'> <?php echo $rows['description']; ?></span></th></tr>
					<tr><th style='text-align:left'> <a href ='deleteclub.php'> <span style='text-align: center'> Click here to delete </span> </a></th></tr>
							</thead>
						</table>
					</p>

			<?php

				}

			?>
	</div>
	<div class = "deleteMember">
		<b> Member Information </b> 
		<br> 

		<?php

			include "../../connect/connect_db.php";

			if(!$conn) {

				die("Could not connect".mysqli_error());

			} 

			if(isset($_POST['Submit2'])) {

				$memberName = $_POST['searchMemberName'];
				$clubName = $_POST['searchClubinMemberName'];
				$memberClubQuery = mysqli_query($conn, "SELECT clubName, studentName from Members where studentName like '%".$memberName."%' and clubName = '".$clubName."'"); 

	
			}

				


			while($memRows = mysqli_fetch_array($memberClubQuery)) {

			?>
				<p> 
					<table>
						<thead> 
						<tr><th style='text-align:left'> Member name: <span style='font-weight:normal'> <?php echo $memRows['studentName']; ?> </span></th></tr>
						<tr><th style='text-align:left'> Club: <span style='font-weight:normal'> <?php echo $memRows['clubName']; ?> </span></th></tr>
						<tr><th style='text-align:left'> <a href ='deletemember.php?studentName=<?php echo str_replace(" ", "+", $memRows['studentName']);?>'> <span style='text-align: center'> Click here to delete </span> </a></th></tr>
							</thead>
						</table>
					</p>
			<?php
			}
		?>
	</div>
	<br></br>
	<br></br>
	<br></br>
	</body>
	</div>
	<script>
		window.onload = function(){
			var x = localStorage.getItem("dDisplay");
			if(x)
				Display(x);
			else
				Display('up');
		}
	
		function Display(x){
			var c = document.getElementsByClassName("deleteClub");
			var m = document.getElementsByClassName("deleteMember");
						
			if(x === 'up'){
				var b = document.getElementById("butdown");
				for(var i = 0; i < c.length; i++)
					c[i].style.display = "block";
				for(var i = 0; i < m.length; i++)
					m[i].style.display = "none";

			}
			else if(x === 'down'){
				var b = document.getElementById("butup");
				for(var i = 0; i < c.length; i++)
					c[i].style.display = "none";
				for(var i = 0; i < m.length; i++)
					m[i].style.display = "block";
			}
			b.classList.remove("active");
			var bOpposit = document.getElementById("but"+x);
			bOpposit.classList.add("active");
			
			localStorage.setItem("dDisplay", x);
		}
	
	</script>
</html>
