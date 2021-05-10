<?php
	include "header.php";
	require_once("jSession.php");
	if(checkJudgeSession())
	{
		header("Location: login.php");
	}
	require_once "dbconnect.php";
?>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<nav class="left">
					<a href="#menu"><span>Menu</span></a>
				</nav>
				<a href="index.php" class="logo">SEFI</a>
			</header>

			<?php
				include "menu.php";
			?>


		<!-- Main -->
		<div class="container">	



			<?php
				$jID = $_SESSION['jID'];

				//$query = "SELECT * FROM SCHEDULE WHERE JudgeID = '$jID'"; 

				$query = "SELECT SCHEDULE.ScheduleID, PROJECT.Title, SCHEDULE.JudgeID, SCHEDULE.Score, SESSION.StartTime, SESSION.EndTime
					  FROM ((SCHEDULE
					  INNER JOIN PROJECT ON SCHEDULE.ProjectID = PROJECT.ProjectID)
					  INNER JOIN SESSION ON SCHEDULE.SessionID = SESSION.SessionID)
					 "; 

				$result = mysql_query($query);

				print '<br /><br /><span style="color:red">Data retrieved from database:</span><br/ >';
				// start a table tag in the HTML
				print '<table  id="example" class="display" cellspacing="0" width="100%">';
				print '<thead>
				<tr>
						<th>Schedule ID</th>
						<th>Title</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Score</th>	
						<th>Submit Score</th>
				</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Schedule ID</th>
						<th>Title</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Score</th>	
						<th>Submit Score</th>

					</tr>
				</tfoot>';

				while($row = mysql_fetch_array($result))
				{   
					if($jID == $row['JudgeID'])
					{
						//Creates a loop to loop through results
						print "<tr>";
						print  "<td>".$row["ScheduleID"]."</td>
							<td>".$row['Title']."</td>
							<td>".$row["StartTime"]."</td>
							<td>".$row["EndTime"]."</td>
							<td>".$row["Score"]."</td>";
							
						echo '<td>'.'<a href="submitScore.php?edit='.$row["ScheduleID"].'">Submit Score</a>'.'</td>';		
					}
				}

				print "</td>";
				print "</tr>";
				print "</table>"; //Close the table in HTML
				mysql_close(); //Make sure to close out the database connection
			?>
        	</div>

		<?php 
            		include "footer.php";
            		include "script.php";
		?>

	</body>
</html>
