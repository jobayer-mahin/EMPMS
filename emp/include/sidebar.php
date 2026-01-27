<!-- ================= SIDEBAR ================= -->
<aside class="app-sidebar">
  <ul class="app-menu">
    <li>
      <a class="app-menu__item" href="dashboard.php">
        <i class="app-menu__icon fa fa-dashboard"></i>
        <span class="app-menu__label">Dashboard</span>
      </a>
    </li>

    <li>
      <a class="app-menu__item" href="my-profile.php">
        <i class="app-menu__icon fa fa-user"></i>
        <span class="app-menu__label">My Profile</span>
      </a>
    </li>

    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-laptop"></i>
        <span class="app-menu__label">Leave</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="apply-leave.php"><i class="icon fa fa-circle-o"></i> Apply Leave</a></li>
        <li><a class="treeview-item" href="leave-history.php"><i class="icon fa fa-circle-o"></i> Leave History</a></li>
      </ul>
    </li>

    <li>
      <a class="app-menu__item" href="salary-history.php">
        <i class="app-menu__icon fa fa-money"></i>
        <span class="app-menu__label">Salary History</span>
      </a>
    </li>

    <li>
      <a class="app-menu__item" href="change-password.php">
        <i class="app-menu__icon fa fa-key"></i>
        <span class="app-menu__label">Change Password</span>
      </a>
    </li>

    <!-- ======= SIGN OUT BUTTON (with confirmation modal) ======= -->
    <li>
      <a class="app-menu__item" href="#" data-toggle="modal" data-target="#logoutModal">
        <i class="app-menu__icon fa fa-sign-out"></i>
        <span class="app-menu__label">Sign Out</span>
      </a>
    </li>
  </ul>
</aside>

<!-- ================= LOGOUT CONFIRMATION MODAL ================= -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fa fa-sign-out"></i> Confirm Sign Out
        </h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <div class="modal-body text-center">
        <p>Are you sure you want to sign out?</p>
      </div>

      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a href="logout.php" class="btn btn-danger">Yes, Sign Out</a>
      </div>

    </div>
  </div>
</div>

