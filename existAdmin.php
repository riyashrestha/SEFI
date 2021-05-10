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
			<a href="admin.php" class="logo">ADMIN</a>
		</header>
		
		<!--Navigation menu-->
		<?php
			include "menu.php";
		?>

		<!-- Main -->
		<h1 align = "center">Existing Admins</h1>
		<div class="container">
			<?php
				$query = "SELECT * FROM ADMIN"; 
				$result = mysql_query($query);

				print '<br /><br /><span style="color:red">Data retrieved from database:</span><br/ >';
				// start a table tag in the HTML
				print '<table  id="example" class="display" cellspacing="0" width="100%">';
				print '<thead>
				<tr>
					<th>AdminID</th>
					<th>FirstName</th>
					<th>LastName</th>
					<th>MiddleName</th>
					<th>Email</th>
					<th>Password</th>
					<th>Level</th><th>Active</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
				</thead>
				<tfoot>
					<tr>
						<th>AdminID</th>
						<th>FirstName</th>
						<th>LastName</th>
						<th>MiddleName</th>
						<th>Email</th>
						<th>Password</th>
						<th>Level</th>
						<th>Active</th>
						<th>Edit</th>
						<th>Delete</th>

					</tr>
				</tfoot>';

				while($row = mysql_fetch_array($result))
				{   
					//Creates a loop to loop through results
					print "<tr>";
					print "<td>".$row["AdminID"]."</td>
					       <td>".$row["FirstName"]."</td>
                                               <td>".$row["LastName"]."</td>
                                               <td>".$row["MiddleName"]."</td>
					       <td>".$row["Email"]."</td>
                                               <td>".$row["Password"]."</td>
                                               <td>".$row["Level"]."</td>
                                               <td>".$row["Active"]."</td>
					";

					echo '<td>'.'<a href="/project/edit/adminEdit.php?edit='.$row["AdminID"].'"> Edit</a>'.'</td>';
					echo '<td>'.'<a href="/project/edit/adminDelete.php?delete= '.$row["AdminID"].'">Delete</a>'.'</td>';
				}
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