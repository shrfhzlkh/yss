<?php

session_start();
include('includes/config.php');
error_reporting(0);

if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql ="SELECT EmailId,Password,FullName FROM tblusers WHERE EmailId=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['login']=$_POST['email'];
$_SESSION['fname']=$results->FullName;
echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>
    
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>LOGIN</title>

</head>
<body>
    <style>
body {
	background: #bbbaba;
	display: flex;
	justify-content: center;
	align-items: center;
	height: 100vh;
	flex-direction: column;
}

*{
	font-family: sans-serif;
	box-sizing: border-box;
}

form {
	width: 500px;
	border: 2px solid #ccc;
	padding: 30px;
	background: #fff;
	border-radius: 15px;
    box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.2);
}

h2 {
	text-align: center;
	margin-bottom: 40px;
}

input {
	display: block;
	border: 2px solid #ccc;
	width: 95%;
	padding: 10px;
	margin: 10px auto;
	border-radius: 5px;
}
label {
	color: #888;
	font-size: 18px;
	padding: 10px;
}

button {
	float: right;
	background: #607595;
	padding: 10px 15px;
	color: #fff;
	border-radius: 5px;
	margin-right: 10px;
	border: none;
}
button:hover{
	opacity: .7;
}
.error {
   background: #F2DEDE;
   color: #A94442;
   padding: 10px;
   width: 95%;
   border-radius: 5px;
   margin: 20px auto;
}

.success {
   background: #D4EDDA;
   color: #40754C;
   padding: 10px;
   width: 95%;
   border-radius: 5px;
   margin: 20px auto;
}

h1 {
	text-align: center;
	color: #fff;
}

.ca {
	font-size: 14px;
	display: inline-block;
	padding: 10px;
	text-decoration: none;
	color: #444;
}
.ca:hover {
	text-decoration: underline;
} 

.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.check
{
  width: 15px;
  height: 15px;
  margin: 0;
  margin-right: 5px;
  display: flex;
  flex-direction: row;
  align-items: center;
  margin-bottom: 7px;
  font-size: 14px;
}

</style>

    <form method="post">    
    <img src="assets/images/logo-yss.png" class="center" width="150" height="70" title="logoyss" ;>
     	<h2>LOGIN</h2>
     	<label>Email</label>
     	<input type="text" name="email" placeholder="Email"><br>

     	<label>Kata Laluan</label>
     	<input type="password" name="password" placeholder="Kata Laluan"><br>
		
		<button type="submit" name="login" value="Login" class="btn btn-block">Log Masuk</button>

     </form>
    
    </body>
</html>

