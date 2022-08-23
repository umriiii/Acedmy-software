<?php

$servername = "localhost";
$username = "phtmsols_tmpcg";
$password = "phtmsols_tmpcg";
$dbname = "phtmsols_tmpcg";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) 
{
     die("Connection failed: " . $conn->connect_error);
}


?>

