<?php
  include_once('security/session_check.php');
  include_once('../system/sys_user.php');
  include_once('../system/sys_damkar.php');
  $damkar = new damkar();
  $permohonan_list = $damkar->permohonan_list();
?>
<!DOCTYPE html>
<html>
<?php
  if(!isset($_SESSION['is_login']))
  {
    header('location:../../login.php');
  }
  include_once('../system/sys_user.php');
  include 'included/head.php'; 
?>
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php 
    include 'included/navbar.php';
    include 'included/sidebar.php';
  ?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <?php
              date_default_timezone_set("Asia/Jakarta");
              $jam = date('H:i');
              if ($jam > '00:00' && $jam < '10:00') {
                  $salam = 'Pagi';
              } elseif ($jam >= '10:00' && $jam <= '15:00') {
                  $salam = 'Siang';
              } elseif ($jam >= '15:00' && $jam <= '18:00') {
                  $salam = 'Sore';
              } elseif ($jam >= '18:01' && $jam <= '23:59'){
                  $salam = 'Malam';
              }
              else {
                  $salam = 'NULL';
              }
              echo '<h1>Selamat ' . $salam; echo '!</h1>';
            ?>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Dinas Pemadam Kebakaran dan Penanggulangan Bencana (DPK-PB) Kota Palembang</h3>
        </div>
        <div class="card-body">
          <div class="alert alert-dismissible" style="margin-bottom: 25px">
            <h5><i class="icon fas fa-info"></i> Hi <?php echo ucwords(strtolower($_SESSION['user_name']));?>!</h5>
            Selamat datang di Aplikasi Perawatan dan Perbaikan Peralatan Pemadam Kebakaran pada Dinas Pemadam Kebakaran dan Penanggulangan Bencana (DPK-PB) Kota Palembang.
          </div>
          <center>
            <img src="../../assets/img/damkar.png" style="width: 150px; height: 150px;">
          </center>
          <br/>
          <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $damkar->count_total_permohonan(); ?></h3>
                <p>Total Permohonan</p>
              </div>
              <div class="icon">
                <i class="fa fa-tools"></i>
              </div>
              <a href="show_all_data.php?ex=<?php echo session_id(); ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $damkar->count_approve_permohonan(); ?></h3>

                <p>Total Permohonan Disetujui</p>
              </div>
              <div class="icon">
                <i class="fa fa-tools"></i>
              </div>
              <a href="show_approve_all.php?ex=<?php echo session_id(); ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $damkar->count_decline_permohonan(); ?></h3>

                <p>Total Permohonan Ditolak</p>
              </div>
              <div class="icon">
                <i class="fa fa-hand-sparkles" aria-hidden="true"></i>
              </div>
              <a href="show_decline_all.php?ex=<?php echo session_id(); ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $damkar->count_admin_kantor(); ?></h3>

                <p>Total Admin Kantor</p>
              </div>
              <div class="icon">
                <i class="fa fa-hand-sparkles" aria-hidden="true"></i>
              </div>
              <a href="show_admin_user.php?ex=<?php echo session_id(); ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
          <!-- ./col -->
          <h4>Daftar Permohonan Tertunda</h4>
          <br/>
          <table id="example1" class="table table-bordered table-striped">
            <small>
            <thead>
              <tr>
                <th></th>
                <th>Tgl.Pelaporan</th>
                <th>Nama Alat</th>
                <th>Kantor Cabang</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                    $no = 1;
                    if ($permohonan_list == "No Data"){
                      echo "";
                    }
                    else {
                    foreach($permohonan_list as $row) {
                  ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $row['tgl_pelaporan']; ?></td>
                <td><?php echo $row['nama_alat']; ?></td>
                <td><?php echo $row['kantor_cabang']; ?></td>
                <td><?php echo $row['status_pelaporan']; ?></td>
                
                <td><a href="admin_detail_pelaporan.php?ex=<?php echo session_id(); ?>&id=<?php echo $row['id_permohonan']; ?>" type="button" class="btn btn-sm btn-block btn-info"><i class="fas fa-info-circle"></i> Detail</a></td>
              </tr>
              <?php
                }
              }
              ?>
              </tbody>
              
            </small>
            </table>
        </div>
      </div>
    </section>
  </div>

  <?php 
    include 'included/footer.php'; 
  ?>
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/sparklines/sparkline.js"></script>
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../dist/js/adminlte.js"></script>
<script src="../dist/js/pages/dashboard.js"></script>
<script src="../dist/js/demo.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>