<?php
session_start();
error_reporting(0);
// error_reporting(E_ALL);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
  header('location:logout.php');
  } else{
   if(isset($_POST['submit']))
  {
 $stuname=$_POST['stuname'];
 $assname=$_POST['assname'];
 $chapter=$_POST['chapter'];
 $progress=$_POST['progress'];
 $eid=$_GET['editid'];
$sql="update tblprogress set StudentName=:stuname,AssignmentName=:assname,Chapter=:chapter,Progress=:progress where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':stuname',$stuname,PDO::PARAM_STR);
$query->bindParam(':assname',$assname,PDO::PARAM_STR);
$query->bindParam(':chapter',$chapter,PDO::PARAM_STR);
$query->bindParam(':progress',$progress,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Progress has been updated.")</script>';
echo "<script>window.location.href ='manage-progress.php'</script>";
  }
  else
    {
         echo '<script>alert("Progress has been updated.")</script>';
         echo "<script>window.location.href ='manage-progress.php'</script>";
    }
}
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Student Monitoring System | Update Progress</title>
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
              <h3 class="page-title">  Update Progress </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">  Update Progress</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;"> Update Progress</h4>
                   
                    <form class="forms-sample" method="post">
                    <?php
                    $eid=$_GET['editid'];
$sql="SELECT * FROM tblprogress where ID=:eid";
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
                          <label for="exampleInputName1">Class Name</label>
                          <input type="text" name="stuname" value="<?php  echo htmlentities($row->ClassName);?>" class="form-control" required='true' readonly>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Assignment Name</label>
                          <input type="text" name="assname" value="<?php  echo htmlentities($row->AssignmentName);?>" class="form-control" required='true'readonly>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Chapter</label>
                          <input type="text" name="chapter" value="<?php  echo htmlentities($row->Chapter);?>" class="form-control" required='true'readonly>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Progress</label>
                          <input type="number" name="progress" value="<?php  echo htmlentities($row->Progress);?>" class="form-control" required='true'>
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
<?php }  ?>
<?php }  ?>