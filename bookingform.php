<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>YSS</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/logoyss.jpg">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
<link href="assets/css/style.css?v=<?php echo time();?>" rel="stylesheet">
<style>
    .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
#form-container {
  display: none;
}
    </style>


</head>
<body>
        
<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Form-->
<?php 
$id=intval($_GET['id']);
$sql = "SELECT tblusers.FullName,tblusers.ContactNo,tblbooking.BookingNumber,tblvehicles.VehiclesTitle,tblbooking.FromDate,tblbooking.FromTime,tblbooking.ToDate,tblbooking.ToTime,tblbooking.VehicleId as vid,tblbooking.id  from tblbooking join tblvehicles on tblvehicles.id=tblbooking.VehicleId join tblusers on tblusers.EmailId=tblbooking.userEmail where tblbooking.id=$id ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{				
?>	

<section class="section-padding">
  <div class="container">

  <h3>No Permohonan: <?php echo htmlentities($result->BookingNumber);?></h3>
  <label>Sila isi borang di bawah untuk membuat permohonan.</label>

	  <div class="contact_form gray-bg">

<form id="outerForm" method="POST" action="handle.php">
<input type="hidden" class="form-control" name="id" value="<?php echo $id ?>" >

<div class="form-horizontal">
<div class="mb-3 row">
    <label for="category" class="col-sm-2 col-form-label">Kategori Permohonan: </label>
    <div class="col-sm-10">
  
    <input type="radio" name="radio" id="sendiri" value="sendiri" onclick="disableForm()">
   <label> Permohonan Sendiri </label><br>
  
   <input type="radio" name="radio" id="lain" value="lain" onclick="disableForm()">
   <label for="lain">Permohonan Lain</label>
</div>
  </div>
<div class="mb-3 row">
    <label for="fname" class="col-sm-2 col-form-label">Nama Pemohon: </label>
    <div class="col-sm-10">
      <p type="text" name="fname" readonly class="form-control-plaintext" ><?php echo htmlentities($result->FullName);?></p>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="contactno" class="col-sm-2 col-form-label">No. Telefon: </label>
    <div class="col-sm-10">
      <p type="text" name="contactno" readonly class="form-control-plaintext" ><?php echo htmlentities($result->ContactNo);?></p>
    </div>
  </div>
  <div id="innerFormContainer">
   <form id="innerForm">
      <div class="mb-3 row">
      <label for="name" class="col-sm-2 col-form-label">Nama Pengguna: </label>
      <div class="col-sm-10">
        <input type="text" name="ousername" class="form-control white_bg">
      </div>
    </div>
    <div class="mb-3 row">
      <label for="tel" class="col-sm-2 col-form-label">No. Telefon Pengguna: </label>
      <div class="col-sm-10">
        <input type="text" name="ousertel" class="form-control white_bg">
      </div>
    </div>
    <div class="mb-3 row">
      <label for="email" class="col-sm-2 col-form-label">Alamat Emel Pengguna: </label>
      <div class="col-sm-10">
        <input type="text" name="ouseremail" class="form-control white_bg">
      </div>
    </div>
  </form>
</div>


<div class="mb-3 row">
    <label for="vehicle" class="col-sm-2 col-form-label">Jenis Kenderaan: </label>
    <div class="col-sm-10">
      <p type="text" name="vehicle" readonly class="form-control-plaintext" ><?php echo htmlentities($result->VehiclesTitle);?></p>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="fromdate" class="col-sm-2 col-form-label">Pergi (Tarikh/Masa): </label>
    <div class="col-sm-10">
      <p type="text" name="fromdate" readonly class="form-control-plaintext" ><?php echo htmlentities($result->FromDate);?> <?php echo htmlentities($result->FromTime);?></p>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="todate" class="col-sm-2 col-form-label">Balik (Tarikh/Masa): </label>
    <div class="col-sm-10">
      <p type="text" name="todate" readonly class="form-control-plaintext" ><?php echo htmlentities($result->ToDate);?> <?php echo htmlentities($result->ToTime);?></p>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="location" class="col-sm-2 col-form-label">Lokasi: </label>
    <div class="col-sm-10">
      <input type="text" class="form-control white_bg" name="location" required>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="purpose" class="col-sm-2 col-form-label">Tujuan: </label>
    <div class="col-sm-10">
      <input type="text" name="purpose" class="form-control white_bg" required>
    </div>
  </div>
  
  <div class="mb-3 row">
    <label for="passengerno" class="col-sm-2 col-form-label">Jumlah Penumpang: </label>
    <div class="col-sm-10">
      <select type="text" name="passengerno" class="form-control white_bg">
      <option>0</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
      <option>7</option>
      <option>8</option>
      </select>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="typeservice" class="col-sm-2 col-form-label">Jenis Perkhidmatan: </label>
    <div class="col-sm-10">
      <select type="text" name="typeservice" class="form-control white_bg" required>
      <option>-Sila Pilih-</option>
      <option>Hantar Sahaja</option>
      <option>Jemput Sahaja</option>
      <option>Hantar dan Jemput</option>
      <option>Hantar Setiap Hari</option>
      <option>Jemput Setiap Hari</option>
      <option>Hantar dan Jemput Setiap Hari</option>
      <option>Sepanjang Program</option>
  </select>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="wait" class="col-sm-2 col-form-label">Tempat Tunggu: </label>
    <div class="col-sm-10">
      <input type="text" name="waitgo" class="form-control white_bg" placeholder="Pergi" required>
      <input type="text" name="waitreturn" class="form-control white_bg" placeholder="Balik" required>

    </div>
  </div>


<button type="submit" class="btn btn-primary me-md-2" >Hantar</button>
<a href="cancel.php?id=<?php echo htmlentities($result->id);?>" class="btn btn-primary me-md-2" onclick="return confirm('Do you really want to cancel this booking?')">Batal</a>

</div>
</form>

    </div>
  </div>
</section>

<?php } }?>
<!-- /Form --> 

<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<?php
/*
<script>
function showForm() {
  var formContainer = document.getElementById("form-container");
  var lainRadioButton = document.getElementById("lain");

  if (lainRadioButton.checked) {
    formContainer.style.display = "block";
  } else {
    formContainer.style.display = "none";
  }
}
function showForm() {
  var formContainer = document.getElementById("form-container");
  var sendiriRadioButton = document.getElementById("sendiri");

  if (sendiriRadioButton.checked) {
    formContainer.style.display = "none";
  } else {
    formContainer.style.display = "block";
  }
}
</script>
*/
?>

<script>
  function disableForm() {
    var innerFormContainer = document.getElementById("innerFormContainer");
    var sendiri = document.getElementById("sendiri");
    var lain = document.getElementById("lain");

    if (sendiri.checked) {
      innerFormContainer.style.display = "none";
    } else if (lain.checked) {
      innerFormContainer.style.display = "block";
    }
  }
</script>



<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
