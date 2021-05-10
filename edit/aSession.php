<?php
	function checkAdminSession()
	{
		if(!isset($_SESSION))
		{ 
			session_start(); 
		}
		$ausername = $_SESSION['aEmail'];

		if(empty($ausername))
		{
				return true;//If session is empty return true 
		}
		return false;
	}
	
?>