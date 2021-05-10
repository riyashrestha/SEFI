<?

require_once "dbconnect.php";

if(isset($_GET["edit"]))
{
	$ID = $_GET["edit"];
	$query = "SELECT * from ADMIN where AdminID ='".$ID."'"; 
	$result = mysql_query($query) or die ( mysql_error());
	$row = mysql_fetch_array($result);
    
}

?>


<!DOCTYPE html>
	<html>
		<head>
			<title>Update Record</title>
			<link rel="stylesheet" href="css/style.css" />
		</head>
		<body>
		<div class="form">
			<h1>Update Record</h1>

			<?php

			$status = "";
			if(isset($_POST['new']) && $_POST['new']==1)
			{
				$ID = $_REQUEST['edit'];

				$newfn = trim($_POST['name']);

				$newm = trim($_POST['mName']);;

				$newln = trim($_POST['lname']);;

				$update = "UPDATE ADMIN set FirstName = '$newfn', MiddleName= '$newm', LastName = '$newln' where AdminID = '".$ID."'";

				mysql_query($update) or die(mysql_error());

				$status = "Record Updated Successfully. </br></br>

				<a href='view.php'>View Updated Record</a>";

				echo '<p style="color:#FF0000;">'.$status.'</p>';
			}
			else
			{
				?>
	
				<form name="form" method="post" action=""> 

					<input type="hidden" name="new" value="1" />
					<input name="id" type="hidden" value="<?php echo $row['AdminID'];?>" />
					<p><input type="text" name="name" id = "name" placeholder="First Name" required value="" /></p>
					<p><input type="text" name="mName" id = "lname"placeholder="Last Name" required value="" /></p>
					<p><input type="text" name="lname" id = "lname"placeholder="Last Name" required value="" /></p>
					<p><input name="submit" type="submit" value="Update" /></p>
				</form>

			<?php } ?>
		</div>
		</div>
		</body>
	</html>