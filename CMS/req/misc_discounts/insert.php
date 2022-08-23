<?php
include('../../classes/pdo.php');
if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
 {
  $statement = $pcon->prepare("
   INSERT INTO misc_discounts (misc_disc_name, misc_disc_per, misc_disc_desc, misc_disc_status) 
   VALUES (:misc_disc_name, :misc_disc_per, :misc_disc_desc, :misc_disc_status)
  ");
  $result = $statement->execute(
   array(
    ':misc_disc_name' => $_POST['misc_disc_name'],
    ':misc_disc_per' => $_POST['misc_disc_per'],
    ':misc_disc_desc' => $_POST['misc_disc_desc'],
    ':misc_disc_status' => $_POST['misc_disc_status']
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
   "UPDATE misc_discounts
   SET misc_disc_name = :misc_disc_name, misc_disc_per = :misc_disc_per, misc_disc_desc = :misc_disc_desc, misc_disc_status = :misc_disc_status 
   WHERE miscdiscid = :id
   "
  );
  $result = $statement->execute(
   array(
     ':misc_disc_name' => $_POST['misc_disc_name'],
    ':misc_disc_per' => $_POST['misc_disc_per'],
    ':misc_disc_desc' => $_POST['misc_disc_desc'],
    ':misc_disc_status' => $_POST['misc_disc_status'],
    ':id'   => $_POST["employee_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }


?>