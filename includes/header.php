
<header>
  <div class="default-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-2">
          <div class="logo"> <a href="index.php"><img src="assets/images/logo-yss.png" width="105" height="50" alt="image"/></a> </div>
        </div>
        <div class="col-sm-9 col-md-10">
          <div class="header_info">
         <?php
         $sql = "SELECT EmailId,ContactNo from tblcontactusinfo";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach ($results as $result) {
$email=$result->EmailId;
$contactno=$result->ContactNo;
}
?>   

            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
              <p class="uppercase_text">Mail: </p>
              <a href="mailto:<?php echo htmlentities($email);?>"><?php echo htmlentities($email);?></a> </div>
            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
              <p class="uppercase_text">Telefon: </p>
              <a href="tel:<?php echo htmlentities($contactno);?>"><?php echo htmlentities($contactno);?></a> </div>
            <div class="social-follow">
            
            </div>
            <div class="header_widgets">
            <div class="container">
    <ul class="social-icons">
    <li><a href="https://www.facebook.com/SukarelawanYSS" target="_blank" class="fa fa-facebook"></a>&nbsp;&nbsp;&nbsp;
    <a href="https://twitter.com/SukarelawanYSS" target="_blank" class="fa fa-twitter"></a>&nbsp;&nbsp;&nbsp;
    <a href="https://www.instagram.com/sukarelawanyss/" target="_blank" class="fa fa-instagram"></a></li>
    </ul>
    </div>         
   </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Navigation -->
  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="header_wrap">
        <div class="user_login">
          <ul>
            <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i> 
<?php 
$email=$_SESSION['login'];
$sql ="SELECT FullName FROM tblusers WHERE EmailId=:email ";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
	{

	 echo htmlentities($result->FullName); }}?>
   <i class="fa fa-angle-down" aria-hidden="true"></i></a>
              <ul class="dropdown-menu">
            <li><a href="profile.php">Profil</a></li>
              <li><a href="update-password.php">Kemaskini Kata Laluan</a></li>
            <li><a href="my-booking.php">Permohonan</a></li>
            <li><a href="logout.php">Log Keluar</a></li>
          </ul>
            </li>
          </ul>
        </div>
        <div class="header_search">
          <div id="search_toggle"><i class="fa fa-search" aria-hidden="true"></i></div>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Laman Utama</a>    </li>
          <li><a href="my-booking.php">Permohonan</a>    </li>


        </ul>
      </div>
    </div>
  </nav>
  <!-- Navigation end --> 
  
</header>