<?
	require_once "dbconnect.php";
	set_include_path('/home/imurillo/htdocs/project/');
	include "header.php";


	if(isset($_GET["edit"]))
	{
		$ID = $_GET["edit"];
		$query = "SELECT * from ADMIN where AdminID ='".$ID."'"; 
		$result = mysql_query($query) or die ( mysql_error());
		$row = mysql_fetch_array($result);
    
	}
?>

<!DOCTYPE html>
	<html>
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

		<section id="main" class="wrapper">
		<div class="form">
			<h1>Update Record</h1>

			<?php

			$status = "";
			if(isset($_POST['new']) && $_POST['new']==1)
			{
				$ID = $_REQUEST['edit'];

				$newfn = trim($_POST['name']);

				$newm = trim($_POST['mName']);

				$newln = trim($_POST['lname']);
			
				$email = trim($_POST['email']);

				$update = "UPDATE ADMIN set FirstName = '$newfn', MiddleName= '$newm', LastName = '$newln', Email = '$email' where AdminID = '".$ID."'";

				mysql_query($update) or die(mysql_error());

				$status = "Record Updated Successfully. </br></br>

				<a href='http://corsair.cs.iupui.edu:24471/project/existAdmin.php'>View Updated Record</a>";

				echo '<p style="color:#FF0000;">'.$status.'</p>';
			}
			else
			{
				?>
	
				<form name="form" method="post" action=""> 

					<input type="hidden" name="new" value="1" />
					<input name="id" type="hidden" value="<?php echo $row['AdminID'];?>" />
						<input type="text" name="name" id = "name" placeholder="First Name" required value="" />
						<input type="text" name="mName" id = "lname" placeholder="Middle Name" required value="" />
						<input type="text" name="lname" id = "lname" placeholder="Last Name" required value="" />
						<input type="text" name="email" id = "email" placeholder="Email" required value="" />
					<p><input name="submit" type="submit" value="Update" /></p>
				</form>

			<?php } ?>
		</div>
		</div>
		</section><!--close section wrapper-->

		<!-- Footer and Scripts-->
		<?php 
			include "footer.php";
			include "script.php";
		?>

	</body>
</html>