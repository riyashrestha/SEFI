<?
	require_once "dbconnect.php";
	set_include_path('/home/imurillo/htdocs/project/');
	include "header.php";

	if(isset($_GET["edit"]))
	{
		$ID = $_GET["edit"];
		$query = "SELECT * from BOOTH_NUMBER where BoothID ='".$ID."'"; 
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

				$number = trim($_POST['number']);

				$active = trim($_POST['active']);

				$update = "UPDATE BOOTH_NUMBER set Number = '$number', active = '$active' where BoothID = '".$ID."'";

				mysql_query($update) or die(mysql_error());

				$status = "Record Updated Successfully. </br></br>

				<a href='http://corsair.cs.iupui.edu:24471/project/existBooth.php'>View Updated Record</a>";

				echo '<p style="color:#FF0000;">'.$status.'</p>';
			}
			else
			{
				?>
	
				<form name="form" method="post" action=""> 

					<input type="hidden" name="new" value="1" />
					<input name="id" type="hidden" value="<?php echo $row['BoothID'];?>" />
						<input type="text" name="number" id = "number" placeholder="Booth Number" required value="" />
						<input type="text" name="active" id = "active" placeholder="Active" required value="" />
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