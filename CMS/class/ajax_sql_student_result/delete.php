<?php  
  include '../config/db.php';  
 

if(isset($_POST['sub_id']))
{
	$query = mysqli_query($connect,"DELETE FROM `marks` WHERE subject_id = '$_POST[sub_id]'");
	if($query)
	{
		echo 'Subject data Deleted';
	}
} 
 ?>