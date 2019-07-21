<?php	
	
	require_once '../components/connection.php';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$reg_id = $_POST['special_region'];
		
		$sql ="SELECT ter_id, ter_pid, ter_name FROM t_koatuu_tree WHERE reg_id = '$reg_id' AND ter_mask = 5";
		$query = mysqli_query($connection,$sql);

		echo "<option value='none'></option>";
		
		while($row = mysqli_fetch_array($query))
		{
			echo "<option value='" . $row['ter_id'] . "'>" . $row['ter_name'] . "</option>";
		}
	}
	
	