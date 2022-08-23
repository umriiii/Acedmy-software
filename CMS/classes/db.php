<?php 	
include 'connection.php';
$conn=mysqli_connect("$host","$username","$password","$database");
if ($conn) {
 // echo "Success";
} else {
	echo "Error";
	die();
}


 ?>