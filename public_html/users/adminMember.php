<?php
	//Connect to database
	if(!include('../connect/connect_db.php'))
		include '../../connect/connect_db.php';
	
	$query='select studentName, clubName from Members';
	$sql=mysqli_query($conn, $query);
	echo '<tr class="modalth">';
	$coll = 0;
	$maxCol = 2;
	while($row=mysqli_fetch_array($sql)){
		if($coll == $maxCol){
			$coll = 0;
			echo '<td class="modaltd" style="border-style:none"></td></tr><tr class="modalth"><td class="modaltd" style="border-style:none"></td>
				<td class="modaltd">'.$row['studentName'].'</td>
					<td class="modaltd">'.$row['clubName'].'</td>';
	}
	else{
		echo '<td class="modaltd" style="border-style:none"></td>
				<td class="modaltd">'.$row['studentName'].'</td>
					<td class="modaltd">'.$row['clubName'].'</td>';
	}
	$coll++;
	}
	echo '</tr>';

?>