<?php
include('../../classes/pdo.php');
if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
 {

  $statement = $pcon->prepare("
   INSERT INTO assign_fine (fine_id, assign_stu_id, fine_date, assign_status, collected_fine) 
   VALUES (:fine_id, :assign_stu_id, :fine_date, :assign_status, :collected_fine)
  ");
  $result = $statement->execute(
   array(
    ':fine_id' => $_POST['fine_id'],
    ':assign_stu_id' => $_POST['assign_stu_id'],
    ':fine_date' => date('d-m-Y'),
    ':assign_status' => 0,
    ':collected_fine' => 0
   )
  );
  if(!empty($result))
  {
   echo 'Data Inserted';
  }

}
 }
 if($_POST["operation"] == "Edit")
 {

  $statement = $pcon->prepare(
   "UPDATE class
   SET class_name = :class_name, class_fee = :class_fee, running_status = :running_status, teacher_id = :teacher_id,class_status = :class_status  
   WHERE classid = :id
   "
  );
  $result = $statement->execute(
   array(
      ':class_name' => $_POST['class_name'],
    ':class_fee' => $_POST['class_fee'],
    ':running_status' => $_POST['running_status'],
    ':teacher_id' => $_POST['c_teacher'],
    ':class_status' => $_POST['class_status'],
    ':id'   => $_POST["employee_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }


?>