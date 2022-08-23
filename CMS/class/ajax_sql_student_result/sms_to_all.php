<?php 
// this is for sms api to set time limit 0 by default time limit is 30 after 30 loop terminate it self
set_time_limit(0);
 include '../config/db.php';
 $output = '';
 $sms = '';
$exam_id = $_POST['exam_id'];
$class_id = $_POST['class_id'];
$query = mysqli_query($connect,
  "SELECT distinct A.student_id,
  B.phone,B.stu_first_name,
  C.exam_name FROM marks as A 
  inner join students as B on A.student_id = B.studentid 
  inner join exams as C on A.exam_id = C.examid  
  WHERE A.exam_id='$_POST[exam_id]' 
  AND A.class_id='$_POST[class_id]'
  ");
while ($row1 = mysqli_fetch_array($query)) {
  $stu_ph_no = $row1['phone'];
$Student_ID = $row1['student_id'];
 
$total = 0;

$output .='<h4>'.$row1['student_id'].'</h4>';
 $sql = "SELECT B.stu_first_name,B.stu_last_name,B.stu_reg_no,B.phone,
      C.class_name,
      D.sub_name,T.firstname,T.lastname,
      A.mark_obt,A.total_mark,A.comment 
      FROM marks as A 
      inner join students as B on A.student_id=B.studentid 
      inner join class as C on A.class_id=C.classid 
      inner join subjects as D on A.subject_id=D.subjectid 
      inner join teacher as T on D.sub_tec_id=T.teacherid 
      inner join exams as E on A.exam_id=E.examid 
      WHERE A.exam_id='$_POST[exam_id]' AND A.class_id='$_POST[class_id]' AND A.student_id = '$Student_ID'";  
      $result = mysqli_query($connect, $sql);
       
            $rows = array();
      while($row = mysqli_fetch_assoc($result))  
      {  
               array_push($rows, $row);
               $student_obt_marks = array($row['mark_obt']);
               $values=array_sum($student_obt_marks);
               $total +=$values;      
                              
      }
 // show is an array variable to combine two arrays
     $show = array();
    
      foreach($rows as $row){
 
                  $sub = array($row['sub_name']);
                  $mark = array($row['mark_obt']);
                   $tot_mark = array($row['total_mark']); 
                  $show[] =  array_merge($sub,$mark,$tot_mark);  
       }
//$replacemwnrs = array('['=>'', ']'=>'', 'abc'=>'xyz', '"', '');
$str = json_encode($show, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
$sms .= str_replace('{', '', $str);
$sms = str_replace('}', '', $sms);
$sms = str_replace('[', '', $sms);
$sms = str_replace(']', '', $sms);
$sms = str_replace('"', '', $sms);
$sms = str_replace(',', '', $sms);
$sms = str_replace(' ', '', $sms);
// $sms = preg_replace('/\s+/',',',str_replace(array("\r\n","\r","\n"),' ',trim($sms)));
// $sms .= preg_replace('/[{},]+/', '', $str);

$sms .= "Total=". $total;
$sms .= $row1['stu_first_name']."'s ".$row1['exam_name'];
echo $sms;
$Status_SMS = 'Delivered';
$Sms_Status = mysqli_query($connect,"UPDATE marks   
           SET msg_status='$Status_SMS'  
           WHERE student_id = '$Student_ID'");  
 include '../config/sms_api.php';
$sms = "";
    }      
// echo $output;  
 ?>
 