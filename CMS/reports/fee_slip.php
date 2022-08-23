<?php 
require_once("../FPDF-master/fpdf.php");
include '../classes/db.php';  

if(isset($_GET['feeid'])){
	$Student_ID = $_GET['feeid'];
	$sql = mysqli_query($conn,
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
WHERE C.feeid='".$_GET["feeid"]."'");

	$row = mysqli_fetch_array($sql);
	$Class_fees = $row['class_fee'];
    $Discount = $row['student_discount'];
    // $Calculation = $Class_fees * $Discount;
    // $Calculated_Discount = $Calculation/100;
    $Calculated_Class_Fee = $Class_fees - $Discount;
    $Fee_Submitted = $row['student_fee'];
    $Student_dues = $Calculated_Class_Fee - $Fee_Submitted;
    $stu_first_name = $row['stu_first_name'];
    $stu_last_name = $row['stu_last_name'];
    $stu_reg_no = $row['stu_reg_no'];
    $class_name = $row['class_name'];

$mypdf = new FPDF();
$mypdf -> AddPage();
$mypdf -> Image('../img/logo.jpg', 10, 10,40,30);
$mypdf -> SetFont("Arial", "B",18);
  
 $mypdf -> Cell(190,30, "Quaid-e-Azam College Gojra", 1,1, "C");
 $mypdf -> SetFont("Arial", "B",14); 
 $mypdf -> Cell(80,20, "Bill To:", 1,0, "C"); 
 $mypdf -> Multicell(110,5, $stu_first_name."\n".$stu_last_name."\n".$class_name."\n".$stu_reg_no,1,"C"); 
 
 $mypdf -> Cell(80,10, "", 0,0, "C");
 $mypdf -> Cell(110,10, "", 0,1, "C");
 $mypdf -> SetFont("Arial", "B",12);
 $mypdf -> Cell(80,10, "Fee Status:", 1,0, "C"); 
 $mypdf -> SetFont("Arial", "",12);
 $mypdf -> Cell(110,10, $row["status"], 1,1, "C");
 $mypdf -> SetFont("Arial", "B",12);
  $mypdf -> Cell(80,10, "Discount Category:", 1,0, "C");
  $mypdf -> SetFont("Arial", "",12); 
 $mypdf -> Cell(110,10, $row["discount_category"], 1,1, "C");
 $mypdf -> SetFont("Arial", "B",12);
 $mypdf -> Cell(80,10, "Discount:", 1,0, "C");
 $mypdf -> SetFont("Arial", "",12); 
 $mypdf -> Cell(110,10, $row["student_discount"], 1,1, "C");
 $mypdf -> SetFont("Arial", "B",12);
 $mypdf -> Cell(80,10, "Fee After Discount:", 1,0, "C");
 $mypdf -> SetFont("Arial", "",12); 
 $mypdf -> Cell(110,10, $Calculated_Class_Fee, 1,1, "C");
 $mypdf -> SetFont("Arial", "B",12);
  $mypdf -> Cell(80,10, "Amount Submitted:", 1,0, "C"); 
  $mypdf -> SetFont("Arial", "",12);
 $mypdf -> Cell(110,10, $row["student_fee"], 1,1, "C");
 $mypdf -> SetFont("Arial", "B",12);
  $mypdf -> Cell(80,10, "Due Amount:", 1,0, "C");
  $mypdf -> SetFont("Arial", "",12); 
 $mypdf -> Cell(110,10, $Student_dues, 1,1, "C");
 $mypdf -> SetFont("Arial", "B",12);
  $mypdf -> Cell(80,10, "Submit on:", 1,0, "C");
  $mypdf -> SetFont("Arial", "",12); 
 $mypdf -> Cell(110,10, $row["submit_on"], 1,1, "C");

  $mypdf -> Output();
	 ?>	
	
<?php } ?>













