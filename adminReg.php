<?php
	session_start();
    include "header.php";
    include "util.php";
    require_once "dbconnect.php";
    require_once "mail/mail.class.php";
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
            <div class="inner">
                <!--header class="align-left"-->
                <h1 align = "center"><a href="#">Enter a new Admin</a></h1>  
                
                <!--PHP Code--->
                <?php
                    //always initialize variables to be used
                    $fn = "";
                    $mn = "";
                    $ln = "";
                    $em = "";
                    $cem = "";
                    $pwd = "";
                    $cpwd = "";
                    $adminLevel = "";
                    $active = "";
                    $msg = "";

                    $yesChecked = "";
                    $noChecked = "";
            
                    $fnOk = false;
                    $lnOk = false;
                    $emailOk = false;
                    $pwdOk = false;
                    $adminLevelOk = false;
                    $activeOk = false;

                    if (isset($_POST['submit'])) //check if this page is requested after Submit button is clicked
                    {
                
                        //take the information submitted and send to a process file
                        //always trim the user input to get rid of the additiona white spaces on both ends of the user input
                        $fn = trim($_POST['firstName']);
                        $mn = trim($_POST['middleName']);
                        $ln = trim($_POST['lastName']);

                        $em = trim($_POST['email']);
                        $cem = trim($_POST['confirmEmail']);

                        $pwd = $_POST['password'];
                        $cpwd = $_POST['confirmPassword'];
                        
                        if (isset($_POST['adminLevel']))
                            $adminLevel = trim($_POST['adminLevel']);
                        if (isset($_POST['active']))
                            $active = $_POST['active'];


                        //VALIDATION
                        //Validating email
                        if (!spamcheck($em))
                        {							
                            $msg = $msg . '<br/><b>Email is not valid.</b>';
                        }
                        //Matching the emails       
                        elseif ($em!=$cem)
                        {
                            $msg = $msg . '<br/><b>Emails are not the same.</b>';
                        }
                        else 
                        {
                            $emailOk = true;
                        }

                        //Making sure the required fields are not empty
                        if ($fn== "")
                        {
                            $msg = $msg . '<br/><b>Please enter the First Name</b>';
                        }
                        else
                        {
                            $fnOk = true;
                        }
                
                        if ($ln== "")
                        {
                            $msg = $msg . '<br/><b>Please enter the Last Name</b>';
                        }
                        else
                        {
                            $lnOk = true;
                        }

                        if ($pwd== "")
                        {
                            $msg = $msg . '<br/><b>Please enter the Password</b>';
                        }
                
                        //Matching the passwords
                        if ($pwd != $cpwd)
                        {
                            $msg = $msg . '<br/><b>Passwords are not the same.</b>';
                        }
                        else 
                        {
                            $pwdOk = true;
                        }

                        if ($adminLevel == "")
                        {
                            $msg = $msg . '<br/><b>Please select the admin level.</b>';
                        }
                        else
                        {
                            //assigning actual value for the admin level
                            switch ($adminLevel)
                            {
                                case "1":
                                    $adminLevel = "Regular Admin";
                                    break;
                                case "2":
                                    $adminLevel = "Grade Level Chair";
                                    break;
                                default:
                                    $adminLevel = "";
                                    break;
                            }
                            $adminLevelOk = true;

                        }
                        
                        if ($active == "")
                        {
                            $msg = $msg . '<br/><b>Please select if active.</b>';
                        }
                        else
                        {
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

                        //if everything is correct
                        if ($fnOk && $lnOk && $emailOk && $pwdOk && $adminLevelOk && $activeOk) 
                        {
                            $_SESSION['firstName']= $fn;
                            $_SESSION['middleName']= $mn;
                            $_SESSION['lastName']= $ln;
                            $_SESSION['email']= $em;
                            $_SESSION['password']=$pwd;
                            $_SESSION['adminLevel']= $adminLevel;
                            $_SESSION['active']=$active;

                            //query to send data to datab

                            $statement = "INSERT INTO ADMIN(FirstName, LastName, MiddleName, Email, Password, Level, Active) VALUES('$fn', '$ln', '$mn', '$em', '$pwd', '$adminLevel', '$active')";
                            mysql_query($statement);
                            mysql_close();

                            //now send the email to the username registered for activating the account
                            $code = randomCodeGenerator(50);
                            $subject = "Email Activation";
                                                
                            $body = 'Hello '.$fn.'! '.'Thank you for registering. Please click on this url to activate your account.
                                    http://corsair.cs.iupui.edu:24471/adminLogin.php?a='.$code;

                            //use PHP built-in functions, see details on https://www.w3schools.com/php/func_mail_mail.asp
                            $body = wordwrap($body,70);// use wordwrap() if lines are longer than 70 characters
                            if(!mail($em,$subject,$body)) //mail() functions returns a hash value of the address parameter, or false
                                $msg = "Email not sent. " . $em.' '. $fn.' '. $subject.' '. $body;
                            else $msg = "<b>Thank you for registering. A welcome message has been sent to the address you have just registered.</b>";

                            //direct to another page to process using query strings
                            $_SESSION['code'] = $code;
                            header("Location: adminProcess.php");
                        }                
                    }
		        ?>

                <!-- Form -->
                <form method="post" action="adminReg.php">
                    <?php
                        print $msg;
                    ?>
                    <div class="row uniform">
                        <div class="4u 12u$(small)">
                            <b>First Name<sup>*</sup></b>
                            <input type="text" maxlength="50" name="firstName" id="firstName" value="<?php print $fn; ?>" placeholder="John" />
                        </div>
                        <!-- Break -->
                        <div class="4u 12u$(small)">
                            <b>Middle Name</b>
                            <input type="text" maxlength="50" name="middleName" id="middleName" value="<?php print $mn; ?>" placeholder="Adam" />
                        </div>
                        <!-- Break -->
                        <div class="4u$ 12u$(small)">
                            <b>Last Name<sup>*</sup></b>
                            <input type="text" maxlength="50" name="lastName" id="lastName" value="<?php print $ln; ?>" placeholder="Doe" />
                        </div>
                        <!-- Break -->
                        <div class="6u 12u$(small)">
                            <b>Username (Email)<sup>*</sup></b>
                            <input type="text" name="email" id="email" maxlength="80" value="<?php print $em; ?>" placeholder="johndoe@gmail.com" />
                        </div>
                        <!-- Break -->
                        <div class="6u$ 12u$(small)">
                            <b>Confirm Username<sup>*</sup></b>
                            <input type="text" name="confirmEmail" id="confirmEmail" maxlength="80" value="<?php print $cem; ?>" placeholder="johndoe@gmail.com" />
                        </div>
                        <!-- Break -->
                        <div class="6u 12u$(small)">
                            <b>Password<sup>*</sup></b>
                            <input type="password" name="password" id="password" maxlength="30" value="<?php print $pwd; ?>" placeholder="Password" />
                        </div>
                        <!-- Break -->
                        <div class="6u$ 12u$(small)">
                            <b>Confirm Password<sup>*</sup></b>
                            <input type="password" name="confirmPassword" id="confirmPassword" maxlength="30" value="<?php print $cpwd; ?>" placeholder="Confirm Password" />
                        </div>	
                        <!-- Break -->
                        <div class="12u$">
                            <b>Admin Level<sup>*</sup></b>
                            <div class="select-wrapper">
                                <select name="adminLevel" id="adminLevel">
                                        <option value="" selected>Admin Level</option>
                                        <option value="1">Regular Admin</option>
                                        <option value="2">Grade Level Chair</option>
                                </select>
                            </div>
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
                                <li><input type="submit" name = "submit"  value="Register"/></li>
                                <li><input type="reset" name ="reset" value="Reset" class="alt" /></li>
                            </ul>
                        </div>
                    </div>
                </form>
        
            </div><!--close inner-->
        </section>
       
        <!-- Footer and Scripts-->
        <?php 
            include "footer.php";
            include "script.php";
        ?>
	</body>
</html>
