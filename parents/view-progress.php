<?php
session_start();
error_reporting(E_ALL);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
  header('location:logout.php');
  } else {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Student Monitoring System | View  Progress</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    
    <link rel="stylesheet" href="./css/style.css">
    <link href="css/css-circular-prog-bar.css" media="all" rel="stylesheet" />

    
    <!-- End layout styles -->
   
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
              <h3 class="page-title"> View  Progress </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> View  Progress</li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-sm-flex align-items-center mb-4">
                      <h4 class="card-title mb-sm-0">View Progress</h4>
                      <a href="#" class="text-dark ml-auto mb-3 mb-sm-0"> View all Progress</a>
                    </div>
                    <div class="table-responsive border rounded p-1">
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="font-weight-bold">No</th>
                            <th class="font-weight-bold">Class Name</th>
                            <th class="font-weight-bold">Syllabus Name</th>
                            <th class="font-weight-bold">Chapter</th>
                            <th style="text-align:center"class="font-weight-bold">Progress</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                        <?php
$sid=$_SESSION['sturecmsaid'];
$sql="SELECT  * from tblprogress Inner join tblstudent on tblstudent.StudentClass=tblprogress.ClassName inner join tblparents on tblparents.StuID=tblstudent.StuID where tblparents.PID=:sid";
$query = $dbh -> prepare($sql);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>   
                          <tr>
                           
                            <td><?php echo htmlentities($cnt);?></td>
                            <td><?php  echo htmlentities($row->ClassName);?> </td>
                            <td><?php  echo htmlentities($row->AssignmentName);?> </td>
                            <td><?php  echo htmlentities($row->Chapter);?></td>
                            <td> 
                            <div style="margin-left:205px"class="progress-circle  p<?php  echo htmlentities($row->Progress );?>">
   <span><?php  echo htmlentities($row->Progress);?>%</span>
   <div class="left-half-clipper">
      <div class="first50-bar"></div>
      <div class="value-bar"></div>
                            </td>
              
                             
                          </tr><?php $cnt=$cnt+1;}} ?>
                        </tbody>
                      </table>
                    </div>
                    <div align="left">
    <ul class="pagination" >
        <li><a href="?pageno=1"><strong>First></strong></a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><strong style="padding-left: 10px">Prev></strong></a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><strong style="padding-left: 10px">Next></strong></a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>"><strong style="padding-left: 10px">Last</strong></a></li>
    </ul>
</div>
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
    <script src="./vendors/chart.js/Chart.min.js"></script>
    <script src="./vendors/moment/moment.min.js"></script>
    <script src="./vendors/daterangepicker/daterangepicker.js"></script>
    <script src="./vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="./js/dashboard.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- End custom js for this page -->
  </body>
</html><?php } ?>
