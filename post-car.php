<?php
session_start();
error_reporting(0);
include('includes/config.php');
$idusernow=$_SESSION['usermail'];
if(strlen($_SESSION['login'])==0)
{ 
  header('location:index.php');
}
else{ 
if(isset($_POST['submit']))
  {
    $vehicletitle=$_POST['vehicletitle'];
    $brand=$_POST['brandname'];
    $vehicleoverview=$_POST['vehicalorcview'];
    $priceperday=$_POST['priceperday'];
    $fueltype=$_POST['fueltype'];
    $modelyear=$_POST['modelyear'];
    $seatingcapacity=$_POST['seatingcapacity'];
    $vimage1=$_FILES["img1"]["name"];
    $vimage2=$_FILES["img2"]["name"];
    $vimage3=$_FILES["img3"]["name"];
    $random1 = substr(number_format(time() * rand(),0,'',''),0,10);
    $random2 = substr(number_format(time() * rand(),0,'',''),0,10);
    $random3 = substr(number_format(time() * rand(),0,'',''),0,10);
    $newfilename1= $random1 . $_FILES['ext'];
    $newfilename2= $random2 . $_FILES['ext'];
    $newfilename3= $random3 . $_FILES['ext'];
    /* $temp1 = explode(".", $_FILES["img1"]["name"]);
    $newfilename1 = round(microtime(true)) . '.' . end($temp1);
    $temp2 = explode(".", $_FILES["img2"]["name"]);
    $newfilename2 = round(microtime(true)) . '.' . end($temp2);
    $temp3 = explode(".", $_FILES["img3"]["name"]);
    $newfilename3 = round(microtime(true)) . '.' . end($temp3); */
    $status="1";
    move_uploaded_file($_FILES["img1"]["tmp_name"],"admin/img/vehicleimages/".$newfilename1);
    move_uploaded_file($_FILES["img2"]["tmp_name"],"admin/img/vehicleimages/".$newfilename2);
    move_uploaded_file($_FILES["img3"]["tmp_name"],"admin/img/vehicleimages/".$newfilename3);

    $sql="INSERT INTO tblvehicles(VehiclesTitle,VehiclesBrand,VehiclesOverview,PricePerDay,FuelType,ModelYear,SeatingCapacity,Vimage1,Vimage2,Vimage3,idPemilik,status) VALUES(:vehicletitle,:brand,:vehicleoverview,:priceperday,:fueltype,:modelyear,:seatingcapacity,:vimage1,:vimage2,:vimage3,:idpemilik,:status)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':vehicletitle',$vehicletitle,PDO::PARAM_STR);
    $query->bindParam(':brand',$brand,PDO::PARAM_STR);
    $query->bindParam(':vehicleoverview',$vehicleoverview,PDO::PARAM_STR);
    $query->bindParam(':priceperday',$priceperday,PDO::PARAM_STR);
    $query->bindParam(':fueltype',$fueltype,PDO::PARAM_STR);
    $query->bindParam(':modelyear',$modelyear,PDO::PARAM_STR);
    $query->bindParam(':seatingcapacity',$seatingcapacity,PDO::PARAM_STR);
    $query->bindParam(':vimage1',$newfilename1,PDO::PARAM_STR);
    $query->bindParam(':vimage2',$newfilename2,PDO::PARAM_STR);
    $query->bindParam(':vimage3',$newfilename3,PDO::PARAM_STR);
    $query->bindParam(':idpemilik',$idusernow,PDO::PARAM_STR);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
      $_SESSION['msg']="Vehicle posted successfully";
    }
    else 
    {
      $_SESSION['error']="Something went wrong. Please try again";
    }

  }

  

?>
  <!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Sewa.in | My Profile</title>
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

<link href="assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
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

<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 
<!--Page Header-->
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Post A Car</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>Post a Car</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 


