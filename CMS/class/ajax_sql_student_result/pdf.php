
<?php  
      $html = '';  
      $conn = mysqli_connect("localhost", "root", "", "my_sms_project");
      $examID = $_POST['exam_id'];
      $classID = $_POST['class_id'];
      // $data = array();
// Sir Matee Query
      // $q1 = mysqli_query($conn, "SELECT GROUP_CONCAT(`marks`.`mark_obt` SEPARATOR ',') AS 'obt_marks', GROUP_CONCAT(`marks`.`total_mark` SEPARATOR ',') AS 'total_marks', CONCAT(`students`.`stu_first_name`, ' ', `students`.`stu_last_name`) AS 'full_name', `marks`.`student_id`, GROUP_CONCAT(`subjects`.`sub_name` SEPARATOR ',') AS 'subjects' FROM `marks` LEFT JOIN `students` ON `students`.`studentid` = `marks`.`student_id` LEFT JOIN `subjects` ON `subjects`.`subjectid` = `marks`.`subject_id` WHERE `marks`.`class_id` = '$classID' AND `marks`.`exam_id` = '$examID'  GROUP BY `marks`.`student_id` ORDER BY full_name ASC");
      // while($res = mysqli_fetch_assoc($q1))
      // {
      //     $data[] = $res; 
      // }
      // echo json_encode($data);
      
    $query = mysqli_query($conn,"
      SELECT B.stu_first_name,B.stu_last_name,B.stu_reg_no,
      C.class_name,
      D.sub_name,T.firstname,T.lastname,
      A.mark_obt,A.total_mark,A.comment,A.student_id,
      E.exam_name 
      FROM marks as A 
      inner join students as B on A.student_id=B.studentid 
      inner join class as C on A.class_id=C.classid 
      inner join subjects as D on A.subject_id=D.subjectid 
      inner join teacher as T on D.sub_tec_id=T.teacherid 
      inner join exams as E on A.exam_id=E.examid 
      WHERE A.exam_id='$_POST[exam_id]' AND A.class_id='$_POST[class_id]' GROUP BY A.student_id 
      "); 
    while ($row1=mysqli_fetch_array($query)) {
     $STUDENT_ID = $row1['student_id'];
     $class_name = $row1['class_name'];
     $STUDENT_name = $row1['stu_first_name']." ".$row1['stu_last_name'];
     $exam_name = $row1['exam_name'];
     $student_roll = $row1['stu_reg_no'];
     $html .= '<br>';
     $html .= '
     <table class="table table-bordered  table-striped"  style="width: 650px;margin-left: 20px;">
     <tr>
     <th><h1>Allama Iqbal Science College Gojra</h1></th>
     <th><h1>Result Card</h1></th>
     <th><h1>Mid Term</h1></th>
     </tr>
     <tr>
     <th>Name</th>
     <th>Class</th>
     <th>Roll </th>
     </tr>
     <tr>
     <td> '.$STUDENT_name.'</td>
     <td> '.$class_name.'</td>
     <td> '.$student_roll.'</td>
     </tr>
     </table>
    
     ';
    
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
      WHERE A.exam_id='$_POST[exam_id]' AND A.class_id='$_POST[class_id]' AND A.student_id = '$STUDENT_ID'";  
      $result = mysqli_query($conn, $sql);
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
 <div style=""></div> 
          