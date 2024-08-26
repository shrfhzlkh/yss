<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status="2";
$sql = "UPDATE tblbooking SET Status=:status WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('Permohonan tidak diluluskan.');</script>";
echo "<script type='text/javascript'> document.location = 'canceled-bookings.php'; </script>";
}


if(isset($_REQUEST['aeid']))
	{
$aeid=intval($_GET['aeid']);
$status=1;

$sql = "UPDATE tblbooking SET Status=:status WHERE  id=:aeid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('Permohonan telah diluluskan.');</script>";
echo "<script type='text/javascript'> document.location = 'confirmed-bookings.php'; </script>";
}

if(isset($_POST['delete']))
{
	$id=$_GET['bid'];
	$sql = "DELETE FROM tblbooking WHERE id = $id";
	$query = $dbh->prepare($sql);
	$query->execute();
	echo "<script>window.location.href ='all-bookings.php'</script>";
}

if(($_POST['submit1'])){
$id=$_GET['bid'];
$review=$_POST['review'];
$sql = "UPDATE tblbooking SET Review=:review WHERE id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':review',$review,PDO::PARAM_STR);
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
$msg="Review Updated Successfully";
}
 ?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Admin YSS   </title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
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
		</style>

</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Maklumat Permohonan</h2>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Butiran Permohonan</div>
							<div class="panel-body">


<div id="print">
								<table class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%"  >
				
									<tbody>

									<?php 
$bid=intval($_GET['bid']);
$sql = "SELECT tblusers.*,tblvehicles.VehiclesTitle,tblbooking.*,tblbooking.VehicleId as vid,tblotheruser.*, tbldrivers.* from tblbooking LEFT JOIN tblvehicles on tblvehicles.id=tblbooking.VehicleId LEFT JOIN tblusers on tblusers.EmailId=tblbooking.userEmail LEFT JOIN tblotheruser on tblotheruser.Ouser_id=tblbooking.Otheruser_id LEFT JOIN tbldrivers on tbldrivers.Driver_id=tblbooking.Driver where tblbooking.id=:bid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':bid',$bid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
	<h3 style="text-align:center; color:red">No. Permohonan: <?php echo htmlentities($result->BookingNumber);?></h3>

		<tr>
											<th colspan="4" style="text-align:center;color:blue">Maklumat Pemohon</th>
										</tr>
										<tr>
											<th>Nama Pemohon</th>
											<td><?php echo htmlentities($result->FullName);?></td>
											<th>Alamat Emel</th>
											<td><?php echo htmlentities($result->EmailId);?></td>
										</tr>
										<tr>											
											<th>No. Telefon</th>
											<td><?php echo htmlentities($result->ContactNo);?></td>
											<th></th>
											<td></td>

										</tr>
										<tr>
											<th colspan="4" style="text-align:center;color:blue">Maklumat Pengguna</th>
										</tr>
										<tr>
											<th>Nama Pengguna</th>
											<td><?php echo $result->Otheruser_id !== NULL ? htmlentities($result->Ouser_name) : '-';?></td>
											<th>Alamat Emel</th>
											<td><?php echo $result->Otheruser_id !== NULL ? htmlentities($result->Ouser_email) : '-';?></td>
										</tr>
										<tr>											
											<th>No. Telefon</th>
											<td><?php echo $result->Otheruser_id !== NULL ? htmlentities($result->Ouser_tel) : '-';?></td>
											<th></th>
											<td></td>

										</tr>

										<tr>
											<th colspan="4" style="text-align:center;color:blue">Maklumat Permohonan</th>
										</tr>
											<tr>											
											<th>Jenis Kenderaan</th>
											<td><a href="edit-vehicle.php?id=<?php echo htmlentities($result->vid);?>"><?php echo htmlentities($result->VehiclesTitle);?></td>
											<th>Tarikh</th>
											<td><?php echo htmlentities($result->PostingDate);?></td>
										</tr>
										<tr>
											<th>Pergi</th>
											<td><?php echo htmlentities($result->FromDate);?></td>
											<th>Masa Pergi</th>
											<td><?php echo htmlentities($result->FromTime);?></td>
										</tr>
										<tr>
											<th>Balik</th>
											<td><?php echo htmlentities($result->ToDate);?></td>
											<th>Masa Balik</th>
											<td><?php echo htmlentities($result->ToTime);?></td>
										</tr>
										<tr>
											<th>Lokasi</th>
											<td><?php echo htmlentities($result->Location);?></td>
											<th>Tujuan</th>
											<td><?php echo htmlentities($result->Purpose);?></td>
										</tr>
										<tr>
											<th>Pemandu</th>
											<td> 
											<?php if(empty($result->Driver)){ ?>
													<form method="post" action="insert-driver.php?bid=<?php echo htmlentities($result->id);?>" >
													<select type="text" name="driver" class="form-control white_bg" required>
													<option>-Sila Pilih-</option>
														<?php include 'driver-option.php'; ?>
													</select>
													<input type="submit" value="Submit"></input>
													</form>
												<?php } 
												else {?>
												<?php echo htmlentities($result->Driver_name); }?>
											</td>
											<th>Jumlah Penumpang</th>
											<td><?php echo htmlentities($result->PassengerNo);?></td>
										</tr>
										<tr>
											<th>Jenis Perkhidmatan</th>
											<td><?php echo htmlentities($result->TypeService);?></td>
											<th>Tempat Tunggu</th>
											<td><b>Pergi: </b><?php echo htmlentities($result->WaitGo);?>&nbsp <b>Balik: </b><?php echo htmlentities($result->WaitReturn);?></td>
										</tr>

										<tr>
											<th>Bacaan Awal Odometer</th>
											<td><?php echo htmlentities($result->MileageBefore);?></td>
											<th>Bacaan Akhir Odometer</th>
											<td><?php echo htmlentities($result->MileageAfter);?></td>
										</tr>
										<tr>
											<th>Baki TNG</th>
											<td>RM <?php echo htmlentities($result->TNG);?></td>
											<th>SOP</th>
											<td><?php echo htmlentities($result->SOP);?></td>
										</tr>


