<?php
	require_once "aSession.php";
	if(checkAdminSession())
	{
		header("Location: login.php");
	}
	include "header.php";
	require_once "dbconnect.php";
?>
<html>
	<body>
		<!-- Header -->
		<header id="header">
			<nav class="left">
				<a href="#menu"><span>Menu</span></a>
			</nav>
			<a href="schedule.php" class="logo">Schedule</a>
		</header>
		
		<!--Navigation menu-->
		<?php
			include "menu.php";
		?>

		<h1 align = "center"><a href="#">Schedule</a></h1>
		
		<!-- Main -->
		<div class="container">	
			<button id="deleteButton">Delete selected row</button>
			<button id="editButton">Edit selected row</button>
			<?php
				$query = "SELECT * FROM SCHEDULE"; 
				$result = mysql_query($query);

				print '<br /><br /><span style="color:red">Data retrieved from database:</span><br/ >';
				// start a table tag in the HTML
				print '<table  id="example" class="display" cellspacing="0" width="100%">';
				print '<thead>
				<tr>
					<th>ScheduleID</th>
					<th>SessionID</th>
					<th>ProjectID</th>
					<th>JudgeID</th>
					<th>Score</th>
				</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ScheduleID</th>
						<th>SessionID</th>
						<th>ProjectID</th>
						<th>JudgeID</th>
						<th>Score</th>
					</tr>
				</tfoot>';

				while($row = mysql_fetch_array($result))
				{   
					//Creates a loop to loop through results
					print "<tr>";
					print  "<td>".$row["ScheduleID"]."</td>
						<td>".$row["SessionID"]."</td>
						<td>".$row["ProjectID"]."</td>
						<td>".$row["JudgeID"]."</td>
						<td>".$row["Score"]."</td>";
							
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