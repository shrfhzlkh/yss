<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_POST['update']))
{
$fname=$_POST['fullname'];
$position=$_POST['position'];
$email=$_POST['emailid']; 
$mobile=$_POST['mobileno'];
$image=$_FILES["image"]["name"];
$id=intval($_GET['id']);
move_uploaded_file($_FILES["image"]["tmp_name"],"img/user/".$_FILES["image"]["name"]);
$sql="update tblusers set FullName=:fname,Position=:position,EmailId=:email,ContactNo=:mobile,Image=:image where id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':position',$position,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':image',$image,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
header('location:reg-users.php');

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
	
	<title>Admin YSS  </title>

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
button {
	float: right;
	background: #607595;
	padding: 10px 15px;
	color: #fff;
	border-radius: 5px;
	margin-right: 10px;
	border: none;
}

		</style>

</head>


<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Kemaskini Profil Pengguna</h2>

                        <?php 
$id=intval($_GET['id']);
$sql ="SELECT * from tblusers where id=:id";
$query = $dbh -> prepare($sql);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

            <div class="col-md-12 col-sm-6">
              <form  method="post" name="signup" onSubmit="return valid();" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Nama Penuh</label>
                  <input type="text" class="form-control" name="fullname" value="<?php echo htmlentities($result->FullName)?>" required="required">
                </div>
                <div class="form-group">
                  <label>Jawatan</label>
                  <input type="text" class="form-control" name="position" value="<?php echo htmlentities($result->Position)?>" required="required">
                </div>
                  <div class="form-group">
                    <label>Nombor Telefon</label>
                  <input type="text" class="form-control" name="mobileno" value="<?php echo htmlentities($result->ContactNo)?>" maxlength="12" required="required">
                </div>
                <div class="form-group">
                <label>Alamat Emel</label>
                  <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" value="<?php echo htmlentities($result->EmailId)?>" required="required">
                   <span id="user-availability-status" style="font-size:12px;"></span> 
                </div>
                <div class="form-group">
                <label>Muat Naik Gambar</label>
                  <input type="file" class="form-control" name="image" required="required">
                </div>
                <div class="form-group">
                <div class="col-sm-2 col-sm-offset-5">
                  <div class="pb-5">
                  <button type="submit" value="Update" name="update" id="submit" class="btn btn-block">Kemaskini</button><br><br>
                </div>
                </div>
                <a href="reg-users.php" class="btn btn-danger">Batal</a><br><br>
                </div>
              </form>
            </div>

	<!-- Loading Scripts -->
    <script>
    // Get a reference to our file input
    const fileInput = document.querySelector('input[type="file"]');

    // Create a new File object
    const myFile = new File(['Hello World!'], '<?php echo htmlentities($result->Image)?>', {
        type: 'text/plain',
        lastModified: new Date(),
    });

    // Now let's create a DataTransfer to get a FileList
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(myFile);
    fileInput.files = dataTransfer.files;
</script>
<?php }} ?>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>

<?php } ?>