<tr>
<th>Status Permohonan</th>
<td><?php 
if($result->Status==0)
{
echo htmlentities('Dalam Proses');
} else if ($result->Status==1) {
echo htmlentities('Lulus');
}
 else{
 	echo htmlentities('Tidak Lulus');
 }
										?></td>
										<th>Last Updation Date</th>
										<td><?php echo htmlentities($result->LastUpdationDate);?></td>
									</tr>

									<?php if(empty($result->Review)){ ?>
									<form method="post" >
									<tr>
									<th>Ulasan</th><td colspan="3"><textarea class="form-control" rows="3" name="review" width="100px"><?php echo htmlentities($result->Review);?></textarea><br>
									<input type="submit" name="submit1" value="Submit"></input></td>
									</tr>
									</form>
									<?php } else {?>
										<tr>
									<th>Ulasan</th><td colspan="3"><?php echo htmlentities($result->Review);?><br>
									</tr>
										<?php } ?>


									<?php if($result->Status==0){ ?>
										<tr>	
										<td style="text-align:center" colspan="4">
				<a href="bookig-details.php?aeid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Adakah anda ingin meluluskan permohonan ini?')" class="btn btn-primary"> Lulus</a> 

				<a href="bookig-details.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Adakah anda tidak ingin meluluskan permohonan ini?')" class="btn btn-danger"> Tidak Lulus</a>
</td>
</tr>
<?php } ?>
										
<?php $cnt=$cnt+1; }} ?>
									</tbody>
								</table>
								<form method="post">
	   <input name="Submit2" type="submit" class="txtbox4" value="Print" onClick="return f3();" style="cursor: pointer;"  /><br><br>
	</form>

	<form method="post">   
	<button type="submit" class="txtbox4" name="delete" onClick="return confirm('Do you really want to delete booking?');" >Delete</button>
</td>
</tr>
</form>


							</div>
						</div>

					

					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script language="javascript" type="text/javascript">
function f3()
{
window.print(); 
}
</script>
</body>
</html>
<?php } ?>
