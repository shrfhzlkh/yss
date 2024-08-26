<?php
session_start();
include('includes/config.php');


  $tng=$_POST['tng'];
  $id=$_GET['id'];
  $sql="UPDATE tblbooking SET TNG=:tng WHERE id=:id";
  $query= $dbh->prepare($sql);
  $query->bindParam(':id', $id, PDO::PARAM_STR);
  $query->bindParam(':tng',$tng,PDO::PARAM_STR);
  $query->execute();

  header ("location:bookingdetails.php?id=$id");


?>