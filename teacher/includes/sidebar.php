<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="images/faces/face8.jpg" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <?php
         $aid= $_SESSION['sturecmsaid'];
$sql="SELECT * from tblteacher where TID=:aid";

$query = $dbh -> prepare($sql);
$query->bindParam(':aid',$aid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                  <p class="profile-name"><?php  echo htmlentities($row->Name);?></p>
                  <p class="designation"><?php  echo htmlentities($row->Email);?></p><?php $cnt=$cnt+1;}} ?>
                </div>
               
              </a>
            </li>
            <li class="nav-item nav-category">
              <span class="nav-link">Dashboard</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <span class="menu-title">Dashboard</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth1" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Mail</span>
                <i class="icon-grid menu-icon"></i>
              </a>
              <div class="collapse" id="auth1">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="sendmessage.php"> Sent Messages </a></li>
                  <li class="nav-item"> <a class="nav-link" href="inbox.php"> Inbox </a></li>
                </ul>
              </div>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="manage-students.php">
                <span class="menu-title">Students</span>
                <i class="icon-user menu-icon"></i>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="manage-parents.php">
                <span class="menu-title">Parents</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
            </li>
  
            <li class="nav-item">
              <a class="nav-link" href="manage-notice.php">
                <span class="menu-title">Internal Notice</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth2" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Public Notice</span>
                <i class="icon-grid menu-icon"></i>
              </a>
              <div class="collapse" id="auth2">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add-public-notice.php"> Add Public Notice </a></li>
                  <li class="nav-item"> <a class="nav-link" href="manage-public-notice.php"> Manage Public Notice </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth3" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Homework</span>
                <i class="icon-grid menu-icon"></i>
              </a>
              <div class="collapse" id="auth3">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add-homework.php"> Add Homework </a></li>
                  <li class="nav-item"> <a class="nav-link" href="manage-homework.php"> Manage Homework </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="manage-assignments.php">
                <span class="menu-title">Syllabus</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Progress</span>
                <i class="icon-chart menu-icon"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                 <li class="nav-item"> <a class="nav-link" href="add-progress.php"> Add Progress </a></li>
                  <li class="nav-item"> <a class="nav-link" href="manage-progress.php"> Manage Progress </a></li>
                </ul>
              </div>
            </li>
              
              <li class="nav-item">
              <a class="nav-link" href="between-dates-reports.php">
                <span class="menu-title">Attendance</span>
                <i class="icon-calendar menu-icon"></i>
              </a>
            </li>
            
            </li>
          </ul>
        </nav>