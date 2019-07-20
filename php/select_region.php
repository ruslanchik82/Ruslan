<?php	

	require_once 'connection.php';
		
	$sql ="SELECT ter_address, reg_id FROM t_koatuu_tree WHERE reg_id IN (SELECT DISTINCT reg_id FROM t_koatuu_tree) GROUP BY reg_id HAVING COUNT(reg_id) > 1";
	$query = mysqli_query($connection,$sql);

	echo "<option value='none'></option>";
	
	while($row = mysqli_fetch_array($query))
	{
		echo "<option value='" . $row['reg_id'] . "'>" . $row['ter_address'] . "</option>";
	}
