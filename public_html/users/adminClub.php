<?php
	//Connect to database
	if(!include('../connect/connect_db.php'))
		include '../../connect/connect_db.php';
	
	$query='select clubName from Club';
	$sql=mysqli_query($conn, $query);
	echo '<tr class="modalth">';
	$coll = 0;
	$maxCol = 7;
	while($row=mysqli_fetch_array($sql)){
		$temp = 0;
		while($temp == 0){
		if($coll == $maxCol){
			$coll = 0;
			echo '<td class="modaltd" style="border-style:none"></td></tr>
			<tr class="modalth"><td class="modaltd" style="border-style:none"></td>';
		}
		else if($coll %2 == 1){
			echo '<td class="modaltd">'.$row['clubName'].'</td>';
			$temp = 1;
		}
		else{
			echo '<td class="modaltd" style="border-style:none"></td>';
		}
		$coll++;
		}
	}
	echo '</tr>';
?>