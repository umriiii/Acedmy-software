<?php 
error_reporting(0); 
 include '../config/db.php';




	$exam_id = $_POST['exam_name'];
	$class_id = $_POST['class_name'];
	$subject_id = $_POST['sub_name'];
	$mark_out = $_POST['mark_out'];




$sql=mysqli_query($connect,"SELECT * FROM exams WHERE examid = '$exam_id'");
while ($row1=mysqli_fetch_array($sql)) {
	$sel_exam_id=$row1['examid'];
}
$mysq=mysqli_query($connect,"SELECT * FROM class WHERE classid = '$class_id'");
while ($row2=mysqli_fetch_array($mysq)) {
    $sel_class_id=$row2['classid'];
}
$ssq=mysqli_query($connect,"SELECT * FROM subjects as A inner join class as B on A.class_id = B.classid WHERE A.subjectid = '$subject_id'");

while ($row3=mysqli_fetch_array($ssq)) {
	$sel_sub_id=$row3['subjectid'];
}
$query=mysqli_query($connect,"SELECT A.studentid FROM students as A inner join class as B on A.class_id=B.classid WHERE A.class_id = '$class_id'");
while ($row=mysqli_fetch_array($query)) {
$cond=mysqli_query($connect,"SELECT * FROM students WHERE class_id = '$class_id'");
$stu_count=mysqli_num_rows($cond);
$condition=mysqli_query($connect,"SELECT * FROM marks WHERE subject_id= '$subject_id' AND exam_id= '$exam_id'");
$sub_count=mysqli_num_rows($condition);
if ($stu_count == $sub_count) {
	
} else {
	$result_status = 'Not send';
	$sel_student_id= $row['studentid'];
 $ins=mysqli_query($connect,"  
           INSERT INTO  marks (student_id, exam_id, class_id, subject_id, total_mark, msg_status)  
     VALUES('$sel_student_id', '$sel_exam_id', '$sel_class_id', '$sel_sub_id', '$mark_out', '$result_status')  
           ");
}

 
}





?>


 
  
 