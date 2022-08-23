<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Students Vouchers</title>
    
     <style type="text/css" media="print">

    @media print
{  

@page {
  size: A4 landscape;
}
  
.pagebreak {
        page-break-before: always;
    }
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>
  </head>
  <body>
   <?php 
include('../classes/pdo.php');

if(isset($_GET['class_id'])){

  $class_id = $_GET['class_id'];

 $statement = $pcon->prepare(
  "SELECT * FROM fee_assign AS A inner join fee_type AS B ON A.ft_id = B.ftid inner join students AS C ON A.stu_id = C.studentid inner join class AS D ON C.class_id = D.classid 
  WHERE A.class_id = '$class_id' Group by C.studentid");
 $statement->execute();
 $result = $statement->fetchAll();
 $i=0;
 foreach($result as $row)
 {
  $i++;
  $net_fine = 0;
  $stuidforfee = $row['studentid'];
 ?>
 <div class="continer pagebreak">
  <div class="row">

    <div class="col-md-4 justify-content-center">


      <table border="4" cellpadding="2" class="text-center" style="line-height: 16px;">
<tr class="text-center">
  <th colspan="2" style="line-height: 0px;"><p style="margin-top: 7px;font-size: 12px;">BANK COPY</p></th>
</tr>
<tr>

  <th colspan="2" >     
   <h5 class="t_14 text-center">Vision College Gojra</h5>
 </th>
</tr>
        <tr>

          <th><span class="t_9 text-center" id="t_9">Issue Date</span></th>
          <th><span class="t_9 text-center"><?php echo $row['issue_date']; ?></span></th>
        </tr>
        <tr>
          <th class="t_9"><span class="t_9 text-center">Student Name</span></th>
          <td><span class="t_9 text-center"><?php echo $row['stu_first_name']; ?></span></td>
        </tr>
        <tr>
          <th class="t_9"><span class="t_9 text-center">Father Name</span></th>
          <td><span class="t_9 text-center"><?php echo $row['stu_last_name']; ?></span></td>
        </tr>
        <tr>
          <th class="t_9"><span class="t_9 text-center">Class</span></th>
          <td><span class="t_9 text-center"><?php echo $row['class_name']; ?></span></td>
        </tr>
         <tr>
          <th class="t_9"><span class="t_9 text-center">Roll Number</span></th>
          <td><span class="t_9 text-center"><?php echo $row['stu_reg_no']; ?></span></td>
        </tr>
        <tr>
          <th class="t_9"><span class="t_9 text-center">Particulars</span></th>
          <th><span class="t_9 text-center">Amount(PKR)</span></th>
        </tr>
<?php 
$statement = $pcon->prepare(
  "SELECT * FROM fee_assign AS 
  A inner join fee_type 
  AS B ON A.ft_id = B.ftid 
  inner join students 
  AS C ON A.stu_id = C.studentid 
  inner join class AS D 
  ON C.class_id = D.classid
  inner join discounts AS E ON
  C.discount_category = E.discid
  WHERE A.class_id = '$class_id' AND B.ft_kind = 0 Group by A.ft_id");
 $statement->execute();
 $result = $statement->fetchAll();
 $i=0;
 $net_actual_fee = 0;
 $net_due = 0;
 foreach($result as $row)
 {
  $due_date = $row['due_date'];
  $discount = $row['disc_per'];
  $calculation = $row['def_fee'] * $discount;
  $after_discount = $calculation/100;
  $actual_fee = $row['def_fee'] - $after_discount; 

   $actual_fee_arr = array($actual_fee);
$actual_fee_sum = array_sum($actual_fee_arr);
$net_actual_fee += $actual_fee_sum;

 $due_arr = array($row['fine']);
$due_sum = array_sum($due_arr);
$net_due += $due_sum;

$actual_due_fee = $net_actual_fee + $net_due;
  ?>
<tr>
  <th class="t_9"><span class="t_9 text-center"><?php echo $row['v_title']; ?></span></th>
  <td><span class="t_9 text-center"><?php echo $actual_fee; ?></span></td>
</tr>
  <?php 
 }
 ?>
   <tr>
          <th class="t_9"><span class="t_9 text-center">After Due Date (<?php echo $due_date; ?>)</span></th>
          <th><span class="t_9 text-center"><?php echo $actual_due_fee; ?></span></th>
        </tr>
    <tr>
          <th class="t_9"><span class="t_9 text-center">Miscellaneous</span></th>
          <th><span class="t_9 text-center">Amount(PKR)</span></th>
        </tr>
<?php 
$statement = $pcon->prepare(
  "SELECT * FROM fee_assign AS A inner join fee_type AS B ON A.ft_id = B.ftid inner join students AS C ON A.stu_id = C.studentid inner join class AS D ON C.class_id = D.classid 
  WHERE A.class_id = '$class_id' AND B.ft_kind = 1 Group by A.ft_id");
 $statement->execute();
 $result = $statement->fetchAll();
 $i=0;
 foreach($result as $row)
 {
  $i=0;
 

  ?>
<tr>

  <th class="t_9"><span class="t_9 text-center"><?php echo $row['v_title']; ?></span></th>
  <td><span class="t_9 text-center"><?php echo $row['def_fee']; ?></span></td>
</tr>



  <?php 
 }
 $stat = $pcon->prepare(
  "SELECT * FROM fines AS A inner join assign_fine AS B ON A.fineid = B.fine_id WHERE B.assign_stu_id = '$stuidforfee'");
 $stat->execute();
 $res = $stat->fetchAll();
 
 foreach($res as $val)
 {  
     $fine_arr = array($val['fine_amount']);
$fine_sum = array_sum($fine_arr);
$net_fine += $fine_sum;
 }
 ?>
 <tr>
 <th class="t_9"><span class="t_9 text-center">Fine</span></th>
  <td><span class="t_9 text-center"><?php echo $net_fine; ?></span></td>
</tr>
      </table>
<h6 style="border: 2px solid black;padding: 5px;">1.The voucher must be deposited within validity date.<br>
      2.No one is authorized to receive the fee without voucher<br>
      3.If a student is absentmore than two weeks without notice and fee isnot paid his/her name will be struck off the rolls. (Readmission fee Rs.2000)<br>
      4.Student will not be allowed to attend/join the class after validity date.<br>
      5.Fee once deposited will be non refundable/non transferable.<br>
      6.Duplicate voucher charges will be Rs.50.<br>
      7.Receive your Roll No.slip after clearance.
    </h6>
    </div>

    <div class="col-md-4 justify-content-center">


      <table border="4" cellpadding="2" class="text-center" style="line-height: 16px;">
        <tr class="text-center">
  <th colspan="2" style="line-height: 0px;"><p style="margin-top: 7px;font-size: 12px;">COLLEGE COPY</p></th>
</tr>
<tr>
  <th colspan="2" >     
   <h5 class="t_14 text-center">Vision College Gojra</h5>
 </th>
</tr>
        <tr>

          <th><span class="t_9 text-center">Issue Date</span></th>
          <th><span class="t_9 text-center"><?php echo $row['issue_date']; ?></span></th>
        </tr>
        <tr>
          <th class="t_9"><span class="t_9 text-center">Student Name</span></th>
          <td><span class="t_9 text-center"><?php echo $row['stu_first_name']; ?></span></td>
        </tr>
        <tr>
          <th class="t_9"><span class="t_9 text-center">Father Name</span></th>
          <td><span class="t_9 text-center"><?php echo $row['stu_last_name']; ?></span></td>
        </tr>
        <tr>
          <th class="t_9"><span class="t_9 text-center">Class</span></th>
          <td><span class="t_9 text-center"><?php echo $row['class_name']; ?></span></td>
        </tr>
         <tr>
          <th class="t_9"><span class="t_9 text-center">Roll Number</span></th>
          <td><span class="t_9 text-center"><?php echo $row['stu_reg_no']; ?></span></td>
        </tr>
        <tr>
          <th class="t_9"><span class="t_9 text-center">Particulars</span></th>
          <th><span class="t_9 text-center">Amount(PKR)</span></th>
        </tr>
<?php 
$statement = $pcon->prepare(
  "SELECT * FROM fee_assign AS 
  A inner join fee_type 
  AS B ON A.ft_id = B.ftid 
  inner join students 
  AS C ON A.stu_id = C.studentid 
  inner join class AS D 
  ON C.class_id = D.classid
  inner join discounts AS E ON
  C.discount_category = E.discid
  WHERE A.class_id = '$class_id' AND B.ft_kind = 0 Group by A.ft_id");
 $statement->execute();
 $result = $statement->fetchAll();
 $i=0;
 $net_actual_fee = 0;
 $net_due = 0;
 foreach($result as $row)
 {
  $due_date = $row['due_date'];
  $discount = $row['disc_per'];
  $calculation = $row['def_fee'] * $discount;
  $after_discount = $calculation/100;
  $actual_fee = $row['def_fee'] - $after_discount; 

   $actual_fee_arr = array($actual_fee);
$actual_fee_sum = array_sum($actual_fee_arr);
$net_actual_fee += $actual_fee_sum;

 $due_arr = array($row['fine']);
$due_sum = array_sum($due_arr);
$net_due += $due_sum;

$actual_due_fee = $net_actual_fee + $net_due;
  ?>
<tr>
  <th class="t_9"><span class="t_9 text-center"><?php echo $row['v_title']; ?></span></th>
  <td><span class="t_9 text-center"><?php echo $actual_fee; ?></span></td>
</tr>
  <?php 
 }
 ?>
   <tr>
          <th class="t_9"><span class="t_9 text-center">After Due Date (<?php echo $due_date; ?>)</span></th>
          <th><span class="t_9 text-center"><?php echo $actual_due_fee; ?></span></th>
        </tr>
    <tr>
          <th class="t_9"><span class="t_9 text-center">Miscellaneous</span></th>
          <th><span class="t_9 text-center">Amount(PKR)</span></th>
        </tr>
<?php 
$statement = $pcon->prepare(
  "SELECT * FROM fee_assign AS A inner join fee_type AS B ON A.ft_id = B.ftid inner join students AS C ON A.stu_id = C.studentid inner join class AS D ON C.class_id = D.classid 
  WHERE A.class_id = '$class_id' AND B.ft_kind = 1 Group by A.ft_id");
 $statement->execute();
 $result = $statement->fetchAll();
 $i=0;
 foreach($result as $row)
 {
  $i=0;
 

  ?>
<tr>

  <th class="t_9"><span class="t_9 text-center"><?php echo $row['v_title']; ?></span></th>
  <td><span class="t_9 text-center"><?php echo $row['def_fee']; ?></span></td>
</tr>



  <?php 
 }
 $stat = $pcon->prepare(
  "SELECT * FROM fines AS A inner join assign_fine AS B ON A.fineid = B.fine_id WHERE B.assign_stu_id = '$stuidforfee'");
 $stat->execute();
 $res = $stat->fetchAll();
 
 foreach($res as $val)
 {  
     $fine_arr = array($val['fine_amount']);
$fine_sum = array_sum($fine_arr);
$net_fine += $fine_sum;
 }
 ?>
 <tr>
 <th class="t_9"><span class="t_9 text-center">Fine</span></th>
  <td><span class="t_9 text-center"><?php echo $net_fine; ?></span></td>
</tr>
      </table>
<h6 style="border: 2px solid black;padding: 5px;">1.The voucher must be deposited within validity date.<br>
      2.No one is authorized to receive the fee without voucher<br>
      3.If a student is absentmore than two weeks without notice and fee isnot paid his/her name will be struck off the rolls. (Readmission fee Rs.2000)<br>
      4.Student will not be allowed to attend/join the class after validity date.<br>
      5.Fee once deposited will be non refundable/non transferable.<br>
      6.Duplicate voucher charges will be Rs.50.<br>
      7.Receive your Roll No.slip after clearance.
    </h6>
    </div>

    <div class="col-md-4 justify-content-center">


      <table border="4" cellpadding="2" class="text-center" style="line-height: 16px;">
        <tr class="text-center">
  <th colspan="2" style="line-height: 0px;"><p style="margin-top: 6px;font-size: 12px;">STUDENT COPY</p></th>
</tr>
<tr>
  <th colspan="2" >  
   <h5 class="t_14 text-center">Vision College Gojra</h5>
 </th>
</tr>
        <tr>

          <th><span class="t_9 text-center">Issue Date</span></th>
          <th><span class="t_9 text-center"><?php echo $row['issue_date']; ?></span></th>
        </tr>
        <tr>
          <th class="t_9"><span class="t_9 text-center">Student Name</span></th>
          <td><span class="t_9 text-center"><?php echo $row['stu_first_name']; ?></span></td>
        </tr>
        <tr>
          <th class="t_9"><span class="t_9 text-center">Father Name</span></th>
          <td><span class="t_9 text-center"><?php echo $row['stu_last_name']; ?></span></td>
        </tr>
        <tr>
          <th class="t_9"><span class="t_9 text-center">Class</span></th>
          <td><span class="t_9 text-center"><?php echo $row['class_name']; ?></span></td>
        </tr>
         <tr>
          <th class="t_9"><span class="t_9 text-center">Roll Number</span></th>
          <td><span class="t_9 text-center"><?php echo $row['stu_reg_no']; ?></span></td>
        </tr>
        <tr>
          <th class="t_9"><span class="t_9 text-center">Particulars</span></th>
          <th><span class="t_9 text-center">Amount(PKR)</span></th>
        </tr>
<?php 
$statement = $pcon->prepare(
  "SELECT * FROM fee_assign AS 
  A inner join fee_type 
  AS B ON A.ft_id = B.ftid 
  inner join students 
  AS C ON A.stu_id = C.studentid 
  inner join class AS D 
  ON C.class_id = D.classid
  inner join discounts AS E ON
  C.discount_category = E.discid
  WHERE A.class_id = '$class_id' AND B.ft_kind = 0 Group by A.ft_id");
 $statement->execute();
 $result = $statement->fetchAll();
 $i=0;
 $net_actual_fee = 0;
 $net_due = 0;
 foreach($result as $row)
 {
  $due_date = $row['due_date'];
  $discount = $row['disc_per'];
  $calculation = $row['def_fee'] * $discount;
  $after_discount = $calculation/100;
  $actual_fee = $row['def_fee'] - $after_discount; 

   $actual_fee_arr = array($actual_fee);
$actual_fee_sum = array_sum($actual_fee_arr);
$net_actual_fee += $actual_fee_sum;

 $due_arr = array($row['fine']);
$due_sum = array_sum($due_arr);
$net_due += $due_sum;

$actual_due_fee = $net_actual_fee + $net_due;
  ?>
<tr>
  <th class="t_9"><span class="t_9 text-center"><?php echo $row['v_title']; ?></span></th>
  <td><span class="t_9 text-center"><?php echo $actual_fee; ?></span></td>
</tr>
  <?php 
 }
 ?>
   <tr>
          <th class="t_9"><span class="t_9 text-center">After Due Date (<?php echo $due_date; ?>)</span></th>
          <th><span class="t_9 text-center"><?php echo $actual_due_fee; ?></span></th>
        </tr>
    <tr>
          <th class="t_9"><span class="t_9 text-center">Miscellaneous</span></th>
          <th><span class="t_9 text-center">Amount(PKR)</span></th>
        </tr>
<?php 
$statement = $pcon->prepare(
  "SELECT * FROM fee_assign AS A inner join fee_type AS B ON A.ft_id = B.ftid inner join students AS C ON A.stu_id = C.studentid inner join class AS D ON C.class_id = D.classid 
  WHERE A.class_id = '$class_id' AND B.ft_kind = 1 Group by A.ft_id");
 $statement->execute();
 $result = $statement->fetchAll();
 $i=0;
 foreach($result as $row)
 {
  $i=0;
 

  ?>
<tr>

  <th class="t_9"><span class="t_9 text-center"><?php echo $row['v_title']; ?></span></th>
  <td><span class="t_9 text-center"><?php echo $row['def_fee']; ?></span></td>
</tr>



  <?php 
 }
 $stat = $pcon->prepare(
  "SELECT * FROM fines AS A inner join assign_fine AS B ON A.fineid = B.fine_id WHERE B.assign_stu_id = '$stuidforfee'");
 $stat->execute();
 $res = $stat->fetchAll();
 
 foreach($res as $val)
 {  
     $fine_arr = array($val['fine_amount']);
$fine_sum = array_sum($fine_arr);
$net_fine += $fine_sum;
 }
 ?>
 <tr>
 <th class="t_9"><span class="t_9 text-center">Fine</span></th>
  <td><span class="t_9 text-center"><?php echo $net_fine; ?></span></td>
</tr>
      </table>
<h6 style="border: 2px solid black;padding: 5px;">1.The voucher must be deposited within validity date.<br>
      2.No one is authorized to receive the fee without voucher<br>
      3.If a student is absentmore than two weeks without notice and fee isnot paid his/her name will be struck off the rolls. (Readmission fee Rs.2000)<br>
      4.Student will not be allowed to attend/join the class after validity date.<br>
      5.Fee once deposited will be non refundable/non transferable.<br>
      6.Duplicate voucher charges will be Rs.50.<br>
      7.Receive your Roll No.slip after clearance.
    </h6>
    </div>
  
  

  </div>

 </div>
 <?php 
 }
}

 ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>