<?php
	include "header.php";
	require_once "dbconnect.php";
	require_once("jSession.php");
	if(checkJudgeSession())
	{
		header("Location: login.php");
	}
?>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<nav class="left">
					<a href="#menu"><span>Menu</span></a>
				</nav>
				<a href="index.php" class="logo">SEFI</a>
			</header>

			<?php
				include "menu.php";
				$ID = $_SESSION['jID'];
				$msg = "";
				$return = "";

				if (isset($_POST['submit']))
				{

					$query = "SELECT * from JUDGE where JudgeID ='".$ID."'"; 
					$result = mysql_query($query) or die ( mysql_error());
					$row = mysql_fetch_array($result);

					$update = "UPDATE JUDGE set CheckIn = '1' WHERE JudgeID = '".$ID."'";
					mysql_query($update) or die(mysql_error());
					$msg = "<br /><span style=\"color:green\">Checked In</span><br />";
					$return = '<td>'.'<a href="judgeLanding.php"> Judge Controls</a>'.'</td>';
				}
			?>

			<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">
				<form class = "post" method="post" action="#">
					<header class="align-center">
						<h1>Check-in</h1>
						<p>If you have not checked in for event please make sure to do so</p>
						<dt><?php print $msg; ?></dt>							
						<input class = "button" type="submit" name = "submit"  value="Check-in" />
						<dt><?php print $return; ?></dt>	

					</header>
				</form>
				</div>
			</section>
		<?php 
            		include "footer.php";
            		include "script.php";
		?>

	</body>
</html>