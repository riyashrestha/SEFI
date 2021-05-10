<?php
	include "header.php";
?>
	<body>
		<!-- Header -->
			<header id="header">
				<nav class="left">
					<a href="#menu"><span>Menu</span></a>
				</nav>
				<a class="logo">SEFI</a>
			</header>

			<?php
				include "menu.php";
			?>
		<!-- Banner -->
			<section id="banner">
				<div class="content">
					<h1>Welcome</h1>
						<p>Please make sure to log-in or register</p>
					<ul class="actions">
						<li><a href="login.php" class="button scrolly">Login</a></li>
					</ul>
					<ul class="actions">
						<li><a href="register.php" class="button scrolly">Register</a></li>
					</ul>

				</div>
			</section>
			<section id="main" class="wrapper">
				<div class="inner">
					<div class="align-center">
						<img src="images/LogoArt.jpg" alt="" />
					</div>
					<header class="align-center">
						<h1>About Us</h1>
					</header>

					<p>The Science Education Foundation of Indiana was formed in 1964 with the sole purpose of providing resources and coordination for students from Indiana to attend the National Science Fair. In 1988, the first State Science fair was held and since that time thousands of Indiana's brightest and best young scientific minds have presented their research to Professional and Academic Scientists.</p>
					<p> In 2006, we hosted and coordinated the Intel ISEF, where 1500 of the world's best pre-collegiate researchers competed for more than 1.5 million dollars in scholarships and prizes. We continue to work closely with the Society for Science and the Public to ensure a quality program.</p>
					<p>Dateline October 2010, partnering with some of our sponsors, we hosted the first ever science festival in Indiana. That year more than 2,000 people attended the innaugural Celebrate Science Indiana "TM". The 2020 Celebrate Science Indiana event will be held at the Indiana State Fairgrounds in the Elements Blue Ribbon Pavilion on Saturday October 3. </p>
				</div>
			</section>




		<!-- Scripts -->
		<?php 
			include "footer.php";
			include "script.php";
		?>
	</body>
</html>