<?php
	require_once "aSession.php";
	if(checkAdminSession())
	{
		header("Location: login.php");
	}
	include "header.php";
?> 

	<body>
		<!-- Header -->
		<header id="header">
			<nav class="left">
				<a href="#menu"><span>Menu</span></a>
			</nav>
			<a href="adminLanding.php" class="logo">Admin Controls</a>
		</header>

		<!--Navigation menu-->
		<?php
			include "menu.php";
		?>

		<!-- Main -->
		<section id="main" class="wrapper">
			<h1 align = "center"><a href="#">Booth</a></h1>
			<div align="center" class="container wrapper" id = "main">
				<div class="row wrapper">
					<div class="col-sm-6">
						<a href="existGradeLevel.php" class="button big">
							<i class="fas fa-database"></i>
						</a><br />
						<b>Existing Project Grade Levels</b>
					</div>
					<div class="col-sm-6">
						<a href="addGradeLevel.php" class="button big">
							<i class="fas fa-plus-square"></i>
						</a><br />
						<b>Add New Project Grade Level</b>
					</div>
				</div><!--close row wrapper--->
			</div><!--close container wrapper--->
		</section><!--close section--->

		<!-- Footer and Scripts-->
		<?php 
            include "footer.php";
            include "script.php";
		?>
	</body>
</html> 