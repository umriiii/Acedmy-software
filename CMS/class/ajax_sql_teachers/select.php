<?php  
//select.php  
if(isset($_POST["employee_id"]))
{
 $output = '';
  include '../config/db.php';
 $query = "SELECT * FROM teacher WHERE teacherid = '".$_POST["employee_id"]."'";
 $result = mysqli_query($connect, $query);
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '
     <tr>  
            <td width="30%"><label>Teacher name</label></td>
            <td width="70%">' . $row["firstname"] . " " . $row["lastname"]. '</td> 
    </tr>
<tr>

            <td width="30%"><label>Birthday</label></td>
            <td width="70%">' . $row["birthday"] . '</td>
    </tr>
<tr>
 
            <td width="30%"><label>Gender</label></td>
            <td width="70%">' . $row["sex"] . '</td> 
    </tr>
<tr>

            <td width="30%"><label>Religion</label></td>
            <td width="70%">' . $row["religion"] . '</td> 
    </tr>
<tr>

            <td width="30%"><label>Blood Group</label></td>
            <td width="70%">' . $row["blood_group"] . '</td> 
    </tr>
<tr>

            <td width="30%"><label>Address</label></td>
            <td width="70%">' . $row["address"] . '</td> 
    </tr>
<tr>

            <td width="30%"><label>Phone number</label></td>
            <td width="70%">' . $row["phone"] . '</td>
    </tr>
<tr>

            <td width="30%"><label>Email</label></td>
            <td width="70%">' . $row["email"] . '</td>  
              
    </tr>
     ';
    }
    $output .= '</table></div>';
    echo $output;
}

?>
