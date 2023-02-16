<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsstuid']==0)) {
  header('location:logout.php');
  } else{
   
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Student Monitoring System | Dashboard</title>
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
    <!-- End layout styles -->
    <script src="print.js"></script>
    <link rel="stylesheet" type="text/css" href="print.css">
    <style>
    .qr-code {
      max-width: 200px;
      margin: 10px;
    }
  </style>
   
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
            <div class="row purchace-popup">
              <div class="col-12 stretch-card grid-margin">
                <div class="card card-secondary">
                <div class="text-center">
  

  <img src=
"https://chart.googleapis.com/chart?cht=qr&chl=Hello+World&chs=160x160&chld=L|0"
    class="qr-code img-thumbnail img-responsive" />
</div>

<div class="form-horizontal">
  <div class="form-group">
    <label class="control-label col-sm-2"
      for="content">
    </label>
    <div class="col-sm-10">

                      <div class="form-group">
                        <label for="exampleInputName1">Student ID</label>
                        <input type="text" id="content" value="<?php  echo $row->StuID;?>" class="form-control" required='true' readonly>
                      </div>

                      <button type="print" onclick="window.print()"class="btn btn-primary mr-2" name="print">Print</button>

    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="button" class=
        "btn btn-default" id="generate">  
      </button>
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
    <script>
     window.onload=function(){
  document.getElementById("generate").click();
};

</script>
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
    <script src=
"https://code.jquery.com/jquery-3.5.1.js">
</script>

<script>
// Function to HTML encode the text
// This creates a new hidden element,
// inserts the given text into it 
// and outputs it out as HTML
function htmlEncode(value) {
  return $('<div/>').text(value)
    .html();
}

$(function () {

  // Specify an onclick function
  // for the generate button
  $('#generate').click(function () {

    // Generate the link that would be
    // used to generate the QR Code
    // with the given data 
    let finalURL =
'https://chart.googleapis.com/chart?cht=qr&chl=' +
      htmlEncode($('#content').val()) +
      '&chs=160x160&chld=L|0'

    // Replace the src of the image with
    // the QR code image
    $('.qr-code').attr('src', finalURL);
  });
});
</script>
    <!-- End custom js for this page -->
  </body>
</html><?php }  ?>