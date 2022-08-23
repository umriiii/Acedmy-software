<?php 
 include '../config/db.php';

  
	$class_id=$_POST['class_id'];
	$sql=mysqli_query($connect,"SELECT * FROM subjects WHERE class_id='$class_id'");
	?>
<select name="sel_sub" id="sel_sub" class="form-control">
                            <option  selected="">--select subject--</option>
<?php 
	while ($row=mysqli_fetch_array($sql)) {
		?>
		
                              <option value="<?php echo $row[0]; ?>"><?php echo $row["sub_name"]; ?></option>
                             
  <?php 
	}

 ?>
  </select>