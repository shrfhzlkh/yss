<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(($_POST['submit']))
  {
    $sop=$_POST['sop'];
    $id=$_GET['id'];
    $sql="UPDATE tblbooking SET SOP=:sop WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':sop',$sop,PDO::PARAM_STR);
    $query->execute();
  }


?><!DOCTYPE HTML>
<html lang="en">
<head>

<title>YSS</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<!--OWL Carousel slider-->
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="assets/css/slick.css" rel="stylesheet">
<!--bootstrap-slider -->
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<!-- SWITCHER -->
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
        
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/logoyss.jpg">
<!-- Google-Font-->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->  
<style>
  .button {
  background-color: #555555; 
  border: none;
  color: white;
  padding: 13px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 8px;
  }
  .back{
  background-color: #555555; 
  color:  white;
  }
  .update{
    background-color: #2186c4; 
  }

  </style>
</head>
<body>
        
<!--Header-->
<?php include('includes/header.php');?>
<!--Page Header-->
<!-- /Header --> 

<!--Page Header-->
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Maklumat Permohonan</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="index.php">Laman Utama</a></li>
        <li>Permohonan</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

    <div class="row">
      <div class="col-md-3 col-sm-3">
       <?php include('includes/sidebar.php');?>
   
      <div class="col-md-8 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline">Maklumat Permohonan</h5>
          <div class="my_vehicles_list">
            <ul class="vehicle_listing">
<?php 
$useremail=$_SESSION['login'];
$id=$_GET['id'];
$sql = "SELECT tblvehicles.Vimage1 as Vimage1,tblvehicles.VehiclesTitle,tblvehicles.id as vid,tblusers.FullName,tblusers.ContactNo,tblusers.EmailId,tblbooking.*,tblotheruser.Ouser_id,tblotheruser.Ouser_name,tblotheruser.Ouser_tel,tblotheruser.Ouser_email,tbldrivers.* 
        from tblbooking 
        LEFT JOIN tblvehicles on tblbooking.VehicleId=tblvehicles.id 
        LEFT JOIN tblusers on tblusers.EmailId=tblbooking.userEmail 
        LEFT JOIN tblotheruser on tblotheruser.Ouser_id=tblbooking.Otheruser_id 
        LEFT JOIN tbldrivers on tbldrivers.Driver_id=tblbooking.Driver
        where tblbooking.id=:id";
$query = $dbh -> prepare($sql);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>

<li>
    <h4 style="color:red">No. Permohonan: <?php echo htmlentities($result->BookingNumber);?></h4>
                <div class="vehicle_img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image"></a> </div>
                <div class="vehicle_title">

                  <h6><a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid);?>"><?php echo htmlentities($result->VehiclesTitle);?></a></h6>              
                </div>
                <?php if($result->Status==1)
                { ?>
                <div class="vehicle_status"> <a class="btn outline btn-xs active-btn">Lulus</a>
                           <div class="clearfix"></div>
        </div>

              <?php } else if($result->Status==2) { ?>
 <div class="vehicle_status"> <a class="btn outline btn-xs">Tidak Lulus</a>
            <div class="clearfix"></div>
        </div>
             


                <?php } else { ?>
 <div class="vehicle_status"> <a class="btn outline btn-xs">Dalam Proses</a>
            <div class="clearfix"></div>
        </div>
                <?php } ?>
       
              </li>
              
<?php if($result->Status==1){ ?>
<?php if(empty($result->MileageBefore)){ ?>
Sila isi bacaan odometer.
<?php }} ?>

