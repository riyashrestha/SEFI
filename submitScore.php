<?php
	require_once "aSession.php";
	if(checkAdminSession())
	{
		header("Location: login.php");
	}
	include "header.php";
	require_once "dbconnect.php";

	if(isset($_GET["edit"]))
	{
		$ID = $_GET["edit"];
		$query = "SELECT * from SCHEDULE where ScheduleID ='".$ID."'"; 
		$result = mysql_query($query) or die ( mysql_error());
		$row = mysql_fetch_array($result);
    
	}

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

		<h1 align = "center"><a href="#">Score Sunmission</a></h1>
		
		<!-- Main -->
		<div class="container">	
		<div class="form">
			<h1>Submit Score</h1>

			<?php

			$status = "";
			if(isset($_POST['new']) && $_POST['new']==1)
			{
				$ID = $_REQUEST['edit'];

				$score = trim($_POST['score']);

				$update = "UPDATE SCHEDULE set Score = '$score' where ScheduleID = '".$ID."'";

				mysql_query($update) or die(mysql_error());

				$status = "Record Updated Successfully. </br></br>

				<a href='view.php'>View Updated Record</a>";

				echo '<p style="color:#FF0000;">'.$status.'</p>';
				echo '<a href="judgeLanding.php">Return to Judge Control Page</a>';
			}
			else
			{
				?>
	
				<form name="form" method="post" action=""> 

					<input type="hidden" name="new" value="1" />
					<input name="id" type="hidden" value="<?php echo $row['ScheduleID'];?>" />
					<p><input type="text" name="score" id = "score" placeholder="Submit Score" required value="" /></p>
					<p><input name="submit" type="submit" value="Update" /></p>
				</form>

			<?php } ?>


       		</div>
		</div>

		<!-- Footer and Scripts-->
		<?php 
			include "footer.php";
			include "script.php";
		?>
	</body>
</html>