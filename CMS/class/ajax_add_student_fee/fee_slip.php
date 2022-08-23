<?php 
include '../config/db.php';  
if(isset($_POST['employee_id'])){
	$Student_ID = $_POST['employee_id'];
	$sql = mysqli_query($connect,
		"SELECT 
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

	$row = mysqli_fetch_array($sql);
	$Class_fees = $row['class_fee'];
    $Discount = $row['student_discount'];
    $Calculation = $Class_fees * $Discount;
    $Calculated_Discount = $Calculation/100;
    $Calculated_Class_Fee = $Class_fees - $Calculated_Discount;
    $Fee_Submitted = $row['student_fee'];
    $Student_dues = $Calculated_Class_Fee - $Fee_Submitted;

    $stu_first_name = $row['stu_first_name'];
    $stu_last_name = $row['stu_last_name'];
    $stu_reg_no = $row['stu_reg_no'];
    $class_name = $row['class_name'];




 ?>

		<!-- 	
			<div class="col-md-6">
				<b style="font-size: 20px">Payment To </b>
				<br>
                <b>Allama Iqbal Science College Gojra</b>
			</div>
			<div class="col-md-4 offset-md-8">
				<b style="font-size: 20px">Bill To</b>
				<br>

			</div> -->
		
	</div>
	<div class="row">
  <div class="col-md-12">
  	<div class="table-responsive">  
           <table class="table table-bordered">
           	<tr>
           		<th><b style="font-size: 20px">Payment To: </b></th>
           		<td>
  		<b>Allama Iqbal Science College Gojra</b>
  	</td>
           	</tr>
           	<tr>
           		<th><b style="font-size: 20px">Bill To:</b></th>
           		<td>
  		<b><?php echo $stu_first_name." ".$stu_last_name; ?></b>
  		<br>
  		<b><?php echo $class_name; ?></b>
  		<br>
  		<b><?php echo $stu_reg_no; ?></b>
  	</td>
           	</tr>
             	
              
             
  
  				
											
 
</table>
</div>
</div>
</div>
<div class="row">
  <div class="col-md-12">
  	<div class="table-responsive">  
           <table class="table table-bordered">
     
    <tr>
 
            <td width="50%"><label style="font-weight: bold;">Fee Status:</label></td>
            <td width="50%"><?php echo $row["status"]; ?></td> 
    </tr>

    <tr>

            <td width="50%"><label style="font-weight: bold;">Discount Category:</label></td>
            <td width="50%"><?php echo $row["discount_category"]; ?></td> 
    </tr>
  
    <tr>
 
            <td width="50%"><label style="font-weight: bold;">Class Fee:</label></td>
            <td width="50%"><?php echo $row["class_fee"]; ?></td> 
    </tr>
     <tr>
 
            <td width="50%"><label style="font-weight: bold;">Discount:</label></td>
            <td width="50%"><?php echo $row["student_discount"];?>%</td> 
    </tr>
    
   <tr>
 
            <td width="50%"><label style="font-weight: bold;">Student Fee:</label></td>
            <td width="50%"><?php echo $Calculated_Class_Fee; ?></td> 
    </tr>
     <tr>
 
            <td width="50%"><label style="font-weight: bold;">Amount Submitted:</label></td>
            <td width="50%"><?php echo $row["student_fee"]; ?></td> 
    </tr>
    
    <tr>
 
            <td width="50%"><label style="font-weight: bold;">Due Amount:</label></td>
            <td width="50%"><?php echo $Student_dues; ?></td> 
    </tr>
   
    <tr>

            <td width="50%"><label style="font-weight: bold;">Submit on:</label></td>
            <td width="50%"><?php echo $row["submit_on"]; ?></td> 
    </tr>
<tr>

            <td width="50%"><label style="font-weight: bold;">Phone No:</label></td>
            <td width="50%"><?php echo $row["phone"]; ?></td> 
    </tr>



</table>
</div>
  </div>
<?php } ?>