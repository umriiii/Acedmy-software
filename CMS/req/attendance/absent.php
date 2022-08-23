<?php 
include('../../classes/pdo.php');
if(isset($_POST["user_id"]))
{
	$id = $_POST['user_id'];
	 $statement = $pcon->prepare(
   "UPDATE raw_data
   SET att_status = 1, att_msg_status = 1  
   WHERE id = '$id'
   "
  );
  $result = $statement->execute();

$query = "SELECT * FROM students AS A inner join raw_data AS B ON A.studentid = B.enrollmentNo WHERE B.id = '$id'";
$statement = $pcon->prepare($query);
$statement->execute();
$result = $statement->fetch();

$stu_ph_no = $result['phone'];


$que = "SELECT * FROM settings";
$stat = $pcon->prepare($que);
$stat->execute();
$res = $stat->fetch();


  $sms = $res['absent_sms'];





include '../../class/config/sms_api.php';






	}
 ?>