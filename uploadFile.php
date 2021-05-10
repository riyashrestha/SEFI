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
            <a href="adminLanding.php" class="logo">Admin Controls</a>
		</header>
		
		<!--Navigation menu-->
		<?php
            include "menu.php";
        ?>

        <!--for uploading-->
        <?php
            //vairables
            $msg = "";
            $row = "";
            $newStudent = "";
            $newProject = "";
            $newSchool = "";
            $newGradeLevel = "";
            $newCategory = "";
            $newBooth = "";
            $fileName = "";
            $fileType = "";
            $fileSize = "";
            $fileError = "";
            $fileTempName = "";

            $newStudent = 0;
            $newProject = 0;
            $newSchool = 0;
            $newGradeLevel = 0;
            $newCategory = 0;
            $newBooth = 0;

            if(isset($_POST['submit']))
            {

                /* Make sure your program has "write" permission to the tmp directory in the root directory (the default temporary upload directory defined in php.ini file) 
                * as well as the final upload directory */

                //file properties
                $fileName = $_FILES["file"]["name"];
                $fileType = $_FILES["file"]["type"];
                $fileSize = $_FILES["file"]["size"];
                $fileError = $_FILES["file"]["error"];
                $fileTempName = $_FILES['file']['tmp_name'];

                $allowedExts = array("csv");

                $temp = explode(".", $fileName); //get the uploaded file name, use . to seperate the name and the extension into the temp array
                $extension = end($temp); //get the last element of the array, which will be the file extension

                if (($fileType == "text/csv") && ($fileSize < 20000000) && in_array($extension, $allowedExts))
                {
                    if ($fileError > 0)
                        {
                            print "Return Code: ".$fileError."<br>";
                        }
                    else
                    {
                        print "Uploaded File Name: ".$fileName."<br>";
                        print "Type: ".$fileType."<br>";
                        print "Size: ".( $fileSize / 1000)." kB<br>";
                        
                        //check if file is uploaded
                        if (is_uploaded_file($fileTempName)) 
                        {
                            print "File '".$fileName."' uploaded successfully.<br>";

                            //check if file exists
                            if (file_exists("csv/".$fileName))
                            {
                                print "File '".$fileName."' already exists.<br>";
                            }
                            else
                            {
                                //move file to server
                                move_uploaded_file($_FILES["file"]["tmp_name"],"csv/" . $_FILES["file"]["name"]);
                                print "<br/>File uploaded: ".$fileName."<br>";
                            }

                            //download file
                            // $filePath = "http://corsair.cs.iupui.edu:24561/N342_project/csv/".$fileName;
                            print 'Click <a href="http://corsair.cs.iupui.edu:24471/project/csv/">here</a> to download the csv file<br>';

                            $row = 1;
                            if (($fp = fopen("csv/".$fileName, "r")) !== FALSE) 
                            {
                                print "File read success<br>";
                                // start a table tag in the HTML
                                print '<table  id="example" class="display" cellspacing="0" width="100%">';
                                while (($data = fgetcsv($fp, 10000, ",")) !== FALSE) 
                                { 
                                    //read max 1000 characters. Omitting this will make the reading a bit slower
                                    $num = count($data);
                                    
                                    //print header
                                    if ($row ==1)
                                    {
                                        print "<thead>";
                                        print "<tr>";
                                        for ($c=0; $c < $num; $c++) 
                                        {
                                            print "<th>".$data[$c]."</th>";
                                        }
                                        print "</tr>";
                                        print "</thead>";
                                        $row = 0;
                                    }
                                    else 
                                    {
                                        //print other rows
                                        print "<tr>";
                                        for ($c=0; $c < $num; $c++) 
                                        {
                                            print "<td>".$data[$c]."</td>";
                                        }
                                        print "</tr>";
                                    
                                        //for adding student data to database
                                        $schoolName = strtoupper($data[5]);
                                        $query = "SELECT SchoolID FROM SCHOOL WHERE SchoolName = '".$schoolName."'";
                                        $result = mysql_query($query);
                                        while($row = mysql_fetch_array($result))
                                        {   
                                            $schoolID = $row["SchoolID"];
                                        }
                                        
                                        $statement1 = "INSERT INTO STUDENT(FirstName, LastName, MiddleName, GradeID, Gender, SchoolID, ProjectID, Year) 
                                        VALUES('$data[0]','$data[2]','$data[1]',$data[3],'$data[4]',$schoolID,$data[8],'$data[9]')";

                                        if(!mysql_query($statement1))
                                        {
                                            $msg = $msg . "Error adding student<br>";
                                        }
                                        else
                                        { 
                                            $newStudent++;
                                        }

                                        //for adding project data to database
                                        $statement2 = "SELECT * FROM PROJECT WHERE ProjectNumber = '".$data[10]."'";
                                        $query = mysql_query($statement2);
                                        if(mysql_num_rows($query) == 0)
                                        {
                                            $statement3 = "INSERT INTO PROJECT(ProjectNumber, Title, Abstract, GradeLevelID, CategoryID, BoothNumberID, GradeID, CourseNetworkID, AverageRanking, Year)
                                            VALUES($data[10],'$data[11]','$data[12]',$data[13],$data[14],$data[15],$data[3],$data[16],$data[17],'$data[9]')";

                                            if(!mysql_query($statement3))
                                            {
                                                $msg = $msg . "Error adding project<br>";
                                            }
                                            else
                                            { 
                                                $msg = $msg . "Project number".$data[8]."added <br>";
                                            }
                                        }
                                    }


                                }
                                print "</table>"; //Close the table in HTML
                                fclose($fp);
                                mysql_close();

                                //number of data added 
                                print "Number of Student Added:".$newStudent;
                                // print "Number of Project Added:".$newProject;
                            }
                            else die("Couldn't read file");
                        } 
                        else 
                        {
                            print "Unable to upload file ";

                        }

                        
                    }
                }
                else
                {
                    //different error messages for invalid file
                    if($_FILES["file"]["type"] == "text/csv")
                    {
                        print "Not a text/csv file";
                    }
                    else if($_FILES["file"]["size"] < 20000000)
                    {
                        print "File size should be less than 20MB";
                    }
                    else if(in_array($extension, $allowedExts))
                    {
                        print "File extension is not csv";
                    }
                    else
                    {
                        print "Invalid file";
                    }
                }
            }
        ?>
        
        <!-- Main -->
        <h1 align = "center">Upload File</h1>
		<div class="container">	
            <form action="uploadFile.php" method="post" enctype="multipart/form-data">
                <?php 
                    print $msg;
                ?>
                <label for="file">Filename:</label>
                <input type="file" name="file" id="file"><br>
                <input type="submit" name="submit" value="Upload">
            </form>
		</div><!--close container-->

		<!-- Scripts-->
		<?php 
			include "script.php";
		?>
	</body>
</html>