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
 $stuid=$_POST['stuid'];
 $OccupationF=$_POST['OccupationF'];
 $OccupationM=$_POST['OccupationM'];
 $Email=$_POST['Email'];
 $NumberF=$_POST['NumberF'];
 $NumberM=$_POST['NumberM'];
 $uname=$_POST['uname'];
 $password=md5($_POST['password']);
$sql="insert into tblparents(NameFather,NameMother,Address,ChildName,StuID,OccupationF,OccupationM,Email,NumberF,NumberM,UserName,Password)values(:NameF,:NameM,:Address,:ChildName,:stuid,:OccupationF,:OccupationM,:Email,:NumberF,:NumberM,:uname,:password)";
$query=$dbh->prepare($sql);
$query->bindParam(':NameF',$NameF,PDO::PARAM_STR);
$query->bindParam(':NameM',$NameF,PDO::PARAM_STR);
$query->bindParam(':Address',$Address,PDO::PARAM_STR);
$query->bindParam(':ChildName',$ChildName,PDO::PARAM_STR);
$query->bindParam(':stuid',$stuid,PDO::PARAM_STR);
$query->bindParam(':OccupationF',$OccupationF,PDO::PARAM_STR);
$query->bindParam(':OccupationM',$OccupationM,PDO::PARAM_STR);
$query->bindParam(':Email',$Email,PDO::PARAM_STR);
$query->bindParam(':NumberF',$NumberF,PDO::PARAM_STR);
$query->bindParam(':NumberM',$NumberM,PDO::PARAM_STR);
$query->bindParam(':uname',$uname,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Parents Successfully been added.")</script>';
echo "<script>window.location.href ='add-parents.php'</script>";
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
   
    <title>Student Monitoring System | Add Parents</title>
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
              <h3 class="page-title">Add Parents</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Add Parents</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Add Parents</h4>
                   
                    <form class="forms-sample" method="post">
                      
                      <div class="form-group">
                        <label for="exampleInputName1">Father Name</label>
                        <input type="text" name="NameF" value="" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Mother Name</label>
                        <input type="text" name="NameM" value="" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Address</label>
                        <input type="text" name="Address" value="" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Student Name</label>
                        <select  name="ChildName" class="form-control" required='true'>
                          <option value="">Select Student</option>
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
                        <label for="exampleInputEmail3">Student ID</label>
                        <select  name="stuid" class="form-control" required='true'>
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
                        <label for="exampleInputName1">Father Occupation</label>
                        <input type="text" name="OccupationF" value="" class="form-control" required='true'>
                      </div> 
                      <div class="form-group">
                        <label for="exampleInputName1">Mother Occupation</label>
                        <input type="text" name="OccupationM" value="" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Email</label>
                        <input type="email" name="Email" value="" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Father Phone Number</label>
                        <input type="text" name="NumberF" value="" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Mother Phone Number</label>
                        <input type="text" name="NumberM" value="" class="form-control" required='true'>
                      </div>
                      <h3>Login details</h3>
<div class="form-group">
                        <label for="exampleInputName1">User Name</label>
                        <input type="text" name="uname" value="" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Password</label>
                        <input type="Password" name="password" value="" class="form-control" required='true'>
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