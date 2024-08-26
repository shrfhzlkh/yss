<?php
session_start();
include('includes/config.php');
error_reporting(0);

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql = "DELETE FROM tblbooking WHERE id = $id";

    $query = $dbh -> prepare($sql);
    $query->execute();
    header('location:index.php');
} 
?>