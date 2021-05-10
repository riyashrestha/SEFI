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
			<a href="student.php" class="logo">STUDENT</a>
		</header>
		
		<!--Navigation menu-->
		<?php
			include "menu.php";
		?>

		<!-- Main -->
		<h1 align = "center">Existing Students</h1>
		<div class="container">
			<?php
				$query = "SELECT * FROM STUDENT"; 
				$result = mysql_query($query);

				print '<br /><br /><span style="color:red">Data retrieved from database:</span><br/ >';
				// start a table tag in the HTML
				print '<table  id="example" class="display" cellspacing="0" width="100%">';
				print ' <thead>
						<tr>
							<th>StudentID</th>
							<th>FirstName</th>
							<th>LastName</th>
							<th>MiddleName</th>
							<th>GradeID</th>
							<th>Gender</th>
							<th>SchoolID</th>
							<th>ProjectID</th>
							<th>Year</th>
							<th>Edit</th>
							<th>Delete</th>

						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>StudentID</th>
							<th>FirstName</th>
							<th>LastName</th>
							<th>MiddleName</th>
							<th>GradeID</th>
							<th>Gender</th>
							<th>SchoolID</th>
							<th>ProjectID</th>
							<th>Year</th>
							<th>Edit</th>
							<th>Delete</th>

						</tr>
					</tfoot>';

				while($row = mysql_fetch_array($result))
				{   
					//Creates a loop to loop through results
					print "<tr>";
					print " <td>".$row["StudentID"]."</td>
						<td>".$row["FirstName"]."</td>
						<td>".$row["LastName"]."</td>
						<td>".$row["MiddleName"]."</td>
						<td>".$row["GradeID"]."</td>
						<td>".$row["Gender"]."</td>
						<td>".$row["SchoolID"]."</td>
						<td>".$row["ProjectID"]."</td>
						<td>".$row["Year"]."</td>
					";

					echo '<td>'.'<a href="/project/edit/studentEdit.php?edit='.$row["StudentID"].'"> Edit</a>'.'</td>';
					echo '<td>'.'<a href="/project/edit/studentDelete.php?delete= '.$row["StudentID"].'">Delete</a>'.'</td>';

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