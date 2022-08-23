<?php
include('../../classes/pdo.php');
if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
 {
  $statement = $pcon->prepare("
   INSERT INTO fee_type (title, fine, due_date, ft_kind, def_fee, ft_createon, running_status, install_id, v_title) 
   VALUES (:title, :fine, :due_date, :ft_kind, :def_fee, :ft_createon, :running_status, :install_id, :v_title)
  ");
  $result = $statement->execute(
   array(
    ':title' => $_POST['title'],
    ':fine' => $_POST['fine'],
    ':ft_kind' => $_POST['ft_kind'],
    ':def_fee' => $_POST['def_fee'],
    ':ft_createon' => date('d-m-Y'),
    ':running_status' => $_POST['running_status'],
    ':install_id' => $_POST['install_id'],
    ':v_title' => $_POST['v_title'],
    ':due_date' => $_POST['due_date']
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
   "UPDATE fee_type
   SET title = :title, fine = :fine, ft_kind = :ft_kind, def_fee = :def_fee, ft_createon = :ft_createon, running_status = :running_status, install_id = :install_id, due_date = :due_date, v_title = :v_title  
   WHERE ftid = :id
   "
  );
  $result = $statement->execute(
   array(
      ':title' => $_POST['title'],
    ':fine' => $_POST['fine'],
    ':ft_kind' => $_POST['ft_kind'],
    ':def_fee' => $_POST['def_fee'],
    ':ft_createon' => date('d-m-Y'),
    ':running_status' => $_POST['running_status'],
    ':install_id' => $_POST['install_id'],
    ':due_date' => $_POST['due_date'],
    ':v_title' => $_POST['v_title'],
    ':id'   => $_POST["employee_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }


?>