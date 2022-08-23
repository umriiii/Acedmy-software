<?php



function get_total_all_records()
{
 include '../../classes/pdo.php';
 $statement = $connection->prepare("SELECT * FROM advertises");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}

?>