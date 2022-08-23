<?php 

date_default_timezone_set("Asia/Karachi");
include '../config/db.php';
$create_on = date("Y-m-d");
$sql = mysqli_query($connect,"SELECT A.studentid,B.running_status FROM students As A inner join class AS B on A.class_id = B.classid WHERE B.running_status = 'Active'");
while ($row = mysqli_fetch_array($sql)) {
	$studentId = $row['studentid'];
	$query=mysqli_query($connect,"SELECT student_id,time_to_show FROM attandance WHERE student_id = '$studentId' AND create_on = '$create_on'");
$count = mysqli_num_rows($query);
if ($count > 0) {
	
}
else{
  $att_date = date("Y-m-d H:i:s");
	$ins = mysqli_query($connect,"INSERT INTO attandance (student_id,status,attandance_status,time_to_show,create_on) VALUES ('$studentId','Present','Manual','$att_date','$create_on')");
}
}
 ?>
