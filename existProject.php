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
			<a href="project.php" class="logo">PROJECT</a>
		</header>
		
		<!--Navigation menu-->
		<?php
			include "menu.php";
		?>

		<!-- Main -->
		<h1 align = "center">Existing Projects</h1>
		<div class="container">
			<?php
				$query = "SELECT * FROM PROJECT"; 
				$result = mysql_query($query);

				print '<br /><br /><span style="color:red">Data retrieved from database:</span><br/ >';
				// start a table tag in the HTML
				print '<table  id="example" class="display" cellspacing="0" width="100%">';
				print '<thead>
						<tr>
							<th>ProjectID</th>
							<th>ProjectNumber</th>
							<th>Title</th><th>Abstract</th>
							<th>GradeLevelID</th>
							<th>CategoryID</th>
							<th>BoothNumberID</th>
							<th>GradeID</th>
							<th>CourseNetworkID</th>
							<th>AverageRanking</th>
							<th>Year</th>
							<th>Edit</th>
							<th>Delete</th>

						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>ProjectID</th>
							<th>ProjectNumber</th>
							<th>Title</th>
							<th>Abstract</th>
							<th>GradeLevelID</th>
							<th>CategoryID</th>
							<th>BoothNumberID</th>
							<th>GradeID</th>
							<th>CourseNetworkID</th>
							<th>AverageRanking</th>
							<th>Year</th>
							<th>Edit</th>
							<th>Delete</th>

						</tr>
					</tfoot>
					';

				while($row = mysql_fetch_array($result))
				{   
					//Creates a loop to loop through results
					print "<tr>";
					print " <td>".$row["ProjectID"]."</td>
						<td>".$row["ProjectNumber"]."</td>
						<td>".$row["Title"]."</td>
						<td>".$row["Abstract"]."</td>
						<td>".$row["GradeLevelID"]."</td>
						<td>".$row["CategoryID"]."</td>
						<td>".$row["BoothNumberID"]."</td>
						<td>".$row["GradeID"]."</td>
						<td>".$row["CourseNetworkID"]."</td>
						<td>".$row["AverageRanking"]."</td>
						<td>".$row["Year"]."</td>
					";

					echo '<td>'.'<a href="/project/edit/projectEdit.php?edit='.$row["ProjectID"].'"> Edit</a>'.'</td>';
					echo '<td>'.'<a href="/project/edit/projectDelete.php?delete= '.$row["ProjectID"].'">Delete</a>'.'</td>';

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