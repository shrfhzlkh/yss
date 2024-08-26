<?php

include('includes/config.php');

if(isset($_POST['drivername']))
{
	$drivername=$_POST['drivername'];
	$sql1="INSERT INTO tbldrivers (`Driver_name`) VALUES(:drivername)";
	$query = $dbh->prepare($sql1);
	$query->bindParam(':drivername',$drivername,PDO::PARAM_STR);
	
    try {
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId) {
            header("Location: driver.php");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
