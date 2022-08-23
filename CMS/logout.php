<?php   
 //logout.php  
session_start();
unset($_SESSION['principal']);
unset($_SESSION['gm_manager']);
unset($_SESSION['fc_manager']);
session_destroy();
header("Location: login1.php");  
 ?>