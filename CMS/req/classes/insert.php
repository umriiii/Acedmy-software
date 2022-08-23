<?php
include('../../classes/pdo.php');
if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
 {
  $statement = $pcon->prepare("
   INSERT INTO class (class_name, code_name, class_fee, running_status, class_status, teacher_id) 
   VALUES (:class_name, :code_name, :class_fee, :running_status, :class_status, :teacher_id)
  ");
  $result = $statement->execute(
   array(
    ':class_name' => $_POST['class_name'],
    ':code_name' => $_POST['code_name'],
    ':class_fee' => $_POST['class_fee'],
    ':running_status' => $_POST['running_status'],
    ':teacher_id' => $_POST['c_teacher'],
    ':class_status' => $_POST['class_status']
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
   SET class_name = :class_name, code_name = :code_name, class_fee = :class_fee, running_status = :running_status, teacher_id = :teacher_id,class_status = :class_status  
   WHERE classid = :id
   "
  );
  $result = $statement->execute(
   array(
      ':class_name' => $_POST['class_name'],
      ':code_name' => $_POST['code_name'],
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