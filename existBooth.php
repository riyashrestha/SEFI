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
			<a href="booth.php" class="logo">BOOTH</a>
		</header>
		
		<!--Navigation menu-->
		<?php
			include "menu.php";
		?>
		
		<!-- Main -->
		<h1 align = "center">Existing Booth Numbers</h1>
		<div class="container">
			<?php
				$query = "SELECT * FROM BOOTH_NUMBER"; 
				$result = mysql_query($query);

				print '<br /><br /><span style="color:red">Data retrieved from database:</span><br/ >';
				// start a table tag in the HTML
				print '<table  id="example" class="display" cellspacing="0" width="100%">';
				print '<thead>
						<tr>
							<th>BoothID</th>
							<th>Number</th>
							<th>Active</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>BoothID</th>
							<th>Number</th>
							<th>Active</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</tfoot>';

				while($row = mysql_fetch_array($result))
				{   
					//Creates a loop to loop through results
					print "<tr>";
					print " <td>".$row["BoothID"]."</td>
						<td>".$row["Number"]."</td>
						<td>".$row["Active"]."</td>
					";

					echo '<td>'.'<a href="/project/edit/boothEdit.php?edit='.$row["BoothID"].'"> Edit</a>'.'</td>';
					echo '<td>'.'<a href="/project/edit/boothDelete.php?delete= '.$row["BoothID"].'">Delete</a>'.'</td>';

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