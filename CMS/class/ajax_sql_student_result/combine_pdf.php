<?php  
      // $html = '';  
     // include '../config/db.php';
     //  $examID = $_POST['exam_id'];
     //  $classID = $_POST['class_id'];

//       $data = array();
// Sir Matee Query
//       $q1 = mysqli_query($conn, "SELECT GROUP_CONCAT(`marks`.`mark_obt` SEPARATOR ',') AS 'obt_marks', GROUP_CONCAT(`marks`.`total_mark` SEPARATOR ',') AS 'total_marks', CONCAT(`students`.`stu_first_name`, ' ', `students`.`stu_last_name`) AS 'full_name', `marks`.`student_id`, GROUP_CONCAT(`subjects`.`sub_name` SEPARATOR ',') AS 'subjects' FROM `marks` LEFT JOIN `students` ON `students`.`studentid` = `marks`.`student_id` LEFT JOIN `subjects` ON `subjects`.`subjectid` = `marks`.`subject_id` WHERE `marks`.`class_id` = '$classID' AND `marks`.`exam_id` = '$examID'  GROUP BY `marks`.`student_id` ORDER BY full_name ASC");
//       while($res = mysqli_fetch_assoc($q1))
//       {
//           $data[] = $res; 
//       }
//       echo json_encode($data);
      
 
        


 ?>  
  
      
<?php  
      $html = '';  
     include '../config/db.php';
      $examID = $_POST['exam_id'];
      $classID = $_POST['class_id'];
$heading = mysqli_query($connect,"SELECT 
      C.class_name,B.exam_name
      FROM marks as A 
      inner join class as C on A.class_id=C.classid 
      inner join exams as B on A.exam_id = B.examid
      WHERE A.exam_id='$_POST[exam_id]' AND A.class_id='$_POST[class_id]' GROUP BY A.subject_id");

 $Page_title = mysqli_fetch_array($heading);

 $Page_class_name = $Page_title['class_name'];
 $page_exam_name = $Page_title['exam_name'];


      $sql = mysqli_query($connect,"SELECT 
      B.sub_name,
      A.mark_obt
      FROM marks as A 
      inner join class as C on A.class_id=C.classid 
      inner join subjects as B on B.subjectid = A.subject_id
      inner join students as D on A.student_id = D.studentid
      WHERE A.exam_id='$_POST[exam_id]' AND A.class_id='$_POST[class_id]' GROUP BY A.subject_id");
     
       $html .= '
     <h2>Class: '.$Page_class_name.'</h2>
     <h2>Term: '.$page_exam_name.'</h2>
      <table class="table table-bordered  table-striped">  
           <tr>  
            <th>#</th>
                <th width="15%">Student name</th>';
      $subj = '';
       while ($row = mysqli_fetch_array($sql)) {
          
                $html .=' 

                  <th>'.$row['sub_name'].'</th>';
         
     } 
     $html .=' 
     <th>Total</th>   
           </tr>'; 
    $query = "
SELECT DISTINCT A.student_id,B.stu_first_name,B.stu_last_name FROM marks as A 
      inner join students as B on A.student_id = B.studentid  WHERE A.exam_id='$_POST[exam_id]' AND A.class_id='$_POST[class_id]' ";  
      $i = 0;
      $result = mysqli_query($connect, $query);
      while ($rr = mysqli_fetch_array($result)) {
         $STUDENT_ID = $rr['student_id'];
      $i++;
 $html .='<tr>
 <td>'.$i.'</td>
<td>'.$rr['stu_first_name'].'</td>
 '; 
        $total = 0;
   $Sel = "SELECT A.mark_obt 
      FROM marks as A 
      inner join students as B on A.student_id = B.studentid 
      WHERE A.exam_id='$_POST[exam_id]' AND A.class_id='$_POST[class_id]' AND A.student_id = '$STUDENT_ID'";
   $res = mysqli_query($connect, $Sel);
   while($values = mysqli_fetch_array($res)){
     $student_obt_marks = array($values['mark_obt']);
               $val=array_sum($student_obt_marks);
               $total +=$val; 
$html .='

<td>'.$values['mark_obt'].'</td>

'; 
   }
$html .='
<td>'.$total.'</td>
</tr>'; 
}

 echo $html; 
 ?>  
  