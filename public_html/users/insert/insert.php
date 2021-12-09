<!DOCTYPE html>
<style>
.row {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  width: 100%;
}

.column {
  display: flex;
  flex-direction: column;
  flex-basis: 100%;
  flex: 1;
}

.right {
	text-align: right;
	margin: 10px;
}

.left{
	text-align: left;
}

</style>

<body class = "background">
<?php 
include("../../connect/connect_db.php"); 
include "insertToDB.php";
include "../adminNav.php";
?>

<div class="box">

<b style="cursor:pointer;" onclick="display('up')" id="butup">Club</b>
<b style="cursor:pointer;" onclick="display('down')" id="butdown">Members</b>
<br></br>
<div class="upClub" id="up">
<?php
include "clubs.php";
?>


</div>


<div class="upMem" id="down">
<?php
include "members.php";
?>

</div>
</div>
</body>
	<script>
		window.onload = function(){
			var x = localStorage.getItem("iDisplay");
			if(x)
				display(x);
			else
				display("up");
		}
	
		function display(x){
			if(x === "up"){
				var b = document.getElementById("butdown");
				var c = document.getElementById("down");
			}else{
				var b = document.getElementById("butup");
				var c = document.getElementById("up");
			}
			if(c){
				c.style.display = "none";
				b.classList.remove("active");
			}
			localStorage.setItem("iDisplay", x);
			var d=document.getElementById(x);
			var bOpposit = document.getElementById("but"+x);
			bOpposit.classList.add("active");
			d.style.display="block";	
		}
    </script>
</html>
