<?php
session_start();
error_reporting(E_ALL);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $adminid=$_SESSION['sturecmsaid'];
    $AName=$_POST['adminname'];
    $address=$_POST['address'];
    $age=$_POST['age'];
    $email=$_POST['email'];
  $mobno=$_POST['mobilenumber'];
  $icnumber=$_POST['icnumber'];
  $uname=$_POST['uname'];
  $sql="update tblteacher set Name=:adminname,Address=:address,Age=:age,Email=:email,Number=:mobilenumber,ICNumber=:icnumber,UserName=:uname where TID=:aid";
     $query = $dbh->prepare($sql);
     $query->bindParam(':adminname',$AName,PDO::PARAM_STR);
     $query->bindParam(':address',$address,PDO::PARAM_STR);
     $query->bindParam(':age',$age,PDO::PARAM_STR);
     $query->bindParam(':email',$email,PDO::PARAM_STR);
     $query->bindParam(':mobilenumber',$mobno,PDO::PARAM_STR);
     $query->bindParam(':icnumber',$icnumber,PDO::PARAM_STR);
     $query->bindParam(':uname',$uname,PDO::PARAM_STR);
     $query->bindParam(':aid',$adminid,PDO::PARAM_STR);
$query->execute();

    echo '<script>alert("Your profile has been updated")</script>';
    echo "<script>window.location.href ='profile.php'</script>";

  }
}
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Student  Monitoring System | Teacher Profile</title>
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
              <h3 class="page-title"> Teacher Profile </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Teacher Profile</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Teacher Profile</h4>
                   
                    <form class="forms-sample" method="post">
                      <?php
$sid=$_SESSION['sturecmsaid'];
$sql="SELECT * from  tblteacher where TID= :sid";
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
                        <label for="exampleInputName1">Name</label>
                        <input type="text" name="adminname" value="<?php  echo $row->Name;?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Address</label>
                        <input type="text" name="address" value="<?php  echo $row->Address;?>" class="form-control" readonly="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Age</label>
                        <input type="text" name="age" value="<?php  echo $row->Age;?>" class="form-control" readonly="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputCity1">Email</label>
                         <input type="email" name="email" value="<?php  echo $row->Email;?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Contact Number</label>
                        <input type="text" name="mobilenumber" value="<?php  echo $row->Number;?>"  class="form-control" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">IC Number</label>
                        <input type="text" name="icnumber" value="<?php  echo $row->ICNumber;?>" class="form-control" readonly="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Username</label>
                        <input type="text" name="uname" value="<?php  echo $row->UserName;?>" class="form-control" readonly="">
                      </div>
                      <?php } ?>
                      <?php } ?>
                     
                     
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
</html>
