<?php 
$emp = $_SESSION['Empid'];
$name = $_SESSION['name'];
?>

<header class="app-header">
  <a class="app-header__logo" href="dashboard.php">
    EMS | <?php echo $name; ?>
  </a>

  <!-- Sidebar toggle button-->
  <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>

  <!-- Navbar Right Menu-->
  <ul class="app-nav">

    <!-- User Menu-->
    <li class="dropdown">
      <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
        <i class="fa fa-user fa-lg"></i>
        <b>Welcome Back</b> :- <?php echo $name . ' ' . $emp; ?>
      </a>

      <ul class="dropdown-menu settings-menu dropdown-menu-right">
        <li>
          <a class="dropdown-item" href="change-password.php">
            <i class="fa fa-cog fa-lg"></i> Change Password
          </a>
        </li>

        <li>
          <a class="dropdown-item" href="my-profile.php">
            <i class="fa fa-user fa-lg"></i> Profile
          </a>
        </li>

        <!-- LOGOUT BUTTON (opens modal) -->
        <li>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fa fa-sign-out fa-lg"></i> Logout
          </a>
        </li>
      </ul>
    </li>
  </ul>
</header>

<!-- ================= LOGOUT CONFIRMATION MODAL ================= -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fa fa-sign-out"></i> Confirm Logout
        </h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <div class="modal-body">
        Are you sure you want to logout, <b><?php echo $name; ?></b>?
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Cancel
        </button>
        <a href="logout.php" class="btn btn-danger">
          Yes, Logout
        </a>
      </div>

    </div>
  </div>
</div>
