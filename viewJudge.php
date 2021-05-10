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
			<a href="adminLanding.php" class="logo">Admin Controls</a>
		</header>
		
		<!--Navigation menu-->
		<?php
			include "menu.php";
        ?>
        
		<!-- Main -->
		<h1 align = "center">Judge Info</h1>
		<div class="container">	
			<?php
				$query = "SELECT * FROM JUDGE"; 
				$result = mysql_query($query);

				// start a table tag in the HTML
				print '<table  id="example" class="display" cellspacing="0" width="100%">';
                print '<thead><tr><th>JudgeID</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Title</th><th>Degree Earned</th><th>Employer</th>
                <th>Email</th><th>Username</th><th>Check In</th></tr></thead>
				<tfoot><tr><th>JudgeID</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Title</th><th>Degree Earned</th><th>Employer</th>
                <th>Email</th><th>Username</th><th>Check In</th></tr></tfoot>';

				while($row = mysql_fetch_array($result))
				{   
					//Creates a loop to loop through results
					print "<tr>";
					print "<td>".$row["JudgeID"]."</td><td>".$row["FirstName"]."</td><td>".$row["MiddleName"]."</td><td>".$row["LastName"]."</td><td>"
					.$row["Title"]."</td><td>".$row["HighestDegreeEarned"]."</td><td>".$row["Employer"]."</td><td>".$row["Email"]."</td><td>"
					.$row["Username"]."</td><td>".$row["CheckIn"]."</td>";
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