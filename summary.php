<?php
session_start();
error_reporting(0);
include('includes/config.php');
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
        <h1>Permohonan</h1>
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
 $sql = "SELECT tblvehicles.Vimage1 as Vimage1,tblvehicles.VehiclesTitle,tblvehicles.id as vid,tblusers.FullName,tblusers.ContactNo,tblbooking.FromDate,tblbooking.FromTime,tblbooking.ToDate,tblbooking.ToTime,tblbooking.Location,tblbooking.Purpose,tblbooking.Driver,tblbooking.PassengerNo,tblbooking.Status,tblbooking.BookingNumber,tblbooking.TypeService,tblbooking.WaitGo,tblbooking.WaitReturn,tblotheruser.*,tbldrivers.*  from tblbooking left join tblvehicles on tblbooking.VehicleId=tblvehicles.id left join tblusers on tblusers.EmailId=tblbooking.userEmail left join tblotheruser on tblotheruser.Ouser_id=tblbooking.Otheruser_id left join tbldrivers on tbldrivers.Driver_id=tblbooking.Driver where tblbooking.id=:id";
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
    <h4 style="color:red">No Permohonan: <?php echo htmlentities($result->BookingNumber);?></h4>
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
    <th width="100">Jenis Perkhidmatan</th>
    <td><?php echo htmlentities($result->TypeService);?></td>
    </tr>
    <tr>
    <th width="100">Jumlah Penumpang</th>
    <td><?php echo htmlentities($result->PassengerNo);?></td>
    </tr>
    <tr>
    <th width="100">Tempat Menunggu</th>
    <td><b>Pergi: </b><?php echo htmlentities($result->WaitGo);?>&nbsp;&nbsp; <b>Balik: </b><?php echo htmlentities($result->WaitReturn);?></td>
    </tr>
</table>
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
