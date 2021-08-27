  <aside class="main-sidebar elevation-4 sidebar-light-primary">
    <a href="#" class="brand-link navbar-navy">
      <img src="../../assets/img/tkj.png"
           alt="AdminLTE Logo"
           class="brand-image"
           style="opacity: .8;">
      <span class="brand-text font-weight-light" style="color: white;">TKJ SMKN2 PLG</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php
            $quser = new user();
            $user_get = $quser->user_get_photo($_SESSION['user_id']);
          ?>
          <img src="files/user_photo/<?php echo $user_get['user_photo']; ?>" class="img-circle elevation-2" alt="User Image" style="width: 30px;height: 30px">
        </div>
        <div class="info">
          <a href="admin_detail.php?ex=<?php echo session_id() ?>" class="d-block"><?php echo ucwords(strtolower($_SESSION['user_name']));?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="admin_dashboard.php?ex=<?php echo session_id() ?>" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="search.php?ex=<?php echo session_id() ?>" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Pencarian
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Knowledge Database
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="all_tacit.php?ex=<?php echo session_id() ?>" class="nav-link">
                  <i class="fa fa-file-alt nav-icon"></i>
                  <p>Tacit Knowledge</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="all_explicit.php?ex=<?php echo session_id() ?>" class="nav-link">
                  <i class="fa fa-file-archive nav-icon"></i>
                  <p>Explicit Knowledge</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Akun Siswa
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin_add_user.php?ex=<?php echo session_id() ?>" class="nav-link">
                  <i class="fa fa-file-alt nav-icon"></i>
                  <p>Tambah Akun Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin_userlist.php?ex=<?php echo session_id() ?>" class="nav-link">
                  <i class="fa fa-file-archive nav-icon"></i>
                  <p>Kelola Akun Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin_userblock.php?ex=<?php echo session_id() ?>" class="nav-link">
                  <i class="fa fa-file-archive nav-icon"></i>
                  <p>Kelola Akun Diblokir</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
                Akun Guru
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin_add_teacher.php?ex=<?php echo session_id() ?>" class="nav-link">
                  <i class="fa fa-file-alt nav-icon"></i>
                  <p>Tambah Akun Guru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin_gurulist.php?ex=<?php echo session_id() ?>" class="nav-link">
                  <i class="fa fa-file-archive nav-icon"></i>
                  <p>Kelola Akun Guru</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Mata Pelajaran
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin_add_mapel.php?ex=<?php echo session_id() ?>" class="nav-link">
                  <i class="fa fa-file-alt nav-icon"></i>
                  <p>Tambah Mata Pelajaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin_mplist.php?ex=<?php echo session_id() ?>" class="nav-link">
                  <i class="fa fa-file-archive nav-icon"></i>
                  <p>Kelola Mata Pelajaran</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="admin_group_control.php?ex=<?php echo session_id() ?>" class="nav-link">
              <i class="fa fa-users nav-icon"></i>
              <p>Group</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin_mission_control.php?ex=<?php echo session_id() ?>" class="nav-link">
              <i class="fa fa-bullseye nav-icon"></i>
              <p>Mission</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="point_config.php?ex=<?php echo session_id() ?>" class="nav-link">
              <i class="fa fa-cogs nav-icon"></i>
              <p>Point Configuration</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>