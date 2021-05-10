<?php
    include "header.php";
?> 

	<body>
		<!-- Header -->
		<header id="header">
			<nav class="left">
				<a href="#menu"><span>Menu</span></a>
			</nav>
			<a href="index.php" class="logo">SEFI</a>
		</header>

		<!--Navigation menu-->
		<?php
			include "menu.php";
		?>

		<!-- Main -->
		<section id="main" class="wrapper">
			<h1 align = "center"><a href="#">Register</a></h1>
			<div align="center" class="container wrapper" id = "main">
				<div class="row wrapper">
					<div class="col-sm-6">
						<a href="adminReg.php" class="button big">
							<i class="fas fa-user-shield"></i>
						</a><br />
						<b>Admin</b>
					</div>
					<div class="col-sm-6">
						<a href="judgeReg.php" class="button big">
							<i class="fas fa-user-tie"></i>
						</a><br />
						<b>Judge</b>
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