<?php  
  include '../config/db.php';  
 

if(isset($_POST['exam_id']))
{
	$query = mysqli_query($connect,"DELETE FROM `marks` WHERE  class_id = '$_POST[class_id]' AND exam_id = '$_POST[exam_id]' AND subject_id = '$_POST[sub_id]'");
	if($query)
	{
		echo '<br><div class="text-success">Subject data Deleted<div>';
	}
} 
 ?>