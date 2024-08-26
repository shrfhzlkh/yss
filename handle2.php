<?php
session_start();
include('includes/config.php');

$mileagebefore=$_POST['mileagebefore'];
$mileageafter=$_POST['mileageafter'];
$id=$_GET['id'];
$sql="UPDATE tblbooking SET MileageBefore=:mileagebefore, MileageAfter=:mileageafter WHERE id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->bindParam(':mileagebefore',$mileagebefore,PDO::PARAM_STR);
$query->bindParam(':mileageafter',$mileageafter,PDO::PARAM_STR);
$query->execute();

header ("location:bookingdetails.php?id=$id");

?>