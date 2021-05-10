<?
	require_once "dbconnect.php";
	set_include_path('/home/imurillo/htdocs/project/');
	include "header.php";

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

				$name = trim($_POST['name']);

				$update = "UPDATE COUNTY set CountyName = '$name'where CountyID = '".$ID."'";

				mysql_query($update) or die(mysql_error());

				$status = "Record Updated Successfully. </br></br>

				<a href='http://corsair.cs.iupui.edu:24471/project/existCounty.php'>View Updated Record</a>";

				echo '<p style="color:#FF0000;">'.$status.'</p>';
			}
			else
			{
				?>
	
				<form name="form" method="post" action=""> 

					<input type="hidden" name="new" value="1" />
					<input name="id" type="hidden" value="<?php echo $row['BoothID'];?>" />
						<input type="text" name="name" id = "name" placeholder="County Name" required value="" />
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