<?php  
//select.php  
if(isset($_POST["employee_id"]))
{
 $output = '';
  include '../config/db.php';
 $query = "SELECT A.classid,A.class_name,B.firstname,B.lastname FROM class As A inner join teacher As B on A.teacher_id=B.teacherid WHERE classid = '".$_POST["employee_id"]."'";
 $result = mysqli_query($connect, $query);
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '

<tr>

            <td width="30%"><label>Class name</label></td>
            <td width="70%">' . $row["class_name"] . '</td> 
    </tr>
     <tr>  
            <td width="30%"><label>Teacher name</label></td>
            <td width="70%">' . $row["firstname"] . " " . $row["lastname"]. '</td> 
    </tr>


     ';
    }
    $output .= '</table></div>';
    echo $output;
}

?>
