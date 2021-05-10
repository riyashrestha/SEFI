Another test

<?
	$result = mysql_query("SELECT JudgeID FROM JUDGE");
	$storeJudge = Array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
	{
   		$storeJudge[] =  $row['JudgeID'];  
	}

	$finish = mysql_query("SELECT ProjectID FROM PROJECT");
	$storeProject = Array();
	while ($row = mysql_fetch_array($finish, MYSQL_ASSOC)) 
	{
   		$storeProject[] =  $row['ProjectID'];  
	}

	$execute = mysql_query("SELECT SessionID FROM SESSION");
	$storeSession = Array();
	while ($row = mysql_fetch_array($execute, MYSQL_ASSOC)) 
	{
   		$storeSession[] =  $row['SessionID'];  
	}

	
	$arrayLength = count($storeProject);
	$x = 0;
        while ($x < $arrayLength)
        {
	    $JudgeIden = $storeJudge[$x];
	    $ProjectIden = $storeProject[$x];            
	    $SessionIden = $storeSession[$x];

	    $line = mysql_query("INSERT INTO SCHEDULE(SessionID, ProjectID, JudgeID, Score) VALUES ('$SessionIden, $ProjectIden, $JudgeIden, '');
            $x++;
        }


?>
