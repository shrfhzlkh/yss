<?php
session_start();
error_reporting(0);
include('includes/config.php');

echo $_POST['review'];
	$id=$_GET['rid'];
	$review=$_POST['review'];
	$sql = "UPDATE tblbooking SET Review=:review WHERE id=:id";
	$query = $dbh->prepare($sql);
	$query->bindParam(':review',$review,PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
	$query->execute();
	$msg="Review Updated Successfully";
 //   echo "<script type='text/javascript'> document.location = 'bookig-details.php?bid=$id'; </script>";


?>