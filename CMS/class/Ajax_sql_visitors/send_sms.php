<?php 
include '../config/db.php';
if (isset($_POST['employee_id'])) {
$ID = $_POST['employee_id'];
$sql = mysqli_query($connect,"SELECT * FROM guest_student WHERE id = '$ID'");
$row=mysqli_fetch_array($sql);
$stu_ph_no = $row['contact_number'];
$query = mysqli_query($connect,"SELECT * FROM settings");
$sms_row = mysqli_fetch_array($query);
$sms = $sms_row['visitor_sms'];
include '../config/sms_api.php';
}
 ?>