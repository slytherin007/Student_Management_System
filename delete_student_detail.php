<?php
include 'dbconnect.php';
session_start();
if(!$_SESSION['email']){
$_SESSION['login_first']="Please login first"; header('Location:index.php');
}

if(isset($_GET['delete_student'])){
$delete =$_GET['delete_student'];

$query= "select * from student_detail where st_id = '$delete'"; 
$rs =mysqli_query($con, $query);
while($row = mysqli_fetch_assoc($rs)){

$image= $row['photo'];}

unlink('st_image/'.$image );
$sql= "delete from student_detail where st_id = '$delete' "; 
$run=mysqli_query($con, $sql);
if($run){
echo "<script>window.open('view_student.php?delete_msg=Data deleted successfully','_self')</script>";}
}
?>