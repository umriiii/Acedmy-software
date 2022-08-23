<?php  
//select.php  
if(isset($_POST["employee_id"]))
{
 $output = '';
  include '../config/db.php';
 $query = "SELECT * FROM exams WHERE examid = '".$_POST["employee_id"]."'";
 $result = mysqli_query($connect, $query);
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '

<tr>

            <td width="30%"><label>Exam name</label></td>
            <td width="70%">' . $row["exam_name"] . '</td> 
    </tr>
     <tr>  
            <td width="30%"><label>Teacher name</label></td>
            <td width="70%">' . $row["exam_date"] .'</td> 
    </tr>
     <tr>  
            <td width="30%"><label>Comments</label></td>
            <td width="70%">' . $row["exam_comment"] .'</td> 
    </tr>


     ';
    }
    $output .= '</table></div>';
    echo $output;
}

?>
