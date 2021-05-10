<?php
	session_start();
	include "header.php";
	include "dbconnect.php";
?>

	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<nav class="left">
					<a href="#menu"><span>Menu</span></a>
				</nav>
				<a href="login.php" class="logo">Judge Login</a>
			</header>

			<?php
				include "menu.php";
			?>

		<?php
			$cem = "";
			$cpass = "";


			$emre="*";
			$lpass = "*";
		
			$msg = "";

			if (isset($_POST['enter'])) //check if this page is requested after Submit button is clicked
			{


				$cem = trim($_POST['email']);

				$cpass = trim($_POST['password']); 

				$query = "SELECT * FROM JUDGE WHERE Email = '$cem' and Password = '$cpass'"; 
				$result = mysql_query($query);

				if($row = mysql_fetch_array($result))
				{
					$msg = "<br /><span style=\"color:green\">Logged In</span><br />";
					print $msg;	
					$_SESSION['jID']= $row['JudgeID'];
					header("Location: JudgeLanding.php");

				}
				else
				{
					$emre = "<br /><span style=\"color:red\"> Username was incorrect</span><br />";
					$lpass = "<br /><span style=\"color:red\">Password was incorrect</span><br />";
				}

			}
       
		?>

		<section id="main" class="wrapper">
			<div class="inner">

				<h1>Switch Login Screen</h1>
					<p>If you are an adminstrator click on button below to switch to adminstrator login screen</p>
				
					<a href="adminLogin.php" class = "button">switch</a>

			</div><!--close content_container-->
		</section>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">

					<header class="align-left">
					<h1>Login - Judge</h1>


					<form class = "post" method="post" action="#">
					<dl>
					<!----------------------------------------Text Boxes--------------------------------------------------------->	
							<dt>Username (Email): <?php print $emre; ?></dt>
								<input type="text" maxlength = "50" value="<?php print $cem; ?>" name="email" id="email"  placeholder="example@gmail.com" />
							<br />
					

					
							<dt>Password: <?php print $lpass; ?></dt>
								<input type="password" maxlength = "50" value="<?php print $cpass; ?>" name="password" id="password"  placeholder="Password"/> <br />

							<br />
							
							<div>
								<input name="enter" class="btn" type="submit" value="Login" />
								<input class = "submit" type="reset" name = "reset" value="Reset"/>
							</div><!--close button_small-->   
					<!----------------------------------------------------------------------------------------------------------->
					</dl>
					</form>	

					</header>
				</div>
			</section>

		
		<!-- Footer and Scripts-->
		<?php 
			include "footer.php";
			include "script.php";
		?>

	</body>
</html>