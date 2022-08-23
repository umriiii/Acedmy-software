<?php
include('../../classes/pdo.php');
if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
 {
  $statement = $pcon->prepare("
   INSERT INTO subjects (sub_name, sub_tec_id, class_id) 
   VALUES (:sub_name, :sub_tec, :sub_class)
  ");
  $result = $statement->execute(
   array(
    ':sub_name' => $_POST['sub_name'],
    ':sub_tec' => $_POST['sub_tec'],
    ':sub_class' => $_POST['sub_class']
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
   "UPDATE subjects
   SET sub_name = :sub_name, sub_tec_id = :sub_tec, class_id = :sub_class 
   WHERE subjectid = :id
   "
  );
  $result = $statement->execute(
   array(
         ':sub_name' => $_POST['sub_name'],
    ':sub_tec' => $_POST['sub_tec'],
    ':sub_class' => $_POST['sub_class'],
    ':id'   => $_POST["employee_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }


?>