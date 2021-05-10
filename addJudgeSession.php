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
			<a href="judgeSession.php" class="logo">JUDGE SESSION</a>
		</header>
		
		<!--Navigation menu-->
		<?php
            include "menu.php";
            include "util.php";
		?>

        <!-- Main -->
		<section id="main" class="wrapper">
            <h1 align = "center"><a href="#">Add New Judge Session</a></h1>
			<div class="container">	
                <div class="inner">
                
                    <!--PHP Code--->
                    <?php
                        //always initialize variables to be used
                        $sessionNumber = "";
                        $startTime = "";
                        $endTime = "";
                        $active = "";
                        $msg = "";

                        $yesChecked = "";
                        $noChecked = "";
                        $sessionNumberOk= false;
                        $startTimeOk = false;
                        $endTimeOk = false;
                        $activeOk = false;

                        if (isset($_POST['submit'])) //check if this page is requested after Submit button is clicked
                        {
                    
                            //take the information submitted and send to a process file
                            //always trim the user input to get rid of the additiona white spaces on both ends of the user input
                            $sessionNumber = trim($_POST['sessionNumber']);
                            $startTime = $_POST['startTime'];
                            $endTime = $_POST['endTime'];

                            
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
                            if ($sessionNumber == "")
                            {
                                $msg = $msg . '<br/><b>Please enter the session number.</b>';
                            }
                            else
                            {
                                $sessionNumberOk= true;
                            }
                            if ($startTime == "")
                            {
                                $msg = $msg . '<br/><b>Please set the start time.</b>';
                            }
                            else
                            {
                                $startTimeOk = true;
                            }
                            if ($endTime == "")
                            {
                                $msg = $msg . '<br/><b>Please set the end time.</b>';
                            }
                            else
                            {
                                $endTimeOk= true;
                            }
                    
                            //if everything is correct
                            if ($sessionNumberOk && $startTimeOk && $endTimeOk && $activeOk) 
                            {
                                //query to send data to database
                                $statement = "INSERT INTO SESSION(SessionNumber, StartTime, EndTime, Active) VALUES($sessionNumber, '$startTime', '$endTime', '$active')";

                                //direct to another page to process using query strings
                                // $_SESSION['sessionNumber']= $sessionNumber;
                                // $_SESSION['startTime']=$startTime;
                                // $_SESSION['endTime']=$endTime;
                                // $_SESSION['active']=$active;
                                // $msg = '<br/><b>New Session added</b><br/>';
                                if(!mysql_query($statement))
                                {
                                    die("Error adding");
                                }
                                else
                                { 
                                    mysql_close();
                                    die("New Judge Session Added");
                                }
                            }                
                        }	
                    ?>

                    <!-- Form -->
                    <form method="post" action="addJudgeSession.php">
                        <?php
                            print $msg;
                        ?>
                        <div class="row uniform">
                            <div class="12u$">
                                <b>Session Number<sup>*</sup></b>
                                <input type="number" maxlength="11" name="sessionNumber" id="sessionNumber" placeholder="Session Number" />
                            </div>
                            <!-- Break -->
                            <div class="6u$">
                                <b>Start Time<sup>*</sup></b>
                                <input type="time" name="startTime" id="startTime" />
                            </div>
                            <div class="6u$">
                                <b>End Time<sup>*</sup></b>
                                <input type="time" name="endTime" id="endTime" />
                            </div>
                            <!-- Break -->
                            <div class="1u$ 12u$(small)">
                                <b>Active<sup>*</sup></b>
                            </div>
                            <div class="1u$ 12u$(small)">
                                <input type="radio" name="active" id = "yes" value = "Yes" <?php print $yesChecked; ?> />
                                <label for="yes">Yes</label>
                            </div>
                            <div class="1u$ 12u$(small)">
                                <input type="radio" name="active" id = "no" value = "No" <?php print $noChecked; ?> />
                                <label for="no">No</label>
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