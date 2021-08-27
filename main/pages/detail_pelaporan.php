<?php
  include_once('security/session_check.php');
  include_once('../system/sys_user.php');
  include_once('../system/sys_damkar.php');
  $damkar = new damkar();
  $id_permohonan = $_GET['id'];
  $permohonan_detail = $damkar->permohonan_detail($id_permohonan);

  if(isset($_GET['action'])){
    if($_GET['action'] == "Hapus"){
      $damkar->hapus_permohonan($id_permohonan);
      echo ("<script LANGUAGE='JavaScript'>
            window.alert('Permohonan berhasil dihapus!');
            window.location.href='show_all_data.php?ex".session_id()."';
            </script>");
    }
  }

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
            <h1>Daftar Permohonan Perbaikan</h1>
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
                <table class="table table-striped table-bordered">
                  <tr>
                    <td width="30%">ID Permohonan</td>
                    <td width="70%"><?php echo $permohonan_detail['id_permohonan']; ?></td>
                  </tr>
                  <tr>
                    <td>Tanggal Permohonan</td>
                    <td><?php echo $permohonan_detail['tgl_pelaporan']; ?></td>
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
                    <td>Deskripsi Kerusakan</td>
                    <td><?php echo $permohonan_detail['deskripsi_kerusakan']; ?></td>
                  </tr>
                  <tr>
                    <td>Foto</td>
                    <td><img src="files/foto_pelaporan/<?php echo $permohonan_detail['foto_1']; ?>" style="width: 160px; height: 120px;margin-bottom: 10px">
                        <?php
                          if(empty($permohonan_detail['foto_2'])){
                            $foto_2 = "blank.jpg";
                          }
                          else{
                            $foto_2 = $permohonan_detail['foto_2'];
                          }
                        ?>
                        <img src="files/foto_pelaporan/<?php echo $foto_2; ?>" style="width: 160px; height: 120px;margin-bottom: 10px">
                        <?php
                          if(empty($permohonan_detail['foto_3']) OR $permohonan_detail['foto_3'] == ''){
                            $foto_3 = "blank.jpg";
                          }
                          else{
                            $foto_3 = $permohonan_detail['foto_3'];
                          }
                        ?>
                    <img src="files/foto_pelaporan/<?php echo $foto_3; ?>" style="width: 160px; height: 120px;margin-bottom: 10px">
                    </td>
                  </tr>
                  <tr>
                    <td>Status Permohonan</td>
                    <td><?php echo $permohonan_detail['status_pelaporan']; ?></td>
                  </tr>
                  <tr>
                    <td>Estimasi Perbaikan</td>
                    <td><?php echo $permohonan_detail['estimasi_waktu']; ?></td>
                  </tr>
                  <tr>
                    <td>Aksi</td>
                    <td>
                      <a type="button" href="edit_pelaporan.php?ex=<?php echo session_id(); ?>&id=<?php echo $permohonan_detail['id_permohonan']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit" aria-hidden="true" style="margin-right:10px;"></i>Edit Data</a>
                      <a  id="btn1" type="button" class="btn btn-sm btn-danger" href="#" data-toggle="modal" data-target="#modalHapus<?php echo $permohonan_detail['id_permohonan']; ?>">
                              <i class="fas fa-trash"></i> Hapus Data
                    </td>
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

 <!-- Modal -->
<div class="modal fade" id="modalHapus<?php echo $permohonan_detail['id_permohonan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Transaksi #<?php echo $permohonan_detail['id_permohonan']; ?></h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin untuk menghapus transaksi permohonan ini?</p>

            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                <a href="detail_pelaporan.php?id=<?php echo $permohonan_detail['id_permohonan']; ?>&action=Hapus&ex=<?php echo session_id(); ?>" class="btn btn-danger">Ya, Hapus</a>
            </div>
        </div>
    </div>
</div>
<!--  -->
