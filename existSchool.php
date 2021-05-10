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
			<a href="school.php" class="logo">SCHOOL</a>
		</header>
		
		<!--Navigation menu-->
		<?php
			include "menu.php";
		?>
		
		<!-- Main -->
		<h1 align = "center">Existing Schools</h1>
		<div class="container">
			<?php
				$query = "SELECT * FROM SCHOOL"; 
				$result = mysql_query($query);

				print '<br /><br /><span style="color:red">Data retrieved from database:</span><br/ >';
				// start a table tag in the HTML
				print '<table  id="example" class="display" cellspacing="0" width="100%">';
				print '<thead>
						<tr>
							<th>SchoolID</th>
							<th>SchoolName</th>
							<th>SchoolCity</th>
							<th>SchoolCountyID</th>
							<th>Edit</th>
							<th>Delete</th>

						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>SchoolID</th>
							<th>SchoolName</th>
							<th>SchoolCity</th>
							<th>SchoolCountyID</th>
							<th>Edit</th>
							<th>Delete</th>

						</tr>
					</tfoot>';

				while($row = mysql_fetch_array($result))
				{   
					//Creates a loop to loop through results
					print "<tr>";
					print " <td>".$row["SchoolID"]."</td>
						<td>".$row["SchoolName"]."</td>
						<td>".$row["SchoolCity"]."</td>
						<td>".$row["SchoolCountyID"]."</td>
					";

					echo '<td>'.'<a href="/project/edit/schoolEdit.php?edit='.$row["SchoolID"].'"> Edit</a>'.'</td>';
					echo '<td>'.'<a href="/project/edit/schoolDelete.php?delete= '.$row["SchoolID"].'">Delete</a>'.'</td>';

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