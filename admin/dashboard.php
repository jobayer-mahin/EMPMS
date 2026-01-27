<?php
session_start();
error_reporting(0);
require_once('include/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employee Management System</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini">

<?php include 'include/header.php'; ?>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<?php include 'include/sidebar.php'; ?>

<main class="app-content">

<div class="app-title">
  <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
</div>

<?php
// Top dashboard counts (KEEP)
$regemp = $dbh->query("SELECT COUNT(*) FROM tblemployee")->fetchColumn();
$listeddept = $dbh->query("SELECT COUNT(*) FROM tbldepartment")->fetchColumn();
$listedleavetype = $dbh->query("SELECT COUNT(*) FROM tblleavetype")->fetchColumn();
?>

<!-- ===== TOP CARDS (NUMBERS KEPT) ===== -->

<div class="row">

  <div class="col-md-6 col-lg-4">
    <div class="widget-small primary coloured-icon">
      <i class="icon fa fa-users fa-3x"></i>
      <div class="info">
        <a href="manage-employee.php">
          <h4>Registered Employees</h4>
          <p><b><?php echo $regemp; ?></b></p>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-4">
    <div class="widget-small warning coloured-icon">
      <i class="icon fa fa-files-o fa-3x"></i>
      <div class="info">
        <a href="manage-department.php">
          <h4>Listed Departments</h4>
          <p><b><?php echo $listeddept; ?></b></p>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-4">
    <div class="widget-small danger coloured-icon">
      <i class="icon fa fa-star fa-3x"></i>
      <div class="info">
        <a href="manage-leave.php">
          <h4>Listed Leave Type</h4>
          <p><b><?php echo $listedleavetype; ?></b></p>
        </a>
      </div>
    </div>
  </div>

</div>

<hr>
<h3 align="center">Leaves Details</h3>
<hr>

<!-- ===== LEAVES DETAILS (NUMBERS REMOVED) ===== -->

<div class="row">

  <div class="col-md-6 col-lg-6">
    <div class="widget-small info coloured-icon">
      <i class="icon fa fa-files-o fa-3x"></i>
      <div class="info">
        <a href="leave-history.php">
          <h4>Leaves Applied</h4>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-6">
    <div class="widget-small warning coloured-icon">
      <i class="icon fa fa-file fa-3x"></i>
      <div class="info">
        <a href="new-leave-request.php">
          <h4>New Leave Requests</h4>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-6">
    <div class="widget-small primary coloured-icon">
      <i class="icon fa fa-file fa-3x"></i>
      <div class="info">
        <a href="approved-leave-request.php">
          <h4>Approved Leave Requests</h4>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-6">
    <div class="widget-small danger coloured-icon">
      <i class="icon fa fa-file fa-3x"></i>
      <div class="info">
        <a href="reject-leave-request.php">
          <h4>Rejected Leave Requests</h4>
        </a>
      </div>
    </div>
  </div>

</div>

</main>

<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>

</body>
</html>

