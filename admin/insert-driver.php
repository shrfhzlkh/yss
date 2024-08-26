<?php
session_start();
include('includes/config.php');
error_reporting(0);

$id=intval($_GET['bid']);
$driver=$_POST['driver']; 
echo $driver;
$sql="update tblbooking set Driver=:driver where id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->bindParam(':driver',$driver,PDO::PARAM_STR);
$query->execute();

header ("location:bookig-details.php?bid=$id");

?>