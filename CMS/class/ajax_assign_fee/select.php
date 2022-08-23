<?php  
//select.php  
if(isset($_POST["employee_id"]))
{
 $output = '';
  include '../config/db.php';
 $single_query = "SELECT * FROM fee_type AS A inner join fee_assign AS B on A.ftid = B.ft_id WHERE feeid = '".$_POST["employee_id"]."'";
 $single_result = mysqli_query($connect, $single_query);
 $single_row = mysqli_fetch_array($single_result);
 $fee_type_id = $single_row['ft_id'];
  $query = "SELECT * FROM fee_type AS A inner join fee_assign AS B on A.ftid = B.ft_id inner join class AS C on B.class_id = C.classid WHERE B.ft_id = '".$fee_type_id."' Group by B.class_id";
 $result = mysqli_query($connect, $query);
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">
<h2>'.$single_row['title'].'</h2>
           ';
            $i = 0;
    while($row = mysqli_fetch_array($result))
    {
       $i++;
     $output .= '

     <tr>  
          
            <td width="30%"><label>'.$i.'</label></td>
            <td width="70%">' . $row["class_name"] . '</td> 
    </tr>


     ';
    }
    $output .= '</table></div>';
    echo $output;
}

?>
