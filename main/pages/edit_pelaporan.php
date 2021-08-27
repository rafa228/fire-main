<?php
  include_once('security/session_check.php');
  include_once('../system/sys_user.php');
  include_once('../system/sys_damkar.php');
  $damkar = new damkar();
  $id_permohonan = $_GET['id'];
  $permohonan_detail = $damkar->permohonan_detail($id_permohonan);

if(isset($_POST['save_edit']))
  {
      $kantor_cabang        = $_POST['kantor_cabang'];
      $nama_alat            = $_POST['nama_alat'];
      $deskripsi_kerusakan  = $_POST['deskripsi_kerusakan'];
      $id_permohonan        = $_POST['id_permohonan'];


      if($damkar->edit_pelaporan($kantor_cabang, $nama_alat, $deskripsi_kerusakan, $id_permohonan))
      {
        header('location:detail_pelaporan.php?id='.$id_permohonan.'&ex='.session_id().'');
      }
  }

?>

<!DOCTYPE html>
<html>
  <?php include 'included/head.php'; ?>
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
    <section class="content-header" style="margin-bottom: -15px">
      <!-- <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Knowledge</h1>
          </div>
        </div>
      </div> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <!-- Default box -->
      <div class="card card-navy">
        <div class="card-header">
          <h3 class="card-title">Form Perubahan Data Pelaporan</h3>
        </div>
        <div class="card-body">
          
          <table class="table table-bordered" style="margin-bottom: 30px">
            <form action="" method="POST">
            <tbody>
              <tr>
                <div style="position: relative; float:right; margin-bottom: 10px">
                  <button type="submit" name="save_edit" class="btn btn-sm btn-success" style="width: 90px"><i class="far fa-save" style="margin-right: 5px"></i> Simpan</button>
                </div>
              </tr>
              <tr>
                <td rowspan="7" style="width: 20%">
                  <center>
                    <img src="files/foto_pelaporan/<?php echo $permohonan_detail['foto_1']; ?>" style="width: 160px; height: 120px;margin-bottom: 10px">
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
                  </center>
                </td>
              </tr>
              <tr>
                <td style="width: 30%;">Nomor Pelaporan</td>
                <td style="width: 50%;"><?php echo $permohonan_detail['id_permohonan']; ?></td>
                <input type="hidden" name="id_permohonan" value="<?php echo $permohonan_detail['id_permohonan']; ?>">
              </tr>
              <tr>
                <td>Tanggal Permohonan</td>
                <td><input type="text" class="form-control" value="<?php echo $permohonan_detail['tgl_pelaporan']; ?>" name="tgl_pelaporan" readonly></td>
              </tr>
              <tr>
                <td>Kantor Cabang</td>
                <td>
                  <select name="kantor_cabang" class="form-control">
                    <option selected hidden><?php echo $permohonan_detail['kantor_cabang']; ?>
                    </option>
                    <option>Alang - Alang Lebar</option>
                    <option>Ampera</option>
                    <option>Gandus</option>
                    <option>Kemuning</option>
                    <option>Merdeka</option>
                    <option>Sako</option>
                    <option>Seberang Ulu 1</option>
                    <option>Seberang Ulu 2</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Nama Alat</td>
                <td>
                  <select class="form-control" name="nama_alat">
                      <option selected hidden><?php echo $permohonan_detail['nama_alat']; ?></option>
                      <option>Nozel 1 1/2</option>
                      <option>Nozel 2 1/2</option>
                      <option>Selang 1 1/2</option>
                      <option>Selang 2 1/2</option>
                      <option>Cabang 1 1/2</option>
                      <option>Pompa Air Ampung</option>
                      <option>Pompa Air Portable</option>
                      <option>Mobil</option>
                  </td>
              </tr>
              <tr>
                <td>Deskripsi Kerusakan</td>
                <td>
                    <input type="text" class="form-control" name="deskripsi_kerusakan" value="<?php echo $permohonan_detail['deskripsi_kerusakan']; ?>">
                </td>
              </tr>
              <tr>
                <td>Estimasi Waktu</td>
                <td>
                  <input type="text" class="form-control" value="<?php echo $permohonan_detail['estimasi_waktu']; 
                  if(empty($permohonan_detail['estimasi_waktu'])){ 
                    echo '--Belum Terjadwal--'; 
                  } 
                  ?>" readonly>
                </td>
              </tr>
              <tr>
            </tbody>
          </form>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </tr>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
</body>
</html>
