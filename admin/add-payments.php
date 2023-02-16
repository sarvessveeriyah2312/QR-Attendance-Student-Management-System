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
 $studentid=$_POST['studentid'];
 $feesname=$_POST['feesname'];
 $status=$_POST['status'];
 $amount=$_POST['amount'];

$sql="insert into tblpayments(Transaction_ID,StudentName,StuID,FeesName,Status,Amount)values(:transid,:studentname,:studentid,:feesname,:status,:amount)";
$query=$dbh->prepare($sql);
$query->bindParam(':transid',$transid,PDO::PARAM_STR);
$query->bindParam(':studentname',$studentname,PDO::PARAM_STR);
$query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
$query->bindParam(':feesname',$feesname,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':amount',$amount,PDO::PARAM_STR);
 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Invoice Issued.")</script>';
echo "<script>window.location.href ='add-payments.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Student Monitoring System | Issue Invoice</title>
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
              <h3 class="page-title"> Issue Invoice </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Issue Invoice</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Issue Invoice</h4>
                   
                    <form class="forms-sample" method="post">
                      
                    <div class="form-group">
                        <label for="exampleInputName1">Transaction_ID</label>
                        <input type="text" name="transid" value="" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Student Name</label>
                        <select  name="studentname" class="form-control" required='true'>
                          <option value="">Select Student</option>
                         <?php 

$sql2 = "SELECT * from  tblstudent ";
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
                        <label for="exampleInputEmail3">Student ID</label>
                        <select  name="studentid" class="form-control" required='true'>
                          <option value="">Select Student ID</option>
                         <?php 

$sql2 = "SELECT * from  tblstudent ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row1)
{          
    ?>  
<option value="<?php echo htmlentities($row1->StuID);?>"><?php echo htmlentities($row1->StudentName);?> - <?php echo htmlentities($row1->StuID);?></option>
 <?php } ?> 
                        </select>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputEmail3">Fees Name</label>
                        <select  name="feesname" class="form-control" required='true'>
                          <option value="">Select Fees</option>
                         <?php 

$sql2 = "SELECT * from  tblfees ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row1)
{          
    ?>  
<option value="<?php echo htmlentities($row1->FeesName);?>"><?php echo htmlentities($row1->FeesName);?> Amount: RM<?php echo htmlentities($row1->Amount);?></option>
 <?php } ?> 
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Status</label>
                        <select  name="status" class="form-control" required='true'>
                          <option value="">Choose Payment Status</option>
                          <option value="Unpaid">Unpaid</option>
                          <option value="Paid">Paid</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail3">Select Amount</label>
                        <select  name="amount" class="form-control" required='true'>
                          <option value="">Select Fees</option>
                         <?php 

$sql2 = "SELECT * from  tblfees ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row1)
{          
    ?>  
<option type="number" value="<?php echo htmlentities($row1->Amount);?>"><?php echo htmlentities($row1->FeesName);?> Amount: RM<?php echo htmlentities($row1->Amount);?></option>
 <?php } ?> 
                        </select>
                      </div>
                      
                      <button type="submit" class="btn btn-primary mr-2" name="submit">Add Fees</button>
                     
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
