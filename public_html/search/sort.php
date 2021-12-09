
<script>

function dirTag(tagId, dir){
	var element = document.getElementById(tagId);
	if(dir === 'desc'){
		element.style.setProperty("--bottom", "#000");
		element.style.setProperty("--top", "transparent");
	}
	else{
		element.style.setProperty("--bottom", "transparent");
		element.style.setProperty("--top", "#000");
	}
}

function disableDir(tagID){
	var element = document.getElementById(tagID);
	element.style.setProperty("--bottom", "transparent");
	element.style.setProperty("--top", "transparent");
}
</script>

<?php

    include '../connect/connect_db.php';
	session_start();

	//Get header tags to sort
    $sort = $_POST['sort'];

	//Initialize Session variable for search
	if(isset($_SESSION['search']))
		$search = $_SESSION['search'];
	else
		$search ="";

	//Initialize sort session or change direction
	if(isset($_SESSION[$sort])){
		if($_SESSION[$sort] == 'asc')
			$_SESSION[$sort] = 'desc';
		else
			$_SESSION[$sort] = 'asc';
	}
	else{
		$_SESSION[$sort] = 'asc';
	}
	$dir = $_SESSION[$sort];

	//Search through database to get distinct names of ClubTags
	$tag="SELECT DISTINCT name FROM ClubTags";
	$t=mysqli_query($conn, $tag);

	$size = 1;
	//Unsetting all the directions that are not currently being sorted
	if($sort != 'clubName'){
		unset($_SESSION['clubName']);
	}
	while($trow=mysqli_fetch_array($t)){
		$size++;
		if($trow['name'] != $sort)
			unset($_SESSION[$trow['name']]);
	}

	//Searched

		if($sort == 'clubName')
			$sql = "select distinct clubName from ClubTags where clubName like '%".$search."%' order by ".$sort." ".$dir;
		else
			$sql = "select clubName from ClubTags where clubName like '%".$search."%' and name = '".$sort."' order by value ".$dir.", clubName";

	//Table header format
	$t=mysqli_query($conn, $tag);
	echo '<table class="searchTable">
		<thead>
		<tr><th><a style="width:100%; cursor:pointer;" type="button" onclick="sortDB(\'clubName\')" class ="sort-by" id="clubName">Name</a>
		</th>';
		if($sort == 'clubName'){
			echo "<script>dirTag('clubName', '".$dir."');</script>";
		}
		else{
			echo "<script>disableDir('clubName');</script>";
		}
		while($trow=mysqli_fetch_array($t)){
		echo '<th>
			<a style="width:100%; cursor:pointer" type="button" onclick="sortDB(\''.$trow['name'].'\')" class ="sort-by" id="'.$trow['name'].'">'.$trow['name'].'</a>';
			if($sort == $trow['name']){
				echo "<script>dirTag('".$trow['name']."', '".$dir."');</script>";
			}
			else{
				echo "<script>disableDir('".$trow['name']."');</script>";
			}

		}
	echo '</tr></thead>';
		$counter = 0;
        $r = mysqli_query($conn, $sql);
	    while($row=mysqli_fetch_array($r)){//Fetch the tuple of data until there is no more tuple
			
			echo '<tr onclick="collapse(\'coll'.$counter.'\', \'col'.$counter.'\')" class="collapsible" id ="coll'.$counter.'">';
			echo '<td class="main"><a>'.$row['clubName'].'</a>
			</td>';
			
			//Get Tags again to display the values on table
			$tag="SELECT value FROM ClubTags where clubName='".$row['clubName']."'";
			$t=mysqli_query($conn, $tag);
			while($trow=mysqli_fetch_array($t)){
				echo '<td class="main" style="text-align:center">'.$trow['value'].'</td>';
			}
			echo '</tr>';
			
			echo '<tr><td colspan="'.$size.'"><div class="content" ID="col'.$counter.'">';
			$clubQuery = "SELECT description, clubWebsite FROM Club WHERE clubName = '".$row['clubName']."'";
			$cQ = mysqli_query($conn, $clubQuery);
			$crow = mysqli_fetch_array($cQ);
			echo '<p>Description:<br>'.$crow['description'].'</p>
			<p>Website:<br>'.$crow['clubWebsite'].'</p>';

			//Get Meetings data from database
			$in="SELECT * FROM Meetings where clubName ='".$row['clubName']."'";
			$i=mysqli_query($conn, $in);
			$irow=mysqli_fetch_array($i);
			echo '<p>Meetings: <br>';
			echo 'Location: '.$irow['location'].'<br>
				Date/Time: '.$irow['dateTime'].'</p>';

			//Get Members that are only president from the database
			$in="SELECT * FROM Members where clubName ='".$row['clubName']."' and position = 'President'";
			$i=mysqli_query($conn, $in);
			echo '<p>';
			while($irow=mysqli_fetch_array($i)){
					echo $irow['position'].'<br>
						Name: '.$irow['studentName'].'<br>
						Email: '.$irow['email'].'<br>';
			}
			echo '</p>';

			//Get Faculty adviosr data from database
			$in="SELECT * FROM Faculty_Advisor where clubName ='".$row['clubName']."'";
			$i=mysqli_query($conn, $in);
			$irow=mysqli_fetch_array($i);
			echo '<p>Faculty advisor: <br>';
			echo 'Name: '.$irow['name'].'<br>
				Email: '.$irow['email'].'<br>
				Department: '.$irow['deptAffiliation'].'</p>';

			$in="SELECT * FROM Members where clubName ='".$row['clubName']."'";
			$i=mysqli_query($conn, $in);
			echo '<p style = "text-align:right">';
			//Sent the ID of the modal and span due to the modal and span mixing up once the table has been sorted
			echo '<button class="modalMember" ID="B'.$counter.'" onclick="modalDisplay(\'M'.$counter.'\', \'S'.$counter.'\')">Members</button>
					<div class="modal" ID ="M'.$counter.'">
						<div class="modal-content">
							<span class="close" ID = "S'.$counter.'">x</span>
								<p class="modalP">Members </p>
								<table ID="members"><thead>
								<tr><th class="modalth">Name</th>
								<th class="modalth">Semester Joined</th>
								<th class="modalth">Major</th>
								<th class="modalth">Position</th>
								<th class="modalth">Email</th></tr></thead>';
								while($irow=mysqli_fetch_array($i)){
									echo '<tr>
											<td class="modaltd">'.$irow['studentName'].'</td>
											<td class="modaltd">'.$irow['semesterJoined'].'</td>
											<td class="modaltd">'.$irow['major'].'</td>
											<td class="modaltd">'.$irow['position'].'</td>
											<td class="modaltd">'.$irow['email'].'</td>
											</tr>';
								};
			$counter++;
			echo '</table>
								
						</div>
					</div>';
			echo '</p>';
			echo '</div></td></tr>';
		}

	echo'</table>';

?>

<script type="text/javascript" src="search.js"></script>