<?php
/*When calling this php
Make sure to have $counter = 0;
before calling this file
it uses counter to set id of multiple html elements
*/

/*Collapsible view setup with table data*/
echo '<td class="main"><button class="collapsible">'.$row['clubName'].'</button>
<div class="content" ID="col'.$counter.'">';

$in="SELECT * FROM Club where clubName ='".$row['clubName']."'";
$i=mysqli_query($conn, $in);
$irow=mysqli_fetch_array($i);
echo '<p>Description:<br>'.$irow['description'].'</p>
<p>Website:<br>'.$irow['clubWebsite'].'</p>';

/*Get Meetings data from database*/
$in="SELECT * FROM Meetings where clubName ='".$row['clubName']."'";
$i=mysqli_query($conn, $in);
$irow=mysqli_fetch_array($i);
echo '<p>Meetings: <br>';
echo 'Location: '.$irow['location'].'<br>
    Date/Time: '.$irow['dateTime'].'</p>';

/*Get Members that are only president from the database*/
$in="SELECT * FROM Members where clubName ='".$row['clubName']."' and position = 'President'";
$i=mysqli_query($conn, $in);
echo '<p>';
while($irow=mysqli_fetch_array($i)){
        echo $irow['position'].'<br>
            Name: '.$irow['studentName'].'<br>
            Email: '.$irow['email'].'<br>';
}
echo '</p>';

/*Get Faculty adviosr data from database*/
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
echo '</div></td>';
?>