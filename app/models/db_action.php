<?php
	
	require_once '../components/db_connection.php';
	
	class DbAction extends DbConnection
	{		
		public function selectRegion()
		{
			if ($_SERVER["REQUEST_METHOD"] == "POST") 
			{
				$sql ="SELECT ter_address, ter_id, reg_id FROM t_koatuu_tree WHERE reg_id IN (SELECT DISTINCT reg_id FROM t_koatuu_tree) GROUP BY reg_id HAVING COUNT(reg_id) > 1";
				$query = parent::dbConnection()->query($sql);

				echo "<option value='none'></option>";
				
				while($row = $query->fetch_array())
				{
					echo "<option value='" . $row['reg_id'] . "," . $row['ter_id'] . "'>" . $row['ter_address'] . "</option>";
				}
			}
		}
		public function selectCity()
		{	
			if ($_SERVER["REQUEST_METHOD"] == "POST") 
			{
				$reg_id = $_POST['region'];
				
				$sql ="SELECT ter_name, ter_id FROM t_koatuu_tree WHERE reg_id = '$reg_id' AND ter_type_id = 1";
				$query = parent::dbConnection()->query($sql);
				$num_rows = $query->num_rows;
				
				if(!empty($num_rows))
				{
					echo "<option value='none'></option>";
					
					while($row = $query->fetch_array())
					{
						echo "<option value='" . $row['ter_id'] . "'>" . $row['ter_name'] . "</option>";
					}
				}
				else
				{
					echo "empty";
				}
			}
		}
		public function selectDistrict()
		{
			if ($_SERVER["REQUEST_METHOD"] == "POST") 
			{
				$ter_pid = $_POST['city'];
				
				$sql ="SELECT ter_id, ter_pid, ter_name FROM t_koatuu_tree WHERE ter_pid = '$ter_pid' AND ter_type_id = ter_level";
				$query = parent::dbConnection()->query($sql);
				$num_rows = $query->num_rows;
				
				if(!empty($num_rows))
				{
					echo "<option value='none'></option>";
					
					while($row = $query->fetch_array())
					{
						echo "<option value='" . $row['ter_id'] . "'>" . $row['ter_name'] . "</option>";
					}
				}
				else
				{
					echo "empty";
				}
			}
		}
		public function selectSpecial()
		{
			if ($_SERVER["REQUEST_METHOD"] == "POST") 
			{
				$ter_pid = $_POST['special_region'];
				
				$sql ="SELECT ter_id, ter_name FROM t_koatuu_tree WHERE ter_pid = '$ter_pid'";
				$query = parent::dbConnection()->query($sql);
				$num_rows = $query->num_rows;
				
				if(!empty($num_rows))
				{
					echo "<option value='none'></option>";
					
					while($row = $query->fetch_array())
					{
						echo "<option value='" . $row['ter_id'] . "'>" . $row['ter_name'] . "</option>";
					}
				}
				else
				{
					echo "empty";
				}
			}
		}
		public function registerData()
		{
			if($_SERVER["REQUEST_METHOD"] == "POST") 
			{
				if(!empty($_POST['name']))
				{
					$name = $_POST['name'];
				}
				if(!empty($_POST['email']))
				{
					$email = $_POST['email'];
				}
				if(!empty($_POST['select_region'] and $_POST['select_region'] != "none" and !empty($_POST['select_city']) and $_POST['select_city'] != "none") and !empty($_POST['select_district']) and $_POST['select_district'] != "none")
				{
					$territory = $_POST['select_district'];
				}
				else if(!empty($_POST['select_region'] and $_POST['select_region'] != "none" and !empty($_POST['select_city']) and $_POST['select_city'] != "none") and !empty($_POST['select_district']) and $_POST['select_district'] == "none")
				{
					$territory = $_POST['select_city'];
				}
				else if(!empty($_POST['select_region'] and $_POST['select_region'] != "none" and !empty($_POST['select_city']) and $_POST['select_city'] != "none") and empty($_POST['select_district']))
				{
					$territory = $_POST['select_city'];
				}
				else
				{
					$territory = $_POST['select_district'];
				}
	
				$check_for_email_sql = "SELECT email FROM t_registered_individuals WHERE email = '$email'";
				$check_for_email_query = parent::dbConnection()->query($check_for_email_sql);
				$check_for_email = $check_for_email_query->num_rows;

				if(empty($check_for_email))
				{
					$sql = "INSERT INTO t_registered_individuals (name, email, territory) VALUES ('$name','$email','$territory')";
					if(parent::dbConnection()->query($sql))
					{
						echo "<div class ='greet_message'>Успішно!</div>";
					}
					else
						echo parent::dbConnection()->error;
				}
				else if(!empty($check_for_email))
				{
					$sql_get = "SELECT t_registered_individuals.name as name, t_registered_individuals.email as email, t_koatuu_tree.ter_address as territory FROM t_registered_individuals INNER JOIN t_koatuu_tree ON t_registered_individuals.territory = t_koatuu_tree.ter_id WHERE t_registered_individuals.email = '$email'";
					$query_get = parent::dbConnection()->query($sql_get);
					
					echo "<div class ='greet_message' style ='font-size: 20px;'>Email $email вже є у базі!</div>";
					
					echo "<table style ='margin: 0 auto;text-align: center;'>
						  <tr>
						  <th style ='width:200px'>ПІБ</th>
						  <th style ='width:200px'>Email</th>
						  <th style ='width:500px'>Адреса</th>
						  </tr>";
						  
					while($row = $query_get->fetch_array())
					{
						echo "<tr>
							 <td>" . $row['name'] . "</td>
							 <td>" . $row['email'] . "</td>
							 <td>" . $row['territory'] . "</td>";
					}
					echo "</tr>
						 </table>";
				}
			}
		}
	}
	
	