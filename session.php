<?php
	function checkSession()
	{
		if(!isset($_SESSION))
		{ 
			session_start(); 
		}
		$username = $_SESSION['email'];
		
		if(empty($username))
		{
				return true;//If session is empty return true 
		}
		return false;
	}
?>