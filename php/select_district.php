<?php	

	require_once 'connection.php';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$ter_id = $_POST['city'];
		
		$sql ="SELECT ter_id, ter_pid, ter_name FROM t_koatuu_tree WHERE '$ter_id' = ter_pid AND ter_type_id = ter_level";
		$query = mysqli_query($connection,$sql);

		echo "<option value='none'></option>";
		
		while($row = mysqli_fetch_array($query))
		{
			echo "<option value='" . $row['ter_id'] . "'>" . $row['ter_name'] . "</option>";
		}
	}