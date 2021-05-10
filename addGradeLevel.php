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
			<a href="gradeLevel.php" class="logo">GRADE LEVEL</a>
		</header>
		
		<!--Navigation menu-->
		<?php
            include "menu.php";
            include "util.php";
		?>

        <!-- Main -->
		<section id="main" class="wrapper">
            <h1 align = "center"><a href="#">Add New Project Grade Level</a></h1>
			<div class="container">	
                <div class="inner">
                
                    <!--PHP Code--->
                    <?php
                        //always initialize variables to be used
                        $gradeLevel = "";
                        $active = "";
                        $msg = "";

                        $yesChecked = "";
                        $noChecked = "";
                        $gradeLevelOk= false;
                        $activeOk = false;

                        if (isset($_POST['submit'])) //check if this page is requested after Submit button is clicked
                        {
                    
                            //take the information submitted and send to a process file
                            //always trim the user input to get rid of the additiona white spaces on both ends of the user input
                            $gradeLevel = trim($_POST['gradeLevel']);
                            
                            //VALIDATION
                            if (!isset($_POST['active']))
                            {
                                $msg = $msg . '<br/><b>Please select if active.</b>';
                            }
                            else
                            {
                                $active = $_POST['active'];
                                //taking the selected value for active
                                if ($active=="Yes") 
                                {
                                    $yesChecked="checked";
                                    $noChecked="";
                                }
                                else 
                                {
                                    $yesChecked="";
                                    $noChecked="checked";
                                }
                                $activeOk = true;
                            }
                            //Making sure the required fields are not empty
                            if ($gradeLevel== "")
                            {
                                $msg = $msg . '<br/><b>Please enter the Project Grade Level.</b>';
                            }
                            else
                            {
                                $gradeLevelOk= true;
                            }
                    
                            //if everything is correct
                            if ($gradeLevelOk && $activeOk) 
                            {
                                //query to send data to database
                                $statement = "INSERT INTO PROJECT_GRADE_LEVEL(LevelName, Active) VALUES('$gradeLevel', '$active')";

                                //direct to another page to process using query strings
                                // $_SESSION['gradeLevel']= $gradeLevel;
                                // $_SESSION['active']=$active;
                                // $msg = '<br/><b>New project Grade Level added</b><br/>';
                                if(!mysql_query($statement))
                                {
                                    die("Error adding");
                                }
                                else
                                { 
                                    mysql_close();
                                    die("New Project Grade Level Added");
                                }
                            }                
                        }	
                    ?>

                    <!-- Form -->
                    <form method="post" action="addGradeLevel.php">
                        <?php
                            print $msg;
                        ?>
                        <div class="row uniform">
                            <div class="12u$">
                                <b>Project Grade Level<sup>*</sup></b>
                                <input type="text" maxlength="20" name="gradeLevel" id="gradeLevel" placeholder="1" />
                            </div>
                            <!-- Break -->
                            <div class="row uniform">
                                <b>Active<sup>*</sup></b>
                                <div class="4u 12u$(small)">
                                    <input type="radio" name="active" id = "yes" value = "Yes" <?php print $yesChecked; ?> />
                                    <label for="yes">Yes</label>
                                </div>
                                <div class="4u$ 12u$(small)">
                                    <input type="radio" name="active" id = "no" value = "No" <?php print $noChecked; ?> />
                                    <label for="no">No</label>
                                </div>
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