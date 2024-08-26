<?php
session_start();
include('includes/config.php');


$location=$_POST['location'];
$purpose=$_POST['purpose'];
$passengerno=$_POST['passengerno']; 
$ousername=$_POST['ousername'];
$ousertel=$_POST['ousertel'];
$ouseremail=$_POST['ouseremail'];
$typeservice=$_POST['typeservice'];
$waitgo=$_POST['waitgo'];
$waitreturn=$_POST['waitreturn'];
$useremail=$_SESSION['login'];
$id=$_POST['id'];
$sql="UPDATE tblbooking SET Location=:location, Purpose=:purpose, PassengerNo=:passengerno, TypeService=:typeservice, WaitGo=:waitgo, WaitReturn=:waitreturn WHERE id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->bindParam(':location',$location,PDO::PARAM_STR);
$query->bindParam(':purpose',$purpose,PDO::PARAM_STR);
$query->bindParam(':passengerno',$passengerno,PDO::PARAM_STR);
$query->bindParam(':typeservice',$typeservice,PDO::PARAM_STR);
$query->bindParam(':waitgo',$waitgo,PDO::PARAM_STR);
$query->bindParam(':waitreturn',$waitreturn,PDO::PARAM_STR);
$query->execute();

if(!empty($_POST['ousername']) && !empty($ousername) && !empty($ousertel) && !empty($ouseremail)) {
    $sql2="INSERT INTO  tblotheruser(`Ouser_name`,`Ouser_tel`,`Ouser_email`) VALUES(:ousername,:ousertel,:ouseremail)";
    $query1 = $dbh->prepare($sql2);
    $query1->bindParam(':ousername',$ousername,PDO::PARAM_STR);
    $query1->bindParam(':ousertel',$ousertel,PDO::PARAM_STR);
    $query1->bindParam(':ouseremail',$ouseremail,PDO::PARAM_STR);
    if($query1->execute()){
        $lastInsertId = $dbh->lastInsertId();
        $sql3="UPDATE tblbooking SET Otheruser_id=:lastInsertId WHERE id=:id";
        $query = $dbh->prepare($sql3);
        $query->bindParam(':id',$id,PDO::PARAM_STR);
        $query->bindParam(':lastInsertId',$lastInsertId,PDO::PARAM_STR);
        $query->execute();
    }
}


// The message
$to = $_SESSION['login'];
$message = "Permohonan anda telah diterima dan sedang diproses.";
$subject = "Permohonan Menggunakan Kenderaan Jabatan";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70, "\r\n");

// Send
mail($to, $subject, $message);

header ("location:summary.php?id=$id");



  
?>