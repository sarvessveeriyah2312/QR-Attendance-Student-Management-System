<?php
session_start();
error_reporting(E_ALL);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
  {
 $qrscan=$_POST['qrscan'];
 $attend=$_POST['attend'];
$sql="insert into tblattendance(StuID,Attendance)values(:qrscan,:attend)";
$query=$dbh->prepare($sql);
$query->bindParam(':qrscan',$qrscan,PDO::PARAM_STR);
$query->bindParam(':attend',$attend,PDO::PARAM_STR);
 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert(new Date )</script>';
echo "<script>window.location.href ='add-attendance.php'</script>";
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
  
    <title>Student Monitoring System | Scan Your QR Code</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <style>
    main {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #reader {
        width: 383px;
    }
    
</style>
    <link rel="stylesheet" href="css/style.css">
   
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="images/logo.svg"> 
                </div>
                <h4>Welcome Back</h4>
                <h6 class="font-weight-light">Scan Your QR Code.</h6>
                <form id="myform" class="pt-3" action="" method="post" >
              
                  <div class="form-group">
                  <div id="reader"></div>
                  <br>
                    <input type="text" class="form-control form-control-lg"  placeholder="Enter Your QR Identity" name="qrscan" required="true" id="result" value="" readonly>
                  </div>
                  <div class="form-group">
                        <label for="exampleInputName1">Attendance</label>
                        <input type="text" name="attend" value="Present"   class="form-control" required='true' readonly="true">
                      </div>
                  <div class="mt-3">
                    <button class="btn btn-success btn-block loginbtn"  name="submit" type="submit">Add Attendance</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                    </div>
                    
                  </div>
                  <div class="mb-2">
                    <a href="../index.php" class="btn btn-block btn-facebook auth-form-btn">
                      <i class="icon-social-home mr-2"></i>Back Home </a>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

    const scanner = new Html5QrcodeScanner('reader', { 
        // Scanner will be initialized in DOM inside element with id of 'reader'
        qrbox: {
            width: 250,
            height: 250,
        },  // Sets dimensions of scanning box (set relative to reader element width)
        fps: 20, // Frames per second to attempt a scan
    });


    scanner.render(success, error);
    // Starts scanner

    function success(result) {

        document.getElementById('result').value =`${result}`;

        scanner.clear();
        // Clears scanning instance

        document.getElementById('reader').remove();
        // Removes reader element from DOM since no longer needed
    
    }

    function error(err) {
        console.error(err);
        // Prints any errors to the console
    }
</script>
    <!-- endinject -->
  </body>
</html>