<?php
	
	class DbConnection
	{
		protected $db_server = 'localhost';
		protected $db_username = 'root';
		protected $db_password = '';
		protected $db_name = 'base';
		
		public function dbConnection() 
		{
			$dbConnection = new mysqli($this->db_server, $this->db_username, $this->db_password, $this->db_name);
			$dbConnection->query("SET NAMES utf8");
			
			if ($dbConnection === false) 
			{
				die($dbConnection->connect_error);
				return $dbConnection->connect_error;
			}
			else
			{
				return $dbConnection;
			}
		}
	}

