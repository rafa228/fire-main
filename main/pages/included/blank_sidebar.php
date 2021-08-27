
<!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="#" class="brand-link navbar-primary">
      <img src="../../assets/img/tkj.png"
           alt="AdminLTE Logo"
           class="brand-image"
           style="opacity: .8;">
      <span class="brand-text font-weight-light" style="color: white;">TKJ SMKN2 PLG</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php
            $quser = new user();
            $user_get = $quser->user_get_photo($_SESSION['user_id']);

            include_once('../system/sys_point.php');
            $qpoint = new point();

            $total_point =  $qpoint->count_mypoint($_SESSION['user_id']);
            $total_belanja =  $qpoint->count_shopping($_SESSION['user_id']);
            $total_transfer =  $qpoint->count_transfer($_SESSION['user_id']);
            $total_penerimaan = $qpoint->count_penerimaan($_SESSION['user_id']);
            $total_keseluruhan =  $qpoint->count_total($total_point, $total_belanja, $total_transfer, $total_penerimaan);
          ?>
          <img src="files/user_photo/<?php echo $user_get['user_photo']; ?>" class="img-circle elevation-2" alt="User Image" style="width: 50px;height: 50px">
        </div>
        <div class="info">
          <a href="my_detail.php?ex=<?php echo session_id() ?>" class="d-block"><?php echo ucwords(strtolower($_SESSION['user_name']));?></a>
            <small>
              <?php echo $total_keseluruhan ?> Pts / 

              <?php
              if ($total_point+$total_penerimaan >= 0 AND $total_point+$total_penerimaan <= 19){
                echo '<b>Pemula</b>';
                    }
              else if ($total_point+$total_penerimaan >= 20 AND $total_point+$total_penerimaan <= 49){
                echo '<b>Gemar Membantu</b>';
              }
              else if ($total_point+$total_penerimaan >= 50 AND $total_point+$total_penerimaan <= 69){
                echo '<b>Ambisius</b>';
              }
              else if ($total_point+$total_penerimaan >= 70 AND $total_point+$total_penerimaan <= 99){
                echo '<b>Terpelajar</b>';
              }
              else if ($total_point+$total_penerimaan >= 100 AND $total_point+$total_penerimaan <= 149){
                echo '<b>Pakar</b>';
              }
              else if ($total_point+$total_penerimaan >= 150 AND $total_point+$total_penerimaan <= 249){
                echo '<b>Si Hebat</b>';
              }
              else {
                echo '<b>Jenius</b>';
              }
              ?>

            </small>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>