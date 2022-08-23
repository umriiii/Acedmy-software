<?php
date_default_timezone_set("Asia/Karachi");
  include '../../../config/db.php'; 
include('crud_functions.php');
if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $image = '';
  
  $statement = $connection->prepare("
   INSERT INTO advertises (ad_title, ad_price, pkg_id, link, ad_status) VALUES (:ad_title, :ad_price, :pkg_id, :link, :ad_status)
  ");
  $result = $statement->execute(
   array(
    ':ad_title' => $_POST["ad_title"],
    ':ad_price' => $_POST["ad_price"],
    ':pkg_id' => $_POST["pkg_id"],
    ':link' => $_POST["link"],
    ':ad_status' => 1
   )
  );
  if(!empty($result))
  {
   echo 'Data Inserted';
  }
 }
 if($_POST["operation"] == "Edit")
 {

 
  $statement = $connection->prepare(
   "UPDATE advertises 
   SET ad_title = :ad_title, ad_price = :ad_price, pkg_id = :pkg_id, link = :link, ad_status = :ad_status
   WHERE adid = :id
   "
  );
  $result = $statement->execute(
   array(
    ':ad_title' => $_POST["ad_title"],
    ':ad_price' => $_POST["ad_price"],
    ':pkg_id' => $_POST["pkg_id"],
    ':link' => $_POST["link"],
    ':ad_status' => $_POST["ad_status"],
    ':id'   => $_POST["user_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }
}

?>