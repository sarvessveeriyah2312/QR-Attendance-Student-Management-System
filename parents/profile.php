<?php
session_start();
error_reporting(E_ALL);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $NameF=$_POST['NameF'];
    $NameM=$_POST['NameM'];
    $Address=$_POST['Address'];
    $ChildName=$_POST['ChildName'];
    $StuID=$_POST['StuID'];
    $OccupationF=$_POST['OccupationF'];
    $OccupationM=$_POST['OccupationM'];
    $Email=$_POST['Email'];
    $NumberF=$_POST['NumberF'];
    $NumberM=$_POST['NumberM'];
    $uname=$_POST['uname'];
  $password=md5($_POST['password']);
  $adminid=$_SESSION['sturecmsaid'];
  $sql="update tblparents set NameFather=:NameF,NameMother=:NameM,Address=:Address,ChildName=:ChildName,StuID=:StuID,OccupationF=:OccupationF,OccupationM=:OccupationM,Email=:Email,NumberF=:NumberF,NumberM=:NumberM,UserName=:uname,Password=:password where PID=:aid";
     $query = $dbh->prepare($sql);
     $query->bindParam(':NameF',$NameF,PDO::PARAM_STR);
     $query->bindParam(':NameM',$NameM,PDO::PARAM_STR);
     $query->bindParam(':Address',$Address,PDO::PARAM_STR);
     $query->bindParam(':ChildName',$ChildName,PDO::PARAM_STR);
     $query->bindParam(':StuID',$StuID,PDO::PARAM_STR);
     $query->bindParam(':OccupationF',$OccupationF,PDO::PARAM_STR);
     $query->bindParam(':OccupationM',$OccupationM,PDO::PARAM_STR);
     $query->bindParam(':Email',$Email,PDO::PARAM_STR);
     $query->bindParam(':NumberF',$NumberF,PDO::PARAM_STR);
     $query->bindParam(':NumberM',$NumberM,PDO::PARAM_STR);
     $query->bindParam(':uname',$uname,PDO::PARAM_STR);
     $query->bindParam(':password',$password,PDO::PARAM_STR);
     $query->bindParam(':aid',$adminid,PDO::PARAM_STR);
     $query->execute();

    echo '<script>alert("Your profile has been updated")</script>';
    echo "<script>window.location.href ='profile.php'</script>";

  }
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Student  Monitoring System | Profile</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css" />
    
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
     <?php include_once('includes/header.php');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
      <?php include_once('includes/sidebar.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Parents Profile </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Parents Profile</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Parents Profile</h4>
                   
                    <form class="forms-sample" method="post">
                      <?php
$sid=$_SESSION['sturecmsaid'];
$sql="SELECT * from  tblparents where PID= :sid";
$query = $dbh -> prepare($sql);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                      <div class="form-group">
                        <label for="exampleInputName1">Father Name</label>
                        <input type="text" name="NameF" value="<?php  echo $row->NameFather;?>" class="form-control" readonly="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Mother Name</label>
                        <input type="text" name="NameM" value="<?php  echo $row->NameMother;?>" class="form-control" readonly="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Address</label>
                        <input type="text" name="Address" value="<?php  echo $row->Address;?>" class="form-control" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Children Name</label>
                        <input type="text" name="ChildName" value="<?php  echo $row->ChildName;?>" class="form-control" readonly="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Student ID</label>
                        <input type="text" name="StuID" value="<?php  echo $row->StuID;?>" class="form-control" readonly="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Father's Occupation</label>
                        <input type="text" name="OccupationF" value="<?php  echo $row->OccupationF;?>" class="form-control" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Mother's Occupation</label>
                        <input type="text" name="OccupationM" value="<?php  echo $row->OccupationM;?>" class="form-control" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Email</label>
                        <input type="text" name="Email" value="<?php  echo $row->Email;?>"  class="form-control" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Father's Number</label>
                        <input type="text" name="NumberF" value="<?php  echo $row->NumberF;?>" class="form-control" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputCity1">Mother's Number</label>
                         <input type="text" name="NumberM" value="<?php  echo $row->NumberM;?>" class="form-control" >
                      </div>
                      <h3>Login details</h3>
<div class="form-group">
                        <label for="exampleInputName1">User Name</label>
                        <input type="text" name="uname" value="<?php  echo htmlentities($row->UserName);?>" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Password</label>
                        <input type="Password" name="password" value="<?php  echo htmlentities($row->Password);?>" class="form-control">
                      </div><?php $cnt=$cnt+1;}} ?> 
                      <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
                     
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
         <?php include_once('includes/footer.php');?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/select2/select2.min.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
    <!-- End custom js for this page -->
  </body>
</html><?php }  ?>