<?php
include('../../classes/pdo.php');
if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
 {
$stuID = $_POST["stu_att_id"];

$entryD = date('Y-m-d');
  $query = "
  SELECT * FROM raw_data WHERE enrollmentNo =  '$stuID' AND entryDate = '$entryD'
  ";
  $statement = $pcon->prepare($query);
  $statement->execute();
  $count_row = $statement->rowCount();

if($count_row > 0){
echo 'Student Attendance Already Marked';
}else{

  $statement = $pcon->prepare("
   INSERT INTO raw_data (machineNo, enrollmentNo, entryDate, entryTime, entryDateTime, createdDateTime, att_status, att_msg_status) 
   VALUES (:machineNo, :enrollmentNo, :entryDate, :entryTime, :entryDateTime, :createdDateTime, :att_status, :att_msg_status)
  ");
  $result = $statement->execute(
   array(
    ':machineNo' => 00,
    ':enrollmentNo' => $stuID,
    ':entryDate' => date('Y-m-d'),
    ':entryTime' => date('h:m:s'),
    ':entryDateTime' => date('Y-m-d h:i:s'),
    ':createdDateTime' => date('Y-m-d h:i:s'),
    ':att_status' => $_POST['att_status'],
    ':att_msg_status' => 1,
   )
  );
  if(!empty($result))
  {
   echo 'Data Inserted';

$query = "SELECT * FROM students WHERE studentid = '$stuID'";
$statement = $pcon->prepare($query);
$statement->execute();
$result = $statement->fetch();

$stu_ph_no = $result['phone'];


$que = "SELECT * FROM settings";
$stat = $pcon->prepare($que);
$stat->execute();
$res = $stat->fetch();

if ($_POST['att_status'] == 0) {
  $sms = $res['normal_sms'];
 }else if($_POST['att_status'] == 1){
   $sms = $res['absent_sms'];
 }else if($_POST['att_status'] == 2){
   $sms = $res['late_sms'];
 }else if($_POST['att_status'] == 3){
   $sms = $res['leave_sms'];
 }else if($_POST['att_status'] == 4){
   $sms = $res['early_sms'];
 }else if($_POST['att_status'] == 5){
   $sms = $res['late_n_early_sms'];
 }else{
  
 }




include '../../class/config/sms_api.php';


  }
 


}


}
 }



?>