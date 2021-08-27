<?php error_reporting(0); ?>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="#" class="brand-link navbar-navy">
      <img src="../../assets/img/damkar.png"
           alt="AdminLTE Logo"
           class="brand-image"
           style="opacity: .9;">
      <span class="brand-text font-weight-light" style="color: white;">DPK-PB PALEMBANG</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php
            $quser = new user();
            $user_get = $quser->user_get_photo($_SESSION['user_id']);
          ?>
          <img src="files/user_photo/<?php echo $user_get['user_photo']; ?>" class="img-circle elevation-2" alt="User Image" style="width: 50px;height: 50px">
        </div>
        <div class="info">
          <a href="my_detail.php?ex=<?php echo session_id() ?>" class="d-block"><?php echo ucwords(strtolower($_SESSION['user_name']));?></a>
          <small><?php echo 'Kepala Dinas'; ?></small>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="dashboard_kd.php?ex=<?php echo session_id() ?>" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          </li>
          <li class="nav-item">
            <a href="show_request_all.php?ex=<?php echo session_id() ?>" class="nav-link">
              <i class="fa fa-file-invoice nav-icon"></i>
              <p>Data Permohonan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="show_approve_all.php?ex=<?php echo session_id() ?>" class="nav-link">
              <i class="fa fa-tasks nav-icon"></i>
              <p>Permohonan Disetujui</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="show_decline_all.php?ex=<?php echo session_id() ?>" class="nav-link">
              <i class="fa fa-times nav-icon"></i>
              <p>Permohonan Ditolak</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../logout.php" class="nav-link" data-toggle="modal" data-target="#logout">
              <i class="fas fa-sign-out-alt nav-icon"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>