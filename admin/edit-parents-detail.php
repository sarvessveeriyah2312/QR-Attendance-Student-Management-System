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
    $OccupationF=$_POST['OccupationF'];
    $OccupationM=$_POST['OccupationM'];
    $Email=$_POST['Email'];
    $NumberF=$_POST['NumberF'];
    $NumberM=$_POST['NumberM'];
    $uname=$_POST['uname'];
  $password=md5($_POST['password']);
 $eid=$_GET['editid'];
$sql="update tblparents set NameFather=:NameF,NameMother=:NameM,Address=:Address,ChildName=:ChildName,OccupationF=:OccupationF,OccupationM=:OccupationM,Email=:Email,NumberF=:NumberF,NumberM=:NumberM,UserName=:uname,Password=:password where PID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':NameF',$NameF,PDO::PARAM_STR);
$query->bindParam(':NameM',$NameF,PDO::PARAM_STR);
$query->bindParam(':Address',$Address,PDO::PARAM_STR);
$query->bindParam(':ChildName',$ChildName,PDO::PARAM_STR);
$query->bindParam(':OccupationF',$OccupationF,PDO::PARAM_STR);
$query->bindParam(':OccupationM',$OccupationM,PDO::PARAM_STR);
$query->bindParam(':Email',$Email,PDO::PARAM_STR);
$query->bindParam(':NumberF',$NumberF,PDO::PARAM_STR);
$query->bindParam(':NumberM',$NumberM,PDO::PARAM_STR);
$query->bindParam(':uname',$uname,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();
  echo '<script>alert("Parents has been updated")</script>';
}

  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Student  Monitoring System | Update Parents</title>
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
              <h3 class="page-title"> Update Parents</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Update Parents</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Update Parents</h4>
                   
                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                      <?php
$eid=$_GET['editid'];
$sql="SELECT * from tblparents where PID=:eid";
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
                        <label for="exampleInputName1">Father Name</label>
                        <input type="text" name="NameF" value="<?php  echo htmlentities($row->NameFather);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Mother Name</label>
                        <input type="text" name="NameM" value="<?php  echo htmlentities($row->NameMother);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Address</label>
                        <input type="text" name="Address" value="<?php  echo htmlentities($row->Address);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Student Name</label>
                        <select  name="ChildName" class="form-control" required='true'>
                          <option value="<?php  echo htmlentities($row->ChildName);?>" >Select Student</option>
                         <?php 

$sql2 = "SELECT * from tblstudent ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row1)
{          
    ?>  
<option value="<?php echo htmlentities($row1->StudentName);?>"><?php echo htmlentities($row1->StudentName);?></option>
 <?php } ?> 
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Father Occupation</label>
                        <input type="text" name="OccupationF" value="<?php  echo htmlentities($row->OccupationF);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Mother Occupation</label>
                        <input type="text" name="OccupationM" value="<?php  echo htmlentities($row->OccupationM);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Email</label>
                        <input type="text" name="Email" value="<?php  echo htmlentities($row->Email);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Father Number</label>
                        <input type="text" name="NumberF" value="<?php  echo htmlentities($row->NumberF);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Mother Number</label>
                        <input type="text" name="NumberM" value="<?php  echo htmlentities($row->NumberM);?>" class="form-control" required='true'>
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