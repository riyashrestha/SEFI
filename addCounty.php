<?php
	require_once "aSession.php";
	if(checkAdminSession())
	{
		header("Location: login.php");
	}
	include "header.php";
	require_once "dbconnect.php";
?>
	<body>
		<!-- Header -->
		<header id="header">
			<nav class="left">
				<a href="#menu"><span>Menu</span></a>
			</nav>
			<a href="county.php" class="logo">COUNTY</a>
		</header>
		
		<!--Navigation menu-->
		<?php
            include "menu.php";
            include "util.php";
		?>

        <!-- Main -->
		<section id="main" class="wrapper">
            <h1 align = "center"><a href="#">Add New County</a></h1>
			<div class="container">	
                <div class="inner">
                
                    <!--PHP Code--->
                    <?php
                        //always initialize variables to be used
                        $countyName = "";
                        $msg = "";
                
                        $countyNameok = false;

                        if (isset($_POST['submit'])) //check if this page is requested after Submit button is clicked
                        {
                    
                            //take the information submitted and send to a process file
                            //always trim the user input to get rid of the additiona white spaces on both ends of the user input
                            $countyName = trim($_POST['countyName']);

                            //VALIDATION
                            //Making sure the required fields are not empty
                            if ($countyName== "")
                            {
                                $msg = $msg . '<br/><b>Please enter the county Name</b>';
                            }
                            else
                            {
                                $countyNameok = true;

                            }
                    
                            //if everything is correct
                            if ($countyNameok) 
                            {
                                //query to send data to database
                                $statement = "INSERT INTO COUNTY(CountyName) VALUES ('$countyName')";

                                //direct to another page to process using query strings
                                // $_SESSION['countyName']= $countyName;
                                // $msg = '<br/><b>New County added</b><br/>';
                                if(!mysql_query($statement))
                                {
                                        die("Error adding");
                                }
                                else
                                { 
                                    mysql_close();
                                    die("New County Added");
                                }
                            }                
                        }	
                    ?>

                    <!-- Form -->
                    <form method="post" action="addCounty.php">
                        <?php
                            print $msg;
                        ?>
                        <div class="row uniform">
                            <div class="12u$">
                                County Name<sup>*</sup>
                                <input type="text" maxlength="50" name="countyName" id="countyName" value="<?php print $countyName; ?>" placeholder="Marion" />
                            </div>
                            <!-- Break -->
                            <!--Submit buttons-->
                            <div class="12u$">
                                <ul class="actions">
                                    <li><input type="submit" name = "submit"  value="Add"/></li>
                                    <li><input type="reset" name ="reset" value="Reset" class="alt" /></li>
                                </ul>
                            </div>
                        </div>
                    </form><!--close form-->
                </div><!--close inner wrapper-->
            </div><!--close container wrapper-->
        </section><!--close section wrapper-->

		<!-- Footer and Scripts-->
		<?php 
			include "footer.php";
			include "script.php";
		?>
	</body>
</html>