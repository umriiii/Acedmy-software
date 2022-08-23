<?php   
require_once("../FPDF-master/fpdf.php");
include '../classes/db.php';
      $examID = $_GET['exam_id'];
      $classID = $_GET['class_id'];
      $testing = mysqli_query($conn,"SELECT * FROM class WHERE classid = '$classID'");
      $test_row = mysqli_fetch_array($testing);
      $test_class = $test_row['class_status'];
      if($test_class == 'Monthly'){
         $mypdf = new FPDF();
$heading = mysqli_query($conn,"SELECT 
      C.class_name,B.exam_name,B.exam_date
      FROM marks as A 
      inner join class as C on A.class_id=C.classid 
      inner join exams as B on A.exam_id = B.examid
      WHERE A.exam_id='$_GET[exam_id]' AND A.class_id='$_GET[class_id]' GROUP BY A.subject_id ");

 $Page_title = mysqli_fetch_array($heading);

 $Page_class_name = $Page_title['class_name'];
 $page_exam_name = $Page_title['exam_name'];
 $exam_date = $Page_title['exam_date'];

      $sql = mysqli_query($conn,"SELECT 
      B.sub_name,
      A.mark_obt,
      A.total_mark
      FROM marks as A 
      inner join class as C on A.class_id=C.classid 
      inner join subjects as B on B.subjectid = A.subject_id
      inner join students as D on A.student_id = D.studentid
      inner join exams as E on A.exam_id = E.examid
      WHERE A.exam_id='$_GET[exam_id]' AND A.class_id='$_GET[class_id]' GROUP BY A.subject_id order by A.subject_id DESC");
     $mypdf -> AddPage("L");

$mypdf -> SetFont("Arial", "B",14);
  
 $mypdf -> Cell(279,5, "Muslim College Gojra", 1,1, "C");
 $mypdf -> SetFont("Arial", "B",12);
  $mypdf -> Cell(94,5, $Page_class_name, 1,0, "C");
  $mypdf -> Cell(94,5, $page_exam_name, 1,0, "C");
  $mypdf -> Cell(91,5, $exam_date, 1,1, "C");
$mypdf -> SetFont("Arial", "",9);
  $mypdf -> Cell(18,4, "ID", 1,0, "C");
  $mypdf -> Cell(44,4, "Student Name", 1,0, "C");
       
      $subj = '';
      $sub_total = 0;
       while ($row = mysqli_fetch_array($sql)) {
         $student_total_marks = array($row['total_mark']);
               $sub_values=array_sum($student_total_marks);
               $sub_total +=$sub_values;
        
   $mypdf -> Cell(24,4, $row['sub_name']."/ ".$row['total_mark'], 1,0, "L"); 
         
     } 
   $mypdf -> Cell(25,4, "Total (".$sub_total. ") / %", 1,1, "C"); 
   
    $query = "
SELECT DISTINCT A.student_id,B.stu_first_name,B.stu_last_name,B.stu_reg_no FROM marks as A 
      inner join students as B on A.student_id = B.studentid  WHERE A.exam_id='$_GET[exam_id]' AND A.class_id='$_GET[class_id]'  order by B.stu_reg_no ASC";  
      $i = 0;
      $result = mysqli_query($conn, $query);
      while ($rr = mysqli_fetch_array($result)) {
        
         $STUDENT_ID = $rr['student_id'];
         $stu_reg_no = $rr['stu_reg_no'];
      $i++;

  $mypdf -> Cell(18,4, $stu_reg_no, 1,0, "L");
  $mypdf -> Cell(44,4, $rr['stu_first_name'], 1,0, "L");

        $total = 0;
        $sub_total = 0;
  $Sel = "SELECT A.mark_obt,A.total_mark 
      FROM marks as A 
      inner join students as B on A.student_id = B.studentid 
      inner join subjects as C on A.subject_id = C.subjectid
      WHERE A.exam_id='$_GET[exam_id]' AND A.class_id='$_GET[class_id]' AND A.student_id = '$STUDENT_ID'  order by A.subject_id DESC";
   $res = mysqli_query($conn, $Sel);
   while($values = mysqli_fetch_array($res)){
     $student_obt_marks = array($values['mark_obt']);
               $val=array_sum($student_obt_marks);
               $total +=$val; 
               $student_total_marks = array($values['total_mark']);
               $sub_values=array_sum($student_total_marks);
               $sub_total +=$sub_values;

  $mypdf -> Cell(24,4, $values['mark_obt'], 1,0, "C");  
   }
   $per_calculation = $total/$sub_total;
   $per = $per_calculation * 100;
   $percentage = intval($per);
 $mypdf -> Cell(25,4, $total." / ".$percentage."%".'' , 1,0, "C"); 

 $mypdf -> Ln(); 
}

$mypdf -> Output();
}else{
   $mypdf = new FPDF();
$heading = mysqli_query($conn,"SELECT 
      C.class_name,B.exam_name,B.exam_date
      FROM marks as A 
      inner join class as C on A.class_id=C.classid 
      inner join exams as B on A.exam_id = B.examid
      WHERE A.exam_id='$_GET[exam_id]' AND A.class_id='$_GET[class_id]' GROUP BY A.subject_id ");

 $Page_title = mysqli_fetch_array($heading);

 $Page_class_name = $Page_title['class_name'];
 $page_exam_name = $Page_title['exam_name'];
 $exam_date = $Page_title['exam_date'];

      $sql = mysqli_query($conn,"SELECT 
      B.sub_name,
      A.mark_obt,
      A.total_mark
      FROM marks as A 
      inner join class as C on A.class_id=C.classid 
      inner join subjects as B on B.subjectid = A.subject_id
      inner join students as D on A.student_id = D.studentid
      inner join exams as E on A.exam_id = E.examid
      WHERE A.exam_id='$_GET[exam_id]' AND A.class_id='$_GET[class_id]' GROUP BY A.subject_id order by A.subject_id DESC");
     $mypdf -> AddPage("L");

$mypdf -> SetFont("Arial", "B",14);
  
 $mypdf -> Cell(279,5, "Allama Iqbal Science College Gojra", 1,1, "C");
 $mypdf -> SetFont("Arial", "B",12);
  $mypdf -> Cell(94,5, $Page_class_name, 1,0, "C");
  $mypdf -> Cell(94,5, $page_exam_name, 1,0, "C");
  $mypdf -> Cell(91,5, $exam_date, 1,1, "C");
$mypdf -> SetFont("Arial", "",9);
  $mypdf -> Cell(22,4, "ID", 1,0, "C");
  $mypdf -> Cell(50,4, "Student Name", 1,0, "C");
       
      $subj = '';
      $sub_total = 0;
       while ($row = mysqli_fetch_array($sql)) {
         $student_total_marks = array($row['total_mark']);
               $sub_values=array_sum($student_total_marks);
               $sub_total +=$sub_values;
        
   $mypdf -> Cell(28,4, $row['sub_name']."/ ".$row['total_mark'], 1,0, "C"); 
         
     } 
   $mypdf -> Cell(39,4, "Total (".$sub_total. ") / %", 1,1, "C"); 
   
    $query = "
SELECT DISTINCT A.student_id,B.stu_first_name,B.stu_last_name,B.stu_reg_no FROM marks as A 
      inner join students as B on A.student_id = B.studentid  WHERE A.exam_id='$_GET[exam_id]' AND A.class_id='$_GET[class_id]'  order by B.stu_reg_no ASC";  
      $i = 0;
      $result = mysqli_query($conn, $query);
      while ($rr = mysqli_fetch_array($result)) {
        
         $STUDENT_ID = $rr['student_id'];
         $stu_reg_no = $rr['stu_reg_no'];
      $i++;

  $mypdf -> Cell(22,4, $stu_reg_no, 1,0, "L");
  $mypdf -> Cell(50,4, $rr['stu_first_name'], 1,0, "L");

        $total = 0;
        $sub_total = 0;
 $Sel = "SELECT A.mark_obt,A.total_mark 
      FROM marks as A 
      inner join students as B on A.student_id = B.studentid 
      inner join subjects as C on A.subject_id = C.subjectid
      WHERE A.exam_id='$_GET[exam_id]' AND A.class_id='$_GET[class_id]' AND A.student_id = '$STUDENT_ID'  order by A.subject_id DESC";
   $res = mysqli_query($conn, $Sel);
   while($values = mysqli_fetch_array($res)){
     $student_obt_marks = array($values['mark_obt']);
               $val=array_sum($student_obt_marks);
               $total +=$val; 
               $student_total_marks = array($values['total_mark']);
               $sub_values=array_sum($student_total_marks);
               $sub_total +=$sub_values;

  $mypdf -> Cell(28,4, $values['mark_obt'], 1,0, "C");  
   }
   $per_calculation = $total/$sub_total;
   $per = $per_calculation * 100;
   $percentage = intval($per);
 $mypdf -> Cell(39,4, $total." / ".$percentage."%".'' , 1,0, "C"); 

 $mypdf -> Ln(); 
}

$mypdf -> Output();
}

      
 ?>  
  