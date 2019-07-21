<?php	

	require_once '../components/connection.php';

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
		else
		{
			$territory = $_POST['select_district'];
		}

		$check_for_email_sql = "SELECT email FROM t_registered_individuals WHERE email = '$email'";
		$check_for_email = mysqli_num_rows(mysqli_query($connection,$check_for_email_sql));

		if(empty($check_for_email))
		{
			$sql = "INSERT INTO t_registered_individuals (name, email, territory) VALUES ('$name','$email','$territory')";
			if(mysqli_query($connection,$sql))
			{
				echo "<div class ='greet_message'>Успішно!</div>";
			}
			else
				echo mysqli_error($connection);
		}
		else if(!empty($check_for_email))
		{
			$sql_get = "SELECT t_registered_individuals.name as name, t_registered_individuals.email as email, t_koatuu_tree.ter_address as territory FROM t_registered_individuals INNER JOIN t_koatuu_tree ON t_registered_individuals.territory = t_koatuu_tree.ter_id WHERE t_registered_individuals.email = '$email'";
		    $query_get = mysqli_query($connection,$sql_get);
			
			echo "<div class ='greet_message' style ='font-size: 20px;'>Email $email вже є у базі!</div>";
			
			echo "<table style ='margin: 0 auto;text-align: center;'>
				  <tr>
				  <th style ='width:200px'>ПІБ</th>
				  <th style ='width:200px'>Email</th>
				  <th style ='width:500px'>Адреса</th>
				  </tr>";
				  
			while($row = mysqli_fetch_array($query_get))
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
	
	
	