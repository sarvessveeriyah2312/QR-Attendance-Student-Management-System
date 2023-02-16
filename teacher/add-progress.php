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
 $classprogress=$_POST['classprogress'];
 $assname=$_POST['assname'];
 $chapter=$_POST['chapter'];
 $progress=$_POST['progress'];
$sql="insert into tblprogress(ClassName,AssignmentName,Chapter,Progress)values(:classprogress,:assname,:chapter,:progress)";
$query=$dbh->prepare($sql);
$query->bindParam(':classprogress',$classprogress,PDO::PARAM_STR);
$query->bindParam(':assname',$assname,PDO::PARAM_STR);
$query->bindParam(':chapter',$chapter,PDO::PARAM_STR);
$query->bindParam(':progress',$progress,PDO::PARAM_STR);
 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Progress has been added.")</script>';
echo "<script>window.location.href ='manage-progress.php'</script>";
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
   
    <title>Student Monitoring System | Add Progress</title>
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
              <h3 class="page-title">  Add Progress </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">  Add Progress</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;"> Add Progress</h4>
                   
                    <form class="forms-sample" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail3">Class Name</label>
                        <select  name="classprogress" class="form-control" required='true'>
                          <option value="">Select Class</option>
                         <?php 

$sql2 = "SELECT * from tblclass ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row1)
{          
    ?>  
<option value="<?php echo htmlentities($row1->ClassName);?>"><?php echo htmlentities($row1->ClassName);?></option>
 <?php } ?> 
                        </select>
                      </div>
                      
                    <div class="form-group">
                        <label for="exampleInputEmail3">Assignment Syllabus</label>
                        <select  name="assname" class="form-control" required='true'>
                          <option value="">Select Syllabus Name</option>
                         <?php 

$sql2 = "SELECT AssignmentName from tblassignments ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row1)
{          
    ?>  
<option value="<?php echo htmlentities($row1->AssignmentName);?>"><?php echo htmlentities($row1->AssignmentName);?> </option>
 <?php } ?> 
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Chapter</label>
                        <select  name="chapter" class="form-control" required='true'>
                          <option value="">Select Chapter</option>
                         <?php 

$sql2 = "SELECT Chapter from tblassignments ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row1)
{          
    ?>  
<option value="<?php echo htmlentities($row1->Chapter);?>"><?php echo htmlentities($row1->Chapter);?> </option>
 <?php } ?> 
                        </select>
                      </div>

                      <div class="form-group">
                          <label for="exampleInputName1">Progress</label>
                          <input type="text" name="progress" value="" class="form-control" required='true'>
                        </div>

                      <button type="submit" class="btn btn-primary mr-2" name="submit">Add</button>
                     
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