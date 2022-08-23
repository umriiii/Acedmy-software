<?php  
//select.php  
if(isset($_POST["employee_id"]))
{
 $output = '';
  include '../config/db.php';
 $query = "SELECT * FROM yearly_fee WHERE yfeeid = '".$_POST["employee_id"]."'";
 $result = mysqli_query($connect, $query);
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '

<tr>

            <td width="30%"><label>BISE Registration Fee</label></td>
            <td width="70%">' . $row["bise_reg_fee"] . '</td> 
    </tr>
     <tr>  
            <td width="30%"><label>BISE Exam Fee</label></td>
            <td width="70%">' . $row["bise_exam_fee"] .'</td> 
    </tr>
     <tr>  
            <td width="30%"><label>Paper Fund</label></td>
            <td width="70%">' . $row["paper_fund"] .'</td> 
    </tr>
     <tr>  
            <td width="30%"><label>Party Fund</label></td>
            <td width="70%">' . $row["party_fund"] .'</td> 
    </tr>
     <tr>  
            <td width="30%"><label>Miscellaneous</label></td>
            <td width="70%">' . $row["miscellaneous"] .'</td> 
    </tr>
     <tr>  
            <td width="30%"><label>Fine</label></td>
            <td width="70%">' . $row["fine"] .'</td> 
    </tr>
     <tr>  
            <td width="30%"><label>Submit on</label></td>
            <td width="70%">' . $row["submit_on"] .'</td> 
    </tr>



     ';
    }
    $output .= '</table></div>';
    echo $output;
}

?>
