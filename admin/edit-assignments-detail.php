<?php
session_start();
error_reporting(0);
error_reporting(E_ALL);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
  header('location:logout.php');
  } else{
   if(isset($_POST['submit']))
  {
    $Course=$_POST['Course'];
    $Subject=$_POST['Subject'];
    $AssignC=$_POST['AssignC'];
    $AssigN=$_POST['AssigN'];
    $Chapter=$_POST['Chapter'];
 $eid=$_GET['editid'];
 $sql="update tblassignments set Course=:Course,Subject=:Subject,AssignmentCode=:AssignC,AssignmentName=:AssigN,Chapter=:Chapter where ID=:eid";
 $query=$dbh->prepare($sql);
 $query->bindParam(':Course',$Course,PDO::PARAM_STR);
 $query->bindParam(':Subject',$Subject,PDO::PARAM_STR);
 $query->bindParam(':AssignC',$AssignC,PDO::PARAM_STR);
 $query->bindParam(':AssigN',$AssigN,PDO::PARAM_STR);
 $query->bindParam(':Chapter',$Chapter,PDO::PARAM_STR);
 $query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();
  echo '<script>alert("Assignment has been updated")</script>';
  echo "<script>window.location.href = 'manage-assignments.php'</script>"; 
}
}

  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Student Monitoring System | Update Syllabus</title>
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
              <h3 class="page-title"> Update Syllabus </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Update Syllabus</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Update Syllabus</h4>
                   
                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                      <?php
$eid=$_GET['editid'];
$sql="SELECT * FROM tblassignments where ID=:eid";
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
                          <label for="exampleInputName1">Course</label>
                          <input type="text" name="Course" value="<?php  echo htmlentities($row->Course);?>" class="form-control" required='true'>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Subject</label>
                          <input type="text" name="Subject" value="<?php  echo htmlentities($row->Subject);?>" class="form-control" required='true'>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Syllabus Code</label>
                          <input type="text" name="AssignC" value="<?php  echo htmlentities($row->AssignmentCode);?>" class="form-control" required='true'>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Syllabus Name</label>
                          <input type="text" name="AssigN" value="<?php  echo htmlentities($row->AssignmentName);?>" class="form-control" required='true'>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Chapter</label>
                          <input type="text" name="Chapter" value="<?php  echo htmlentities($row->Chapter);?>" class="form-control" required='true'>
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
</html><?php } ?>
                        <?php } ?>