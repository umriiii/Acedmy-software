<?php
include('../../classes/pdo.php');
if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
 {
$stuid = $_POST["stu_id"];
 $statement = $pcon->prepare(
  "SELECT * FROM fee_assign 
  WHERE stu_id = '$stuid' AND fee_status = 'Not Paid' "
 );
 $statement->execute();
 $count = $statement->rowCount();
 if($count > 0){
echo "0";
 }else{
$statement = $pcon->prepare(
  "SELECT * FROM balance 
  WHERE stu_id = '$stuid' "
 );
 $statement->execute();
 $count_stu = $statement->rowCount();
 if ($count_stu > 0) {
   echo "1";
 }else{
  $statement = $pcon->prepare("
   INSERT INTO balance (stu_id, stu_balance, create_on, bal_disc ) 
   VALUES (:stu_id, :balance, :create_on, :bal_disc)
  ");
  $result = $statement->execute(
   array(
    ':stu_id' => $_POST['stu_id'],
    ':balance' => $_POST['balance'],
    ':bal_disc' => $_POST['bal_disc'],
    ':create_on' => date('d-m-Y')
   )
  );
  if(!empty($result))
  {
   echo 'Data Inserted';
  }
 }

}

}
 
 if($_POST["operation"] == "Edit")
 {



$stuid = $_POST["stu_id"];
 $statement = $pcon->prepare(
  "SELECT * FROM fee_assign 
  WHERE stu_id = '$stuid' AND fee_status = 'Not Paid' "
 );
 $statement->execute();
 $count = $statement->rowCount();
 if($count > 0){
echo "0";
 }else{
 
  $statement = $pcon->prepare(
   "UPDATE balance
   SET stu_id = :stu_id, stu_balance = :balance, bal_disc = :bal_disc, create_on = :create_on 
   WHERE balid = :id
   "
  );
  $result = $statement->execute(
   array(
    ':stu_id' => $_POST['stu_id'],
    ':balance' => $_POST['balance'],
    ':bal_disc' => $_POST['bal_disc'],
    ':create_on' => date('d-m-Y'),
    ':id'   => $_POST["employee_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 

}



 }
}

?>