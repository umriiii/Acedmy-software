<?php
require_once("../FPDF-master/fpdf.php");
include '../classes/db.php'; 
 $examID = $_GET['exam_id'];
 $classID = $_GET['class_id'];
  $mypdf = new FPDF();
  $query = mysqli_query($conn,"
      SELECT B.stu_first_name,B.stu_last_name,B.stu_reg_no,
      C.class_name,
      D.sub_name,T.firstname,T.lastname,
      A.mark_obt,A.total_mark,A.comment,A.student_id,E.exam_name 
      FROM marks as A 
      inner join students as B on A.student_id=B.studentid 
      inner join class as C on A.class_id=C.classid 
      inner join subjects as D on A.subject_id=D.subjectid 
      inner join teacher as T on D.sub_tec_id=T.teacherid 
      inner join exams as E on A.exam_id=E.examid 
      WHERE A.exam_id='$_GET[exam_id]' AND A.class_id='$_GET[class_id]' GROUP BY A.student_id 
      "); 
    while ($row1=mysqli_fetch_array($query)) {
     $STUDENT_ID = $row1['student_id'];
     $class_name = $row1['class_name'];
     $STUDENT_name = $row1['stu_first_name'];
     $Father_name= $row1['stu_last_name'];
      $exam_name = $row1['exam_name'];
     $student_roll = $row1['stu_reg_no'];
   
$mypdf -> AddPage();
$mypdf -> Image('../img/logo.jpg', 10, 10,40,30);
$mypdf -> SetFont("Arial", "B",18);
  
 $mypdf -> Cell(190,20, "Muslim College Gojra", 0,1, "C");
 $mypdf -> SetFont("Arial", "B",16);
 $mypdf -> Cell(190,15,"Result Card of ".$exam_name,0,1,"C");
$mypdf -> SetFont("Arial", "B",14);
  $mypdf -> Cell(75,10,"Student Name",1,0,"C");
  $mypdf -> Cell(110,10,$STUDENT_name,1,1,"C");
    $mypdf -> Cell(75,10,"Father Name",1,0,"C");
  $mypdf -> Cell(110,10,$Father_name,1,1,"C");
    $mypdf -> Cell(75,10,"Class",1,0,"C");
  $mypdf -> Cell(110,10,$class_name,1,1,"C");
    $mypdf -> Cell(75,10,"Roll No",1,0,"C");
  $mypdf -> Cell(110,10,$student_roll,1,1,"C");



 
    
      $sql = "
      SELECT B.stu_first_name,
      B.stu_last_name,
      B.stu_reg_no,
      C.class_name,
      D.sub_name,
      T.firstname,
      T.lastname,
      A.mark_obt,
      A.total_mark,
      A.comment 
      FROM marks as A 
      inner join students as B on A.student_id=B.studentid 
      inner join class as C on A.class_id=C.classid 
      inner join subjects as D on A.subject_id=D.subjectid 
      inner join teacher as T on D.sub_tec_id=T.teacherid 
      inner join exams as E on A.exam_id=E.examid 
      WHERE A.exam_id='$_GET[exam_id]' AND A.class_id='$_GET[class_id]' AND A.student_id = '$STUDENT_ID'";  
      $result = mysqli_query($conn, $sql);
 $total = 0;     
 $T_S_M = 0;
 $mypdf -> SetFont("Arial", "B",14);
 $mypdf -> Cell(30,7, "", 0,1, "C"); 
 $mypdf -> Cell(50,15, "Subjects", 1,0, "C");
 $mypdf -> Cell(45,15, "Out of", 1,0, "C");
 $mypdf -> Cell(45,15, "Obt marks", 1,0, "C");
 $mypdf -> Cell(45,15, "Percentage", 1,1, "C");
       
      while($row = mysqli_fetch_assoc($result))  
      { 
        $Percentage_Per_Sub_Cal = ($row['mark_obt']/$row['total_mark']) * 100;
        $Percentage_Per_Sub = intval($Percentage_Per_Sub_Cal); 
$Total_Sub_Marks = array($row['total_mark']);
$Total_Sub_Number = array_sum($Total_Sub_Marks);
$T_S_M += $Total_Sub_Number; 
$student_obt_marks = array($row['mark_obt']);
$values=array_sum($student_obt_marks);
$total +=$values;
$Percentage_Total_Sub_Cal = ($total/$T_S_M) * 100;
        $Percentage_Total_Sub = intval($Percentage_Total_Sub_Cal);  
         $mypdf -> SetFont("Arial", "I",12); 
  $mypdf -> Cell(50,10, $row['sub_name'], 1,0, "C");
  $mypdf -> Cell(45,10, $row['total_mark'], 1,0, "C");
  $mypdf -> Cell(45,10, $row['mark_obt'], 1,0, "C");
  $mypdf -> Cell(45,10, $Percentage_Per_Sub, 1,1, "C");

           
      }
         $mypdf -> SetFont("Arial", "B",14);
  $mypdf -> Cell(50,15, "Total", 1,0, "C");    
  $mypdf -> Cell(45,15, $T_S_M, 1,0, "C");
  $mypdf -> Cell(45,15, $total, 1,0, "C");
  $mypdf -> Cell(45,15, $Percentage_Total_Sub, 1,1, "C");
       $mypdf -> Cell(80,70, "Signature of Parents:_______________", 0,0, "C");
        $mypdf -> Cell(130,70, "Signature of Principal:_______________", 0,0, "C");
    }

ob_end_clean();
   $mypdf -> Output();
 ?>