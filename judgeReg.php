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
            <div class="container">
                <div class="inner">
                    <!--header class="align-left"-->
                    <h1 align = "center"><a href="#">Judge Registration</a></h1>  
                    
                    <!--PHP Code--->
                    <?php
                        //always initialize variables to be used
                        $fn = "";
                        $mn = "";
                        $ln = "";
                        $title = "";
                        $degree = "";
                        $employer = "";
                        $gradePref = "";
                        $categoryPref = "";
                        $em = "";
                        $cem = "";
                        $pwd = "";
                        $cpwd = "";
                        $msg = "";
                        
                        $fnOk = false;
                        $lnOk = false;
                        $titleOk = false;
                        $degreeOk = false;
                        $employerOk = false;
                        $emailOk = false;
                        $pwdOk = false;

                        if (isset($_POST['submit'])) //check if this page is requested after Submit button is clicked
                        {
                            
                            //take the information submitted and send to a process file
                            //always trim the user input to get rid of the additiona white spaces on both ends of the user input
                            $fn = trim($_POST['firstName']); 
                            $mn = trim($_POST['middleName']);
                            $ln = trim($_POST['lastName']);

                            $title = trim($_POST['title']);
                            $degree = trim($_POST['degree']);
                            $employer = trim($_POST['employer']);
                            if (isset($_POST['grade']))
                            {
                                $gradePref = trim($_POST['grade']);
                            }
                            if (isset($_POST['category']))
                            {
                                $categoryPref = trim($_POST['category']);
                            }
                            $em = trim($_POST['email']);
                            $cem = trim($_POST['confirmEmail']);

                            $pwd = $_POST['password'];
                            $cpwd = $_POST['confirmPassword'];
                            
                            //$birthYear = $_POST['birthYear'];

                            //VALIDATION
                            //Validating email
                            if (!spamcheck($em))
                            {
                                $msg = $msg . '<br/><b>Email is not valid.</b>';
                            }
                            //Matching the emails       
                            else if ($em!=$cem)
                            {
                                $msg = $msg . '<br/><b>Emails are not the same.</b>';
                            }
                            else 
                            {
                                $emailOk = true;
                            }
                            
                            //Making sure the required fields are not empty
                            if ($fn== "")
                                $msg = $msg . '<br/><b>Please enter your First Name.</b>';
                            else
                                $fnOk = true;
                            
                            if ($ln== "")
                                $msg = $msg . '<br/><b>Please enter your Last Name.</b>';
                            else
                                $lnOk = true;

                            if ($title== "")
                                $msg = $msg . '<br/><b>Please enter your title.</b>';
                            else
                                $titleOk = true;
                            
                            if ($degree== "")
                                $msg = $msg . '<br/><b>Please enter your degree.</b>';
                            else
                                $degreeOk = true;
                            
                            if ($employer== "")
                                $msg = $msg . '<br/><b>Please enter your employer.</b>';
                            else
                                $employerOk = true;

                            if ($pwd== "")
                            {
                                $msg = $msg . '<br/><b>Please enter your Password.</b>';
                                $pwdOk = false;
                            }
                            
                            if ($cpwd== "")
                            {
                                $msg = $msg . '<br/><b>Please enter your confirm Password.</b>';
                                $pwdOk = false;
                            }

                            if ($em== "")
                            {
                                $msg = $msg . '<br/><b>Please enter your Email.</b>';
                                $emailOk = false;
                            }
                            
                            if ($cem== "")
                            {
                                $msg = $msg . '<br/><b>Please enter your confirm Email.</b>';
                                $emailOk = false;
                            }
                                
                            //Matching the passwords
                            if ($pwd != $cpwd)
                                $msg = $msg . '<br/><b>Passwords are not the same.</b>';
                            else $pwdOk = true;

                            //Assigning actual value to the degree
                            switch($degree)
                            {
                                case "1":
                                    $degree = "High School Diploma";
                                    break;
                                case "2":
                                    $degree = "Associate Degree";
                                    break;
                                case "3":
                                    $degree = "Bachelor's Degree";
                                    break;
                                case "4":
                                    $degree = "Master's Degree";
                                    break;
                                case "5":
                                    $degree = "PHD";
                                    break;
                                default:
                                    $degree = "";

                            }

                            //if everything is correct
                            if ($fnOk && $lnOk && $emailOk && $pwdOk) 
                            {
                                //query to send data to database
                                $query1 = "INSERT INTO JUDGE (FirstName, MiddleName, LastName, Title, HighestDegreeEarned, Employer, Email, Username, Password)
                                VALUES ('$fn', '$mn', '$ln', '$title', '$degree', '$employer', '$em', '$em', '$pwd')";

                                if(!mysql_query($query1))
                                {
                                    die("Error registering");
                                }
                                else
                                {
                                    //selecting judgeID to add grade and category preferences (if any)
                                    $query2 = 'SELECT JudgeID FROM JUDGE WHERE Username = "'.$em.'" ';
                                    $result2 = mysql_query($query2);
                                    if($row = mysql_fetch_array($result2))
                                    {   
                                        $judgeID = $row["JudgeID"];
                                    }
                                    //adding grade preference to database (if any)
                                    if($gradePref != "")
                                    {
                                        
                                        // if($row = mysql_fetch_array($result))
                                        // {
                                        //     $judgeID = $row[""]
                                        // }
                                        $query3 = "INSERT INTO JUDGE_GRADE_PREFERENCE (JudgeID, GradeID) VALUES ($judgeID, $gradePref)";
                                        if(!mysql_query($query3))
                                        {
                                            die("Error adding grade preference.");
                                        }
                                    }
                                    //adding category preference to database (if any)
                                    if($categoryPref != "")
                                    {
                                        $query4 = "INSERT INTO JUDGE_CATEGORY_PREFERENCE (JudgeID, CategoryID) VALUES ($judgeID, $categoryPref)";
                                        if(!mysql_query($query4))
                                        {
                                            die("Error adding category preference.");
                                        }
                                    }
                                    mysql_close();
                                    header("Location: judgeProcess.php"); 
                                }

                                

                                //now send the email to the username registered for activating the account
                                $code = randomCodeGenerator(50);
                                $subject = "Email Activation";
                                                    
                                $body = 'Hello '.$fn.'! '.'Thank you for registering. Please click on this url to activate your account.
                                        http://corsair.cs.iupui.edu:24471/judgeLogin.php?a='.$code;

                                //use PHP built-in functions, see details on https://www.w3schools.com/php/func_mail_mail.asp
                                $body = wordwrap($body,70);// use wordwrap() if lines are longer than 70 characters
                                if(!mail($em,$subject,$body)) //mail() functions returns a hash value of the address parameter, or false
                                    $msg = "Email not sent. " . $em.' '. $fn.' '. $subject.' '. $body;
                                else $msg = "<b>Thank you for registering. A welcome message has been sent to the address you have just registered.</b>";

                                //direct to another page to process using query strings
                                $_SESSION['firstName']= $fn;
                                $_SESSION['middleName']= $mn;
                                $_SESSION['lastName']= $ln;
                                $_SESSION['title']= $title;
                                $_SESSION['degree']= $degree;
                                $_SESSION['employer']= $employer;
                                $_SESSION['grade']= $gradePref;
                                $_SESSION['category']= $categoryPref;
                                $_SESSION['email']= $em;
                                $_SESSION['password']=$pwd;
                            }                
                        }
                        
                    ?>

                    <!-- Form -->
                    <form method="post" action="judgeReg.php">
                        <?php
                            print $msg;
                        ?>
                        <div class="row uniform">
                            <div class="4u 12u$(small)">
                                <label for = "firstName">First Name<sup>*</sup></label>
                                <input type="text" maxlength="30" name="firstName" id="firstName" value="<?php print $fn; ?>" placeholder="John" />
                            </div>
                            <div class="4u 12u$(small)">
                                <label for = "middleName">Middle Name</label>
                                <input type="text" maxlength="30" name="middleName" id="middleName" value="<?php print $mn; ?>" placeholder="Adam" />
                            </div>
                            <div class="4u 12u$(small)">
                                <label for = "lastName">Last Name<sup>*</sup></label>
                                <input type="text" maxlength="30" name="lastName" id="lastName" value="<?php print $ln; ?>" placeholder="Doe" />
                            </div>
                            <!-- Break -->
                            <div class="6u 12u$(small)">
                                <label for = "title">Title<sup>*</sup></label>
                                <input type="text" maxlength="30" name="title" id="title" value="<?php print $title; ?>" placeholder="Title" />
                            </div>
                            <div class="6u 12u$(small)">
                                <label for = "degree">Highest Degree Earned<sup>*</sup></label>
                                <div class="select-wrapper">
                                    <select name="degree" id="degree">
                                        <option value="" selected>Degree</option>
                                        <option value="1">High School Diploma</option>
                                        <option value="2">Associate Degree</option>
                                        <option value="3">Bachelor's Degree</option>
                                        <option value="4">Master's Degree</option>
                                        <option value="5">PHD</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Break -->
                            <div class="12u$">
                                <label for = "employer">Employer<sup>*</sup></label>
                                <input type="text" maxlength="50" name="employer" id="employer" value="<?php print $employer; ?>" placeholder="Employer" />
                            </div>
                            <!-- Break -->
                            <div class="6u 12u$(small)">
                                <label for = "grade">Grade Preference</label>
                                <div class="select-wrapper">
                                    <select name="grade" id="grade">
                                        <option value="" selected>Grade</option>
                                        <?php
                                            $query = "SELECT * FROM GRADE"; 
                                            $result = mysql_query($query);
                                            while($row = mysql_fetch_array($result))
                                            {   
                                                print '<option value = "'.$row["GradeID"].'">'.$row["Grade"].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="6u 12u$(small)">
                                <label for = "category">Category Preference</label>
                                <div class="select-wrapper">
                                    <select name="category" id="category">
                                    <option value="" selected>Category</option>
                                        <?php
                                            $query = "SELECT * FROM CATEGORY"; 
                                            $result = mysql_query($query);
                                            while($row = mysql_fetch_array($result))
                                            {   
                                                print '<option value = "'.$row["CategoryID"].'">'.$row["CategoryName"].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Break -->
                            <div class="6u 12u$(small)">
                                <label for = "email">Username (Email)<sup>*</sup></label>
                                <input type="text" name="email" id="email" maxlength="50" value="<?php print $em; ?>" placeholder="johndoe@gmail.com" />
                            </div>
                            <div class="6u 12u$(small)">
                                <label for = "confirmEmail">Confirm Username<sup>*</sup></label>
                                <input type="text" name="confirmEmail" id="confirmEmail" maxlength="50" value="<?php print $cem; ?>" placeholder="johndoe@gmail.com" />
                            </div>
                            <!-- Break -->
                            <div class="6u 12u$(small)">
                                <label for = "password">Password<sup>*</sup></label>
                                <input type="password" name="password" id="password" maxlength="50" value="<?php print $pwd; ?>" placeholder="Password" />
                            </div>

                            <div class="6u 12u$(small)">
                                <label for = "confirmPassword">Confirm Password<sup>*</sup></label>
                                <input type="password" name="confirmPassword" id="confirmPassword" maxlength="50" value="<?php print $cpwd; ?>" placeholder="Confirm Password" />
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
