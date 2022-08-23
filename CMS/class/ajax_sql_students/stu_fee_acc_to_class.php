<?php 
 include '../config/db.php'; 
$class_id = $_POST['stu_class_id'];
$sql = mysqli_query($connect,"SELECT * FROM class WHERE classid = '$class_id'");
while ($row = mysqli_fetch_array($sql)) {
?>
<input type="number" name="stu_class_fee" id="stu_class_fee" class="form-control" data-parsley-required="true" placeholder="<?php echo $row['class_fee']; ?>">

<?php } ?>