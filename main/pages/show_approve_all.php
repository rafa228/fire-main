<?php
  include_once('security/session_check.php');
  include_once('../system/sys_user.php');
  include_once('../system/sys_damkar.php');
  $damkar = new damkar();
  $permohonan_list = $damkar->approve_permohonan_list();

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
            <h1>Daftar Permohonan Disetujui</h1>
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
                <h3 class="card-title">Permohonan Disetujui</h3>
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
                    if ($permohonan_list == "No Data"){
                      echo "";
                    }
                    else {
                    foreach($permohonan_list as $row) {
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

  <div class="modal fade" id="modalPerawatan<?php echo $row['id_permohonan']; ?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Permohonan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-striped table-bordered">
            <?php
              $id_permohonan = $row['id_permohonan'];
              $permohonan_detail = $damkar->permohonan_detail($id_permohonan);
            ?>
            <tr>
              <td width="30%">ID Permohonan</td>
              <td width="70%"><?php echo $permohonan_detail['id_permohonan']; ?></td>
            </tr>
            <tr>
              <td>Tanggal Permohonan</td>
              <td><?php echo $permohonan_detail['tgl_pelaporan']; ?></td>
            </tr>
            <tr>
              <td>Jenis Permohonan</td>
              <td><?php echo $permohonan_detail['jenis_pelaporan']; ?></td>
            </tr>
            <tr>
              <td>Kantor Cabang</td>
              <td><?php echo $permohonan_detail['kantor_cabang']; ?></td>
            </tr>
            <tr>
              <td>Nama Alat</td>
              <td><?php echo $permohonan_detail['nama_alat']; ?></td>
            </tr>
            <tr>
              <td>Foto</td>
              <td><img src="files/foto_pelaporan/<?php echo $permohonan_detail['foto_1']; ?>" width="40%">
                  <img src="files/foto_pelaporan/<?php echo $permohonan_detail['foto_2']; ?>" width="40%">
                  <img src="files/foto_pelaporan/<?php echo $permohonan_detail['foto_3']; ?>" width="40%"></td>
            </tr>
            <tr>
              <td>Status Permohonan</td>
              <td><?php echo $permohonan_detail['status_pelaporan']; ?></td>
            </tr>
            <tr>
              <td>Aksi</td>
              <td></td>
          </table>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->