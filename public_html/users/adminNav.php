<!DOCTYPE html>
<html>
<?php
	if(!include('../nav.php'))
		include('../../nav.php');

	if($_SESSION['email'] != 'admin'){
		header("Location: ".$root."/login/login.php");
	}
?>

<body class = "background">
        <br>
        <div class="adminNav">
			<?php
			echo '
			<a href="'.$root.'/users/adminHome.php" id="'.$root.'/users/adminHome.php">Home</a>
			<a href="'.$root.'/users/insert/insert.php" id="'.$root.'/users/insert/insert.php">Insert</a>
			<a href="'.$root.'/users/update/update.php" id="'.$root.'/users/update/update.php">Update</a>
			<a href="'.$root.'/users/delete/delete.php" id="'.$root.'/users/delete/delete.php">Delete</a>
			<a style="cursor:pointer;" onclick="cmDisplay(\'mc\', \'sc\')">Club List</a>
			<a style="cursor:pointer;" onclick="cmDisplay(\'mm\', \'sm\')">Member List</a>
			<link rel="stylesheet" href="'.$root.'/users/clubModal.css">
			';
			?>

			<div class = "modal" id="mc">
				<div class="modal-content">
					<span class="close" id="sc">x</span>
						<p style="text-align:center; font-size: 40px"> Club Names </p>
						<table style="border:none;">
						<thead><tr><th class="modalth"></th>
						<th class="modalth"></th>
						<th class="modalth"></th>
						<th class="modalth"></th>
						<th class="modalth"></th>
						<th class="modalth"></th>
						<th class="modalth"></th><tr><thead>
								<?php
									if(!include('adminClub.php'))
										include('../adminClub.php');
								?>
						</table>
				</div>
			</div>
			<div class = "modal" id="mm">
				<div class="modal-content">
					<span class="close" id="sm">x</span>
						<p style="text-align:center; font-size: 40px"> Members </p>
						<table style="border:none;">
						<thead><tr><th class="modalth"></th>
						<th class="modalth" style="border-style:solid">Name</th>
						<th class="modalth" style="border-style:solid">Club</th>
						<th class="modalth"></th>
						<th class="modalth" style="border-style:solid">Name</th>
						<th class="modalth" style="border-style:solid">Club</th>
						<th class="modalth"></th><tr><thead>
								<?php
									if(!include('adminMember.php'))
										include('../adminMember.php');
								?>
						</table>
				</div>
			</div>
        </div>
</body>

<script>
	var admin = window.location.pathname;
	var adminID = document.getElementById(admin);
	adminID.classList.add("active");


	function cmDisplay(m, s){
		var modal = document.getElementById(m);
		var span = document.getElementById(s);
		modal.style.display = "block";
			span.onclick = function(){
				modal.style.display = "none";
			}
			window.onclick = function(event) {
				if(event.target === modal) {
					modal.style.display = "none";
				}
			}
	}
</script>
</html>