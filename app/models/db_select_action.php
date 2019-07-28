<?php	

	require_once 'db_action.php';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$action = new DbAction;
		
		if(!empty($_POST['action']) and $_POST['action'] == "region")
		{
			$action->selectRegion();
		}
		else if(!empty($_POST['action']) and $_POST['action'] == "city")
		{
			$action->selectCity();
		}
		else if(!empty($_POST['action']) and $_POST['action'] == "special")
		{
			$action->selectSpecial();
		}
		else if(!empty($_POST['action']) and $_POST['action'] == "district")
		{
			$action->selectDistrict();
		}
		else
		{
			$action->registerData();
		}
	}
	
	