<?php 
$useremail=$_SESSION['login'];
$sql = "SELECT * from tblusers where EmailId=:useremail";
$query = $dbh -> prepare($sql);
$query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<section class="user_profile inner_pages">
  <div class="container">
    <div class="user_profile_info gray-bg padding_4x4_40">
      <div class="upload_user_logo"><img src="assets/userphotos/<?php echo htmlentities($result->photo);?>" alt="image" width="150" height="150">
      </div>

      <div class="dealer_info">
        <h5><?php echo htmlentities($result->FullName);?></h5>
        <p><?php echo htmlentities($result->Address);?>
          <p>
          <?php 
            if($result->tipe==1){
              echo "Pemilik Kendaaran";
            }
            else{
              echo "Pengguna Kendaraan";
            }
          ?><br>
          <?php echo htmlentities($result->City);?>&nbsp;<?php echo htmlentities($result->Country);?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-sm-3">
        <?php include('includes/sidebar.php');?> <?php }}?>
      <div class="col-md-6 col-sm-8">
        <div class="profile_wrap">
          <?php if(isset($_POST['submit']))

              {?>

                <div class="alert alert-success">
                  <button type="button" id="demoNotify" class="close" data-dismiss="alert">×</button>
                  <strong>Well done!</strong> <?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['error']="");?>
                </div>
              <?php } ?>
              
          <form method="post" enctype="multipart/form-data"  >
                <h3 class="tile-title">Post Your Car</h3>
                <br/>
                <div class="row">
                  <div class="col-6">
                    <input type="text" class="form-control white_bg" name="vehicletitle" placeholder="Nama Kendaraan" required="">
                  </div>
                  <div class="col-6">
                    <select name="brandname" class="form-control white_bg" required="">
                      <option value=""> Nama Brand Kendaraan </option>
                      <?php $ret="select id,BrandName from tblbrands";
                      $query= $dbh -> prepare($ret);
                      $query-> execute();
                      $results = $query -> fetchAll(PDO::FETCH_OBJ);
                      if($query -> rowCount() > 0)
                      {
                        foreach($results as $result)
                        {
                          ?>
                          <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?></option>
                        <?php }} ?>

                      </select>
                    </div>
                  </div>
                  <br/>
                  <div class="row">
                    <div class="col-6">
                      <input type="text" class="form-control white_bg" name="priceperday" placeholder="Harga Sewa Perhari (Rp)" required="">
                    </div>
                    <div class="col-6">
                      <select class="form-control white_bg" name="fueltype" required>
                        <option value=""> Tipe Bensin Kendaraan </option>

                        <option value="Bensin">Bensin</option>
                        <option value="Diesel">Diesel</option>
                      </select>
                    </div>
                  </div>
                  <br/>
                  <div class="row">
                    <div class="col-6">
                      <input type="text" class="form-control white_bg" name="modelyear" placeholder="Tahun Model Kendaraan" required="">
                    </div>
                    <br />
                    <div class="col-6">
                      <input type="text" class="form-control white_bg" name="seatingcapacity" placeholder="Kapasitas Duduk" required="">
                    </div>
                  </div>
                  <br/>
                  <div class="row">
                    <div class="col-12">
                      <textarea class="form-control white_bg" name="vehicalorcview" rows="5" placeholder="Ringkasan Kendaaran" required=""></textarea>
                    </div>
                  </div>
                  <br/>
                  <h5 class="tile-title">Upload Gambar</h5>

                  <div class="row">
                    <div class="col-4">
                      <input type="file" class="form-control white_bg" name="img1" required="">
                    </div>
                    <div class="col-4">
                      <input type="file" class="form-control white_bg" name="img2" required="">
                    </div>
                    <div class="col-4">
                      <input type="file" class="form-control white_bg" name="img3" required="">
                    </div>
                  </div>
                  <br>
                </br>
                  <div class="form-group">
                    <button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Published</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-Danger" type="reset"><i class="fa fa-fw fa-lg fa-check-circle"></i> Cancel</button>
                  </div>
                </form>
              </div>
      </div>
    </div>
  </div>
</section>

<!--/Profile-setting--> 

<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>
<!--/Forgot-password-Form --> 

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

    <script type="text/javascript" src="assets/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
</script>


<script>
       $(document).ready(function() {
        $('#example').DataTable( {
          dom: 'Bfrtip',
          buttons: [
          'colvis'
          ]
        } );
      } );
    </script>

</body>
</html>
<?php } ?>