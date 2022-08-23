<?php  
//select.php  
if(isset($_POST["employee_id"]))
{
 $output = '';
include '../config/db.php';
 
 $query = mysqli_query($connect,"SELECT 
    A.stu_first_name,
    A.stu_last_name,
    A.stu_reg_no,
    A.discount_category,
    A.student_fee as student_discount,
    B.class_name,
    B.class_fee,
    A.address,
    A.phone,
    A.create_on,
    C.submit_on,
    C.status,
    C.student_fee 
FROM students 
    as A inner join class as B on 
    A.class_id=B.classid inner join student_fee as C on 
    A.studentid=C.student_id 
WHERE C.feeid='".$_POST["employee_id"]."'");
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    $row = mysqli_fetch_array($query);
 // Code FOr Calculate Student Discount And Dues ETC

    $Class_fees = $row['class_fee'];
    $Discount = $row['student_discount'];
    $Calculated_Class_Fee = $Class_fees - $Discount;
    $Fee_Submitted = $row['student_fee'];
    $Student_dues = $Calculated_Class_Fee - $Fee_Submitted;

     $output .= '
     <tr>  
            <td width="30%"><label>student name</label></td>
            <td width="70%">' . $row["stu_first_name"] . " " . $row["stu_last_name"]. '</td> 
    </tr>
<tr>

            <td width="30%"><label>Class</label></td>
            <td width="70%">' . $row["class_name"] . '</td>
    </tr>
    <tr>
 
            <td width="30%"><label>Roll No</label></td>
            <td width="70%">' . $row["stu_reg_no"] . '</td> 
    </tr>
    <tr>
 
            <td width="30%"><label>Fee Status</label></td>
            <td width="70%">' . $row["status"] . '</td> 
    </tr>

    <tr>
 
            <td width="30%"><label>Discount Category</label></td>
            <td width="70%">' . $row["discount_category"] . '</td> 
    </tr>
    <tr>
 
            <td width="30%"><label>Class Fee</label></td>
            <td width="70%">' . $row["class_fee"] . '</td> 
    </tr>
     <tr>
 
            <td width="30%"><label>Discount</label></td>
            <td width="70%">' . $row["student_discount"] . '</td> 
    </tr>
    
   <tr>
 
            <td width="30%"><label>Student Fee</label></td>
            <td width="70%">' . $Calculated_Class_Fee . '</td> 
    </tr>
    
    <tr>
 
            <td width="30%"><label>Amount Submitted</label></td>
            <td width="70%">' . $row["student_fee"] . '</td> 
    </tr>
    <tr>
 
            <td width="30%"><label>Due Amount</label></td>
            <td width="70%">' . $Student_dues . '</td> 
    </tr>
    <tr>

            <td width="30%"><label>Submit on</label></td>
            <td width="70%">' . $row["submit_on"] . '</td> 
    </tr>
<tr>

            <td width="30%"><label>Phone No</label></td>
            <td width="70%">' . $row["phone"] . '</td> 
    </tr>

<tr>

            <td width="30%"><label>Address</label></td>
            <td width="70%">' . $row["address"] . '</td> 
    </tr>
<tr>

            <td width="30%"><label>Admission Date</label></td>
            <td width="70%">' . $row["create_on"] . '</td>
    </tr>

     ';
    
    $output .= '</table></div>';
    echo $output;
}

?>
