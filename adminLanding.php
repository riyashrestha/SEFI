<?php
	require_once("aSession.php");
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
			<a href="index.php" class="logo">SEFI</a>
		</header>

		<!--Navigation menu-->
		<?php
			include "menu.php";
		?>

		 <!-- Main -->
		 <section id="main" class="wrapper">
			<h1 align = "center"><a href="#">Admin Controls</a></h1>
			<div align="center" class="container wrapper" id = "main">
				<div class="row">
					<div class="col-sm-3">
						<a href="admin.php" class="button big">
							<i class="fas fa-user-shield"></i>
						</a><br />
						<b>Administrator</b>
					</div>
					<div class="col-sm-3">
						<a href="school.php" class="button big">
							<i class="fas fa-school"></i>
						</a><br />
						<b>School</b>
					</div>
					<div class="col-sm-3">
						<a href="county.php" class="button big">
							<i class="fas fa-location-arrow"></i>
						</a><br />
						<b>County</b>
					</div>
					<div class="col-sm-3">
						<a href="project.php" class="button big">
							<i class="fas fa-flask"></i>
						</a><br />
						<b>Project</b>
					</div>
				</div><!--close row--->
				<div class="row">
					<div class="col-sm-3">
						<a href="student.php" class="button big">
							<i class="fas fa-user-graduate"></i>
						</a><br />
						<b>Student</b>
					</div>
					<div class="col-sm-3">
						<a href="category.php" class="button big">
							<i class="fas fa-tasks"></i>
						</a><br />
						<b>Category</b>
					</div>
					<div class="col-sm-3">
						<a href="grade.php" class="button big">
							<i class="fas fa-chart-bar"></i>
						</a><br />
						<b>Student Grade</b>
					</div>
					<div class="col-sm-3">
						<a href="gradeLevel.php" class="button big">
							<i class="fas fa-poll"></i>
						</a><br />
						<b>Project Grade Level</b>
					</div>
				</div><!--close row--->
				<div class="row">
					<div class="col-sm-3">
						<a href="judgeSession.php" class="button big">
							<i class="fas fa-clock"></i>
						</a><br />
						<b>Judge Session</b>
					</div>
					<div class="col-sm-3">
						<a href="booth.php" class="button big">
							<i class="fas fa-store"></i>
						</a><br />
						<b>Booth Number</b>
					</div>
					<div class="col-sm-3">
						<a href="uploadFile.php" class="button big">
							<i class="fas fa-file-upload"></i>
						</a><br />
						<b>Upload File</b>
					</div>
					<div class="col-sm-3">
						<a href="viewInfo.php" class="button big">
						<i class="fas fa-database"></i>
						</a><br />
						<b>View Informations</b>
					</div>

				</div><!--close--->
				<div class="row">
					<div class="col-sm-3">
						<a href="JudgeView.php" class="button big">
							<i class="fas fa-user"></i>
						</a><br />
						<b>Judges Checked In</b>
					</div>
					<div class="col-sm-3">
						<a href="checkScores.php" class="button big">
							<i class="fas fa-check"></i>
						</a><br />
						<b>Scores</b>
					</div>
					<div class="col-sm-3">
						<a href="ranking.php" class="button big">
							<i class="fas fa-list"></i>
						</a><br />
						<b>Project Rank</b>
					</div>
					<div class="col-sm-3">
						<a href="viewJudge.php" class="button big">
							<i class="fas fa-user"></i>
						</a><br />
						<b>Judge Information</b>
					</div>
				</div><!--close row--->
				<div class="row">
					<div class="col-sm-3">
						<a href="schedule.php" class="button big">
							<i class="fas fa-scroll"></i>
						</a><br />
						<b>Schedule</b>
					</div>
				</div><!--close row--->
			</div><!--close container wrapper--->
		</section><!--close section--->

		<!-- Footer and Scripts-->
		<?php 
            include "footer.php";
            include "script.php";
		?>
	</body>
</html>