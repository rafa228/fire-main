<?php error_reporting(0); ?>
<?php
  include_once('security/session_check.php');
  include_once('../system/sys_user.php');
  include_once('../system/sys_damkar.php');
  $damkar = new damkar();
  $perbaikan_list = $damkar->approve_perbaikan_list();

?>
<!DOCTYPE html>
<html>
<?php 
  include 'included/head.php';
?>
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <?php 
    include 'included/navbar.php';
    include 'included/sidebar.php';
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Perbaikan Disetujui</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-navy">
              <div class="card-header">
                <h3 class="card-title">Daftar Permohonan Perbaikan</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th></th>
                    <th>Tanggal</th>
                    <th>Kantor Cabang</th>
                    <th>Nama Alat</th>
                    <th>Estimasi Perbaikan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $no = 1;
                    if ($perbaikan_list == "No Data"){
                      echo "";
                    }
                    else {
                    foreach($perbaikan_list as $row) {
                    $id_permohonan = $row['id_permohonan'];
                    $permohonan_detail = $damkar->permohonan_detail($id_permohonan);
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['tgl_pelaporan']; ?></td>
                    <td><?php echo $row['kantor_cabang']; ?></td>
                    <td><?php echo $row['nama_alat']; ?></td>
                    <td><?php echo $row['estimasi_waktu']; ?></td>
                    <td>
                      <?php
                        if($_SESSION['user_role'] == "KD"){
                          $nav_link = "admin_detail_pelaporan.php";
                        }
                        else if($_SESSION['user_role'] == "AP"){
                          $nav_link = "ap_detail_pelaporan.php";
                        }
                        else{
                          $nav_link = "detail_pelaporan.php";
                        }
                      ?>
                      <a href="<?php echo $nav_link; ?>?ex=<?php echo session_id(); ?>&id=<?php echo $row['id_permohonan']; ?>" type="button" class="btn btn-sm btn-block btn-info"><i class="fas fa-info-circle"></i> Detail</a></td>
                  </tr>
                  <?php
                    }}
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th></th>
                    <th>Tanggal</th>
                    <th>Kantor Cabang</th>
                    <th>Nama Alat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
    </section>
  </div>
  

  <?php include 'included/footer.php'; ?>
  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

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

 