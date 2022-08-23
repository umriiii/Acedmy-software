<?php  
//select.php  
if(isset($_POST["employee_id"]))
{
 $output = '';
 include '../config/db.php';
 $query = "SELECT * FROM guest_student WHERE id = '".$_POST["employee_id"]."'";
 $result = mysqli_query($connect, $query);
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '
     <tr>  
            <td width="30%"><label>student name</label></td>
            <td width="70%">' . $row["student_name"] . '</td> 
    </tr>
<tr>                                                                            

            <td width="30%"><label>Father name</label></td>
            <td width="70%">' . $row["father_name"] . '</td>
    </tr>
<tr>
 
            <td width="30%"><label>Father Business</label></td>
            <td width="70%">' . $row["father_business"] . '</td> 
    </tr>
<tr>

            <td width="30%"><label>Prevoius institute</label></td>
            <td width="70%">' . $row["previous_institute"] . '</td> 
    </tr>
<tr>

            <td width="30%"><label>class</label></td>
            <td width="70%">' . $row["class"] . '</td> 
    </tr>
<tr>

            <td width="30%"><label>Contact Number</label></td>
            <td width="70%">' . $row["contact_number"] . '</td> 
    </tr>
<tr>

            <td width="30%"><label>Address</label></td>
            <td width="70%">' . $row["address"] . '</td>
    </tr>
<tr>

            <td width="30%"><label>Source Info</label></td>
            <td width="70%">' . $row["source_info"] . '</td>  
              
    </tr>
    <tr>

            <td width="30%"><label>Stauts</label></td>
            <td width="70%">' . $row["Add_status"] . '</td>  
              
    </tr>
     ';
    }
    $output .= '</table></div>';
    echo $output;
}

?>
