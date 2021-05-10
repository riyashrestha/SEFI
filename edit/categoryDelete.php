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
			<h1>Place Holder</h1>
			<?php

			$status = "";
			if(isset($_POST['new'])&& $_POST['new']==1)
			{
				$ID = $_GET["delete"];
				$query = "DELETE FROM CATEGORY where CategoryID ='".$ID."'"; 
				$result = mysql_query($query) or die ( mysql_error());

				$status = "Record Deleted. </br></br>";

				echo '<p style="color:#FF0000;">'.$status.'</p>';
				
				header("Location: http://corsair.cs.iupui.edu:24471/project/existCategory.php"); 
			}
			else
			{
				?>

				<form name="form" method="post" action=""> 
					<input type="hidden" name="new" value="1" />
					<input name="id" type="hidden" value="<?php echo $row['CategoryID'];?>" />
					<p><input name="submit" type="submit" value="Return" /></p>
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