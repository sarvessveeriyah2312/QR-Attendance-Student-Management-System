<?php
session_start();
error_reporting(E_ALL);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
  header('location:logout.php');
  } else{
   if(isset($_POST['submit']))
  {
 $name=$_POST['name'];
 $address=$_POST['address'];
 $age=$_POST['age'];
 $email=$_POST['email'];
 $number=$_POST['number'];
 $icnumber=$_POST['icnumber'];
  $uname=$_POST['uname'];
  $password=md5($_POST['password']);
 $eid=$_GET['editid'];
$sql="update tblteacher set Name=:name,Address=:address,Age=:age,Email=:email,Number=:number,ICNumber=:icnumber,UserName=:uname,Password=:password where TID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':age',$age,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':number',$number,PDO::PARAM_STR);
$query->bindParam(':icnumber',$icnumber,PDO::PARAM_STR);
$query->bindParam(':uname',$uname,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();
  echo '<script>alert("Teacher has been updated")</script>';
}

  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Student  Monitoring System | Update Students</title>
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
              <h3 class="page-title"> Update Teacher </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Update Teacher</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Update Teacher</h4>
                   
                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                      <?php
$eid=$_GET['editid'];
$sql="SELECT * from tblteacher where TID=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                      <div class="form-group">
                        <label for="exampleInputName1">Teacher Name</label>
                        <input type="text" name="name" value="<?php  echo htmlentities($row->Name);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Address</label>
                        <input type="text" name="address" value="<?php  echo htmlentities($row->Address);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Age</label>
                        <input type="text" name="age" value="<?php  echo htmlentities($row->Age);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Email</label>
                        <input type="text" name="email" value="<?php  echo htmlentities($row->Email);?>" class="form-control" required='true'>
                      </div>
                     
                      <div class="form-group">
                        <label for="exampleInputName1">Phone Number</label>
                        <input type="text" name="number" value="<?php  echo htmlentities($row->Number);?>" class="form-control" required='true' >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">IC Number</label>
                        <input type="text" name="icnumber" value="<?php  echo htmlentities($row->ICNumber);?>" class="form-control" required='true'>
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