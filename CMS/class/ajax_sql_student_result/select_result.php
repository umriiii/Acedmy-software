<?php 
error_reporting(0);
 include '../config/db.php';
if(isset($_POST['employee_id'])){
  $student_id=$_POST['employee_id'];
  $exam_id=$_POST['exam_id'];
  $class_id=$_POST['class_id'];
 $sql=mysqli_query(
            $connect,
            "SELECT B.stu_first_name,B.stu_last_name,B.stu_reg_no,C.class_name,D.sub_name,T.firstname,
            T.lastname,A.mark_obt,A.total_mark,A.comment,E.exam_name FROM marks as A 
            inner join students as B on A.student_id=B.studentid 
            inner join class as C on A.class_id=C.classid
            inner join subjects as D on A.subject_id=D.subjectid 
            inner join teacher as T on D.sub_tec_id=T.teacherid 
            inner join exams as E on A.exam_id=E.examid 
            WHERE A.student_id = '$student_id' AND A.exam_id='$exam_id' AND A.class_id='$class_id'"
);
 ?>
<div class="container">
  <div class="row">
    <div class="col-sm-3">
    <?php 
    
$row1=mysqli_fetch_array($sql);
 $STUDENT_ID = $row1['student_id'];
     $class_name = $row1['class_name'];
     $STUDENT_name = $row1['stu_first_name'];
     $Father_name = $row1['stu_last_name'];
     $student_roll = $row1['stu_reg_no'];
     $exam_name = $row1['exam_name'];
     $html .= '<br>';
     $html .= '
     <table class="table table-bordered  table-striped"  style="width: 650px;margin-left: 20px;">
     <tr>
     <th><h1>Allama Iqbal Science College Gojra</h1></th>
     <th><h1>Result Card</h1></th>
     <th colspan="3"><h1>'.$exam_name.'</h1></th>
     </tr>
     <tr>
     <th>Student Name</th>
     <th>Father Name</th>
     <th>Class</th>
     <th>Roll </th>
     </tr>
     <tr>
     <td> '.$STUDENT_name.'</td>
     <td> '.$Father_name.'</td>
     <td> '.$class_name.'</td>
     <td> '.$student_roll.'</td>
     </tr>
     </table>
    
     ';
       ?>

    
<?php 

 $query=mysqli_query($connect,"SELECT B.stu_first_name,B.stu_last_name,B.stu_reg_no,C.class_name,D.sub_name,T.firstname,T.lastname,A.mark_obt,A.total_mark,A.comment FROM marks as A inner join students as B on A.student_id=B.studentid inner join class as C on A.class_id=C.classid inner join subjects as D on A.subject_id=D.subjectid inner join teacher as T on D.sub_tec_id=T.teacherid inner join exams as E on A.exam_id=E.examid WHERE A.student_id = '$student_id' AND A.exam_id='$exam_id' AND A.class_id='$class_id'");
 $total = '';     
 $T_S_M = '';
 
       $html .= '
     
      <table class="table table-bordered  table-striped"  style="page-break-after:always;float:none;width: 650px;margin-left: 20px;">  
           <tr>  
                <th width="15%">Subjects</th>  
                <th width="30%">Out of</th>  
                <th width="15%">obt marks</th>  
                <th width="20%">Percentage</th>  
                <th width="20%">subject teacher</th>    
           </tr> ';  
      while($row = mysqli_fetch_assoc($query))  
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
           $html .= ' 
      <tr>        
                         
                          <th><b>'.$row['sub_name'].'</b></th>  
                          <td>'.$row['total_mark'].'</td>  
                          <td>'.$row['mark_obt'].'</td>  
                          <td>'.$Percentage_Per_Sub.'</td>    
                          <td>'.$row['firstname']." ".$row['lastname'].'</td>  

                  </tr> 
                  
                          ';  
      }

       $html .= '<tr> <th width="100%">Total Marks<th width="100%">'.$T_S_M.'</th><th>'.$total.'</th><th>'.$Percentage_Total_Sub.'</th><th></th></tr>';
      $html .= ' </table> ';

    }

     echo $html;  
        


 ?>  