<table class="table table-striped">
    <tr>
    <?php if($result->Ouser_name!=NULL){ ?>
    <th width="150">Nama Pengguna</th>
    <td><?php 
      echo htmlentities($result->Ouser_name);
    } 
    ?></td>
    </tr>
    <tr>
    <?php if($result->Ouser_tel!=NULL){ ?>
    <th width="150">No Telefon Pengguna</th>
    <td><?php
      echo htmlentities($result->Ouser_tel);
    } 
    ?></td>
    </tr>
    <tr>
    <?php if($result->Ouser_email!=NULL){ ?>
    <th width="150">Alamat Emel Pengguna</th>
    <td><?php
      echo htmlentities($result->Ouser_email);
    } 
    ?></td>
    </tr>

    <tr>
    <th width="150">Jenis Kenderaan</th>
    <td><?php echo htmlentities($result->VehiclesTitle);?></td>
    </tr>
    <tr>
    <th width="100">Pergi</th>
    <td><?php echo htmlentities($result->FromDate);?></td>
    </tr>
    <tr>
    <th width="100">Masa</th>
    <td><?php echo htmlentities($result->FromTime);?></td>
    </tr>
    <tr>
    <th width="100">Balik</th>
    <td> <?php echo htmlentities($result->ToDate);?></td>
    </tr>
    <tr>
    <th width="100">Masa</th>
    <td> <?php echo htmlentities($result->ToTime);?></td>
    </tr>
    <tr>
    <th width="100">Lokasi</th>
    <td><?php echo htmlentities($result->Location);?></td>
    </tr>
    <tr>
    <th width="100">Tujuan</th>
    <td><?php echo htmlentities($result->Purpose);?></td>
    </tr>
    <tr>
    <th width="100">Nama Pemandu</th>
    <td><?php echo htmlentities($result->Driver_name);?></td>
    </tr>
    <tr>
    <th width="100">Jumlah Penumpang</th>
    <td><?php echo htmlentities($result->PassengerNo);?></td>
    </tr>
    <tr>
    <th width="100">Ulasan</th>
    <td><?php echo htmlentities($result->Review);?></td>
    </tr>


    <?php if($result->Status==1){ ?>

    <?php if(empty($result->MileageBefore)){ ?>

    <form method="POST" action="handle2.php?id=<?php echo htmlentities($result->id);?>">
    <tr>
    <th width="200">Bacaan Awal Odometer</th>
    <td><input type="text" name="mileagebefore" class="form-control white_bg" value="<?php echo htmlentities($result->MileageBefore);?>"></td>
    </tr>
    <tr>
    <th width="200">Bacaan Akhir Odometer</th>
    <td><input type="text" name="mileageafter" class="form-control white_bg" value="<?php echo htmlentities($result->MileageAfter);?>"></td>
    </tr>
    </table>
      <button class="button update" type="submit">Update</button><br><br>
    </form>

    <?php } else {?>

  <tr>
    <th width="200">Bacaan Awal Odometer</th>
    <td><?php echo htmlentities($result->MileageBefore);?></td>
    </tr>
    <tr>
    <th width="200">Bacaan Akhir Odometer</th>
    <td><?php echo htmlentities($result->MileageAfter);?></td>
  </tr>
  </table>

  <?php } ?>


<label>Sila tandakan SOP pemulangan kereta di bawah.</label>

    <?php if(empty($result->SOP)){ ?> 
      <table >
      <form id="form" method="POST">
      <tr>
        <div class="input-group mb-3">
        <div class="input-group-prepend">
        <div class="input-group-text">
          <th><input type="checkbox" name="sop" id="sop" value="1" ></th>
          <td width="900">Kenderaan berada dalam keadaan baik dan bersih.</td>  
            </div>
        </div>
    </div>
      </tr>
    </table>         
     <input type="submit" name="submit" value="Submit"></input><br><br>

        </form>
          <?php } else {?>
            <tr>
              <table>
        <div class="input-group mb-3">
        <div class="input-group-prepend">
        <div class="input-group-text">
            <th><input type="checkbox" name="sop" id="sop" value="1" <?php echo "checked='checked'";?>></th>
          <td width="900">Kenderaan berada dalam keadaan baik dan bersih.</td>
          </div>
        </div>
      </tr>
          </table>
        <?php } ?>
    


  <label>Sila nyatakan baki kad TNG setelah digunakan.</label>

  <table>
    
  <?php if(empty($result->TNG)){ ?>
      <form id="form" action="tngpost.php?id=<?php echo htmlentities($result->id);?>" method="POST">

    <tr>
      <th>Baki TNG:</th>
      <td width="770">RM  <input type="text" name="tng">
      <button type="submit" name="submit2" id="button-addon2">Submit</button>
  </td>
      </form>
  </tr>
      <?php } else {?>
        <tr>
        <th>Baki TNG:</th>
        <td width="770">RM  <?php echo htmlentities($result->TNG);?></td>  
    </tr>
    <?php }} ?>
  </table>


<a class="button back" href="my-booking.php">Back</a>

<hr />

              <?php }} ?>
             
         
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/my-vehicles--> 
<?php include('includes/footer.php');?>

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>
