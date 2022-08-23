


	<?php 
$pcon = new PDO( 
    'mysql:host=localhost;dbname=visidfvt_vgirls', 
    'visidfvt_vgirls', 
    'visidfvt_vgirls', 
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") 
);
	
	include("conn.php"); 
	
	$myString = $_REQUEST['myString'];
	$myString = rtrim($myString, "~");
	
	$qry = "insert into raw_string (mystring) values ('" . $myString . "'); ";
	$stmt = $conn->prepare($qry);
	$stmt->execute();				
	$stmt->close();
	
		$qry3 = "insert into raw_string (mystring) values ('" . $myString . "'); ";
	$stmt3 = $conn2->prepare($qry3);
	$stmt3->execute();				
	$stmt3->close();
	
	$totalRecordsArr = explode ("~", $myString);
	//echo sizeof($totalRecordsArr);exit;
	
	$qry = "";
	$qry2 = "";
	if (sizeof($totalRecordsArr)>0)
		$qry = " insert into raw_data (machineNo, att_status, enrollmentNo, name, entryDate, entryTime, entryDateTime, createdDateTime) values ";
		
		$qry2 = " insert into raw_data (machineNo, att_status, enrollmentNo, name, entryDate, entryTime, entryDateTime, createdDateTime) values ";
	
	//echo $qry;exit;
	for ($i=0; $i < sizeof($totalRecordsArr); $i++)
	{
	    
	    
	    $myArr = explode ("|", $totalRecordsArr[$i]);
		
		$machineNo 		= mysqli_real_escape_string ($conn ,$myArr[0]);
		$enrollmentNo 	= mysqli_real_escape_string ($conn ,$myArr[1]);
		$name 			= mysqli_real_escape_string ($conn ,$myArr[2]);
		$entryDate 		= mysqli_real_escape_string ($conn ,$myArr[3]);
		$entryTime 		= mysqli_real_escape_string ($conn ,$myArr[4]);
		$entryDateTime 	= mysqli_real_escape_string ($conn ,$myArr[5]);
		$att_status = 0;
		
		
		
		$machineNo2 		= mysqli_real_escape_string ($conn2 ,$myArr[0]);
		$enrollmentNo2 	= mysqli_real_escape_string ($conn2 ,$myArr[1]);
		$name2 			= mysqli_real_escape_string ($conn2 ,$myArr[2]);
		$entryDate2 		= mysqli_real_escape_string ($conn2 ,$myArr[3]);
		$entryTime2 		= mysqli_real_escape_string ($conn2 ,$myArr[4]);
		$entryDateTime2 	= mysqli_real_escape_string ($conn2 ,$myArr[5]);
		$att_status2 = 0;
		
		 $query = "
  SELECT * FROM students WHERE studentid = '$enrollmentNo'";
  $statement = $pcon->prepare($query);
  $statement->execute();
 
  $count_row = $statement->rowCount();
  
  if($count_row > 0){
 
$row = $statement->fetch();

$timenow = date("Y-m-d H:i:s");

  	$qry2 .= "  (:machineNo2, :att_status2, :enrollmentNo2, :name2, :entryDate2, :entryTime2, :entryDateTime2, :timenow ), ";
      	
      	$qry2 = rtrim($qry2, ", ");
		$qry2 = $qry2 . "; ";
		
			$stmt2 = $conn2->prepare($qry2);
	$res = $stmt2->execute(
		    array(
		    ':$machineNo2' => $machineNo2,
		     ':att_status2' => $att_status2,
		      ':enrollmentNo2' => $enrollmentNo2,
		       ':name2' => $name2,
		        ':entryDate2' => $entryDate2,
		         ':entryTime2' => $entryTime2,
		          ':entryDateTime2' => $entryDateTime2,
		          ':timenow' => $timenow
		    )
		    );


  }else{
      
     
      
     $timenow = date("Y-m-d H:i:s");

  	$qry2 .= "  (:machineNo, :att_status, :enrollmentNo, :name, :entryDate, :entryTime, :entryDateTime, :timenow ), ";
      	
      	$qry = rtrim($qry, ", ");
		$qry = $qry . "; ";
		
			$stmt = $conn->prepare($qry);
	$res = $stmt->execute(
		    array(
		    ':$machineNo' => $machineNo,
		     ':att_status2' => $att_status,
		      ':enrollmentNo' => $enrollmentNo,
		       ':name' => $name,
		        ':entryDate' => $entryDate,
		         ':entryTime' => $entryTime,
		          ':entryDateTime' => $entryDateTime,
		          ':timenow' => $timenow
		    )
		    );
      
      
    
		
	
  }
  	
	}
	
    ////echo $qry;exit;
	
	//print_r($totalRecordsArr); exit;

	
	
	
	?>



		