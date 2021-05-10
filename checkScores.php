<?php
	require_once "aSession.php";
	if(checkAdminSession())
	{
		header("Location: login.php");
	}
	include "header.php";
	require_once "dbconnect.php";
?>
	<body>
		<!-- Header -->
		<header id="header">
			<nav class="left">
				<a href="#menu"><span>Menu</span></a>
			</nav>
			<a href="adminLanding.php" class="logo">ADMIN CONTROLS</a>
		</header>
		
		<!--Navigation menu-->
		<?php
			include "menu.php";
		?>

		<h1 align = "center"><a href="#">Veiw Scores</a></h1>
		
		<!-- Main -->
		<div class="container">	
			<?php
				$query = "SELECT SCHEDULE.ScheduleId, PROJECT.Title, SCHEDULE.Score, SESSION.StartTime, SESSION.EndTime
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
					<th>Title</th>
					<th>Score</th>
					<th>Session Start Time</th>
					<th>Session End Time</th>
				</tr>
				</thead>
				<tfoot>
				<tr>
					<th>Title</th>
					<th>Score</th>
					<th>Session Start Time</th>
					<th>Session End Time</th>
				</tr>
				</tfoot>';

				while($row = mysql_fetch_array($result))
				{   
					//Creates a loop to loop through results
					print "<tr>";
					print  "<td>".$row["Title"]."</td>
						<td>".$row["Score"]."</td>
						<td>".$row["StartTime"]."</td>
						<td>".$row["EndTime"]."</td>
						";
				}


				print "</td>";
				print "</tr>";
				print "</table>"; //Close the table in HTML
				mysql_close(); //Make sure to close out the database connection
			?>
        	</div>

		<!-- Footer and Scripts-->
		<?php 
			include "footer.php";
			include "script.php";
		?>
	</body>
</html>