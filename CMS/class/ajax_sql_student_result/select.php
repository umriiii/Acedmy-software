<?php  
 include '../config/db.php';

    
 $output = '';  
 $sql = "SELECT A.markid,B.stu_first_name,B.stu_last_name,B.stu_reg_no,A.mark_obt,A.total_mark,A.comment FROM marks as A inner join students as B on A.student_id=B.studentid WHERE A.exam_id='$_POST[exam_id]' AND A.class_id='$_POST[class_id]' AND A.subject_id='$_POST[sub_id]' ORDER BY B.stu_reg_no ASC";  
 $result = mysqli_query($connect, $sql);  
 $output .= '  

 <input type="button" name="delete result" onclick="del_res();" class="btn btn-danger" value="Delete result" /> 
 <div class="not">
      <div class="table-responsive">  
           <table class="table table-bordered">  
                <tr>  
                     <th width="5%">#</th>  
                     <th width="5%">R.id</th>  
                     <th width="20%">Student Name</th>  
                     <th width="20%">Father Name</th>  
                     <th width="10%">Out of</th>  
                     <th width="10%">obtained Marks</th> 
                    
                </tr>';  
 if(mysqli_num_rows($result) > 0)  
 {  
  $i = 0;
      while($row = mysqli_fetch_array($result))  
      {  
        $i++;
           $output .= '  
                <tr> 
                      <td>'.$i.'</td> 
                     <td>'.$row["stu_reg_no"].'</td>
                     <td>'.$row["stu_first_name"].'</td>  
                     <td>'.$row["stu_last_name"].'</td>  
                      
                     <td class="total_mark" data-id1="'.$row["markid"].'">'.$row["total_mark"].'</td>  
                     <td class="obt_mark" data-id2="'.$row["markid"].'" contenteditable>'.$row["mark_obt"].'</td> 
                       
                     
                </tr>  
           ';  
      }  
     // <td class="comment" data-id3="'.$row["markid"].'" contenteditable>'.$row["comment"].'</td>
 }  
 else  
 {  
      $output .= '<tr>  
                          <td colspan="6" class="text-danger">Data not Found</td>  
                     </tr>';  
 }  
 $output .= '</table>  
      </div>
           </div>
      '; 
       
 echo $output;  

 ?>