<?php
	include "header.php";
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
				<a href="judgeLanding.php" class="logo">Judge Controls</a>
			</header>

			<?php
				include "menu.php";
			?>
			
			<section id="main" class="wrapper">
			<div class = "inner">
				<p>Judges who have not checked in please check for Admistrators can see your are ready to judge projects</p>

				<div class = "row">
					<div class="col-sm-3">
						<a href="jCheckIn.php" class="button big">
							<i class="fas fa-clock"></i>
						</a><br />
						<b>Check-in</b>
					</div>
			
					<div class="col-sm-3">
						<a href="jProjects.php" class="button big">
							<i class="fas fa-flask"></i>
						</a><br />
						<b>View Projects / Submit Scores</b>
					</div>
				</div>
			</div>


			</section>

		<!-- Footer and Scripts-->
		
		<?php 
            		include "footer.php";
            		include "script.php";
		?>

	</body>
</html>