<?php 
set_time_limit(0);
include '../config/db.php';
if(isset($_POST['student_id'])){
    $Student = $_POST['student_id'];
$sql = mysqli_query($connect,
"SELECT 
    A.studentid,
    A.stu_first_name,
    A.stu_last_name,
    A.stu_reg_no,
    A.phone,
    C.class_status,
    B.submit_on,
    C.class_name
FROM 
    students as A 
    LEFT JOIN student_fee as B on A.studentid = B.student_id AND MONTH(B.submit_on) = MONTH(NOW()) 
    INNER JOIN class as C ON A.class_id = C.classid 
WHERE C.class_status = 'Monthly' AND A.studentid = '$Student' AND B.student_id IS NULL");
while ($row = mysqli_fetch_array($sql)) {
    $stu_ph_no = $row['phone'];
    $SMS_Query = mysqli_query($connect,"SELECT * FROM settings");
    $SMS_Row = mysqli_fetch_array($SMS_Query);
    $sms = $SMS_Row['defaulter_sms'];
    include '../config/sms_api.php';

}
}
else{
$query = mysqli_query($connect,
"SELECT 
    A.studentid,
    A.stu_first_name,
    A.stu_last_name,
    A.stu_reg_no,
    A.phone,
    C.class_status,
    B.submit_on,
    C.class_name
FROM 
    students as A 
    LEFT JOIN student_fee as B on A.studentid = B.student_id AND MONTH(B.submit_on) = MONTH(NOW()) 
    INNER JOIN class as C ON A.class_id = C.classid 
WHERE C.class_status = 'Monthly' AND B.student_id IS NULL");
while ($value = mysqli_fetch_array($query)) {
    $stu_ph_no = $value['phone'];
      $SMS_Query = mysqli_query($connect,"SELECT * FROM settings");
    $SMS_Row = mysqli_fetch_array($SMS_Query);
    $sms = $SMS_Row['defaulter_sms'];
    include '../config/sms_api.php';
}
}
 ?>
