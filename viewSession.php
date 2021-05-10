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
			<a href="viewInfo.php" class="logo">View Informations</a>
		</header>
		
		<!--Navigation menu-->
		<?php
			include "menu.php";
        ?>
        
		<!-- Main -->
		<h1 align = "center">Session Info</h1>
		<div class="container">
			<?php
				$query = "SELECT * FROM SESSION"; 
				$result = mysql_query($query);

				// start a table tag in the HTML
				print '<table  id="example" class="display" cellspacing="0" width="100%">';
				print '<thead><tr><th>SessionID</th><th>SessionNumber</th><th>StartTime</th><th>EndTime</th><th>Active</th></tr></thead>
				<tfoot><tr><th>SessionID</th><th>SessionNumber</th><th>StartTime</th><th>EndTime</th><th>Active</th></tr></tfoot>';

				while($row = mysql_fetch_array($result))
				{   
					//Creates a loop to loop through results
					print "<tr>";
					print "<td>".$row["SessionID"]."</td><td>".$row["SessionNumber"]."</td><td>".$row["StartTime"]."</td><td>".$row["EndTime"]."</td><td>"
					.$row["Active"]."</td>";
					print "</tr>";
				}
				print "</table>"; //Close the table in HTML
				mysql_close(); //Make sure to close out the database connection
			?>
		</div><!--close container-->

		<!-- Footer and Scripts-->
		<?php 
			include "footer.php";
			include "script.php";
		?>
	</body>
</html>