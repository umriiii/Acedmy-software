<?php 
include 'connection.php';	
$connect=mysqli_connect("$host","$username","$password","$database");
if ($connect) {
 // echo "Success";
} else {
	echo "Error";
}
?>