<?php
session_start();
error_reporting(E_ALL);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
  header('location:logout.php');
  } else{
   if(isset($_POST['submit']))
  {
    $transid=$_POST['transid'];
 $studentname=$_POST['studentname'];
 $feesname=$_POST['feesname'];
 $status=$_POST['status'];
 $amount=$_POST['amount'];
 $eid=$_GET['editid'];

$sql="update tblpayments set Transaction_ID=:transid,StudentName=:studentname,FeesName=:feesname,Status=:status,Amount=:amount where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':transid',$transid,PDO::PARAM_STR);
$query->bindParam(':studentname',$studentname,PDO::PARAM_STR);
$query->bindParam(':feesname',$feesname,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':amount',$amount,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();
  echo '<script>alert("Payment has been updated")</script>';
  echo "<script>window.location.href = 'manage-payments.php'</script>";  
}

  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Student Monitoring System | Manage Payments</title>
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
              <h3 class="page-title"> Manage Payments </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Manage Payments</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Manage Payments</h4>
                   
                    <form class="forms-sample" method="post">
                      <?php
$eid=$_GET['editid'];
$sql="SELECT * from tblpayments where id=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>  
                      <div class="form-group">
                        <label for="exampleInputName1">Transaction ID</label>
                        <input type="text" name="transid" value="<?php  echo htmlentities($row->Transaction_ID);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Student Name</label>
                        <input type="text" name="studentname" value="<?php  echo htmlentities($row->StudentName);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Fees Name</label>
                        <input type="text" name="feesname" value="<?php  echo htmlentities($row->FeesName);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Status</label>
                        <select  name="status" class="form-control" required='true'>
                          <option value="<?php  echo htmlentities($row->Status);?>"><?php  echo htmlentities($row->Status);?></option>
                          <option value="Unpaid">Unpaid</option>
                          <option value="Pending">Pending</option>
                          <option value="Paid">Paid</option>
                        </select>
                      </div><?php $cnt=$cnt+1;}} ?>
                      <div class="form-group">
                        <label for="exampleInputName1">Fees Amount</label>
                        <input type="number" name="amount" value="<?php  echo htmlentities($row->Amount);?>" class="form-control" required='true'>
                      </div>
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
