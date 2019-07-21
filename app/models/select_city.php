<?php	
	
	require_once '../components/connection.php';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$reg_id = $_POST['region'];
		
		$sql ="SELECT ter_name, ter_id FROM t_koatuu_tree WHERE reg_id = '$reg_id' AND ter_type_id = 1";
		$query = mysqli_query($connection,$sql);

		echo "<option value='none'></option>";
		
		while($row = mysqli_fetch_array($query))
		{
			echo "<option value='" . $row['ter_id'] . "'>" . $row['ter_name'] . "</option>";
		}
	}
	
	