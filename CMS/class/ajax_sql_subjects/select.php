<?php  
//select.php  
if(isset($_POST["employee_id"]))
{
 $output = '';
 include '../config/db.php';
 $query = "SELECT A.sub_name,B.firstname,B.lastname,C.class_name,A.subjectid FROM subjects as A inner join teacher as B on A.sub_tec_id=B.teacherid inner join class as C on A.class_id=C.classid WHERE A.subjectid = '".$_POST["employee_id"]."'";
 $result = mysqli_query($connect, $query);
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '

<tr>

            <td width="30%"><label>Subject name name</label></td>
            <td width="70%">' . $row["sub_name"] . '</td> 
    </tr>
     <tr>  
            <td width="30%"><label>Teacher name</label></td>
            <td width="70%">' . $row["firstname"] . " " . $row["lastname"]. '</td> 
    </tr>
    <tr>  
            <td width="30%"><label>Subject class</label></td>
            <td width="70%">' . $row["class_name"] .'</td> 
    </tr>


     ';
    }
    $output .= '</table></div>';
    echo $output;
}

?>
