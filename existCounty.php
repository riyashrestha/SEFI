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
			<a href="county.php" class="logo">COUNTY</a>
		</header>
		
		<!--Navigation menu-->
		<?php
			include "menu.php";
		?>

		<!-- Main -->
		<h1 align = "center">Existing Counties</h1>
		<div class="container">
			<?php
				$query = "SELECT * FROM COUNTY"; 
				$result = mysql_query($query);

				print '<br /><br /><span style="color:red">Data retrieved from database:</span><br/ >';
				// start a table tag in the HTML
				print '<table  id="example" class="display" cellspacing="0" width="100%">';
				print '<thead>
						<tr>
							<th>CountyyID</th>
							<th>CountyName</th>
							<th>Edit</th>
							<th>Delete</th>

						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>CountyyID</th>
							<th>CountyName</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</tfoot>';

				while($row = mysql_fetch_array($result))
				{   
					//Creates a loop to loop through results
					print "<tr>";
					print "	<td>".$row["CountyID"]."</td>
						<td>".$row["CountyName"]."</td>
						";

					echo '<td>'.'<a href="/project/edit/countyEdit.php?edit='.$row["CountyID"].'"> Edit</a>'.'</td>';
					echo '<td>'.'<a href="/project/edit/countyDelete.php?delete= '.$row["CountyID"].'">Delete</a>'.'</td>';

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