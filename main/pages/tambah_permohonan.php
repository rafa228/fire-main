<?php
session_start();
// error_reporting(0);
include_once('../system/sys_user.php');
include_once('../system/sys_damkar.php');

$damkar = new damkar();
if (isset($_POST['addPermohonan'])) {
  $tgl_pelaporan      = $_POST['tgl_permohonan'];
  $user_id            = $_SESSION['user_nip'];
  $kantor_cabang      = $_POST['kantor_cabang'];
  $nama_alat          = $_POST['nama_alat'];

  // pemecah deskripsi kerusakan ! jangan diubah !
  $ds1 = $_POST['ds1'];
  $ds2 = $_POST['ds2'];
  $ds3 = $_POST['ds3'];
  $ds4 = $_POST['ds4'];
  $ds5 = $_POST['ds5'];
  $ds6 = $_POST['ds6'];
  if (!empty($ds1)) {
    $deskripsi_kerusakan = $ds1;
  } else if (!empty($ds2)) {
    $deskripsi_kerusakan = $ds2;
  } else if (!empty($ds3)) {
    $deskripsi_kerusakan = $ds3;
  } else if (!empty($ds4)) {
    $deskripsi_kerusakan = $ds4;
  } else if (!empty($ds5)) {
    $deskripsi_kerusakan = $ds5;
  } else if (!empty($ds6)) {
    $deskripsi_kerusakan = $ds6;
  }
  $status_pelaporan   = "Menunggu Persetujuan";

  $temp1 = $_FILES['photo_1']['tmp_name'];
  $photo_1 = rand(0, 9999999999) . $_FILES['photo_1']['name'];
  $size1 = $_FILES['photo_1']['size'];
  $type1 = $_FILES['photo_1']['type'];
  $folder1 = "files/foto_pelaporan/";

  if ($size1 < 1000000) {
    move_uploaded_file($temp1, $folder1 . $photo_1);
  }

  if (!empty($_FILES['photo_2']['tmp_name'])) {
    $temp1 = $_FILES['photo_2']['tmp_name'];
    $photo_2 = rand(0, 9999999999) . $_FILES['photo_2']['name'];
    $size1 = $_FILES['photo_2']['size'];
    $type1 = $_FILES['photo_2']['type'];
    $folder1 = "files/foto_pelaporan/";

    if ($size1 < 1000000) {
      move_uploaded_file($temp1, $folder1 . $photo_2);
    }
  } else {
    $photo_2 = "";
  }


  if (!empty($_FILES['photo_3']['tmp_name'])) {
    $temp1 = $_FILES['photo_3']['tmp_name'];
    $photo_3 = rand(0, 9999999999) . $_FILES['photo_3']['name'];
    $size1 = $_FILES['photo_3']['size'];
    $type1 = $_FILES['photo_3']['type'];
    $folder1 = "files/foto_pelaporan/";

    if ($size1 < 1000000) {
      move_uploaded_file($temp1, $folder1 . $photo_3);
    } else {
      $photo_3 = "";
    }
  }


  if ($damkar->add_permohonan($tgl_pelaporan, $user_id,  $kantor_cabang, $nama_alat, $deskripsi_kerusakan, $photo_1, $photo_2, $photo_3, $status_pelaporan)) {

    header('location:show_all_data.php?ex=' . session_id() . '');
  }
}
?>

<!DOCTYPE html>
<html>
<?php include 'included/head.php'; ?>
<link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../dist/css/adminlte.min.css">
<!-- summernote -->
<link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<body class="hold-transition sidebar-mini">
  <style>
    #OptNozel {
      display: none;
    }

    #OptSelang {
      display: none;
    }

    #OptCabang {
      display: none;
    }

    #OptPompaAirApung {
      display: none;
    }

    #OptPompaAirPortable {
      display: none;
    }

    #OptMobil {
      display: none;
    }
  </style>


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
              <h1>Tambah Permohonan</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="card card-navy">
                <div class="card-header">
                  <h3 class="card-title">Tambah Permohonan</h3>
                </div>

                <form method="POST" enctype="multipart/form-data">

                  <div class="card-body">

                    <div class="form-group">
                      <label for="tacit_name">Tanggal Permohonan</label>
                      <?php
                      date_default_timezone_set('Asia/Jakarta');
                      $current_date = date('d F Y');
                      ?>
                      <input type="text" name="tgl_permohonan" class="form-control" autocomplete="off" value="<?php echo $current_date ?>" readonly>
                    </div>

                    <div class="form-group">
                      <label for="admin_pelapor">Admin Pelapor</label>
                      <input type="text" name="id_pelapor" class="form-control" autocomplete="off" value="<?php echo $_SESSION['user_name']; ?>" readonly>
                    </div>

                    <input type="hidden" name="jenis_pelaporan" value="Perbaikan">

                    <div class="form-group">
                      <label>Kantor Cabang<small style="color:red">*</small></label>
                      <select name="kantor_cabang" class="custom-select" required="">
                        <option disabled readonly selected>-- Pilih Kantor Cabang --</option>
                        <option>Alang - Alang Lebar</option>
                        <option>Ampera</option>
                        <option>Gandus</option>
                        <option>Kemuning</option>
                        <option>Merdeka</option>
                        <option>Sako</option>
                        <option>Seberang Ulu 1</option>
                        <option>Seberang Ulu 2</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="admin_pelapor">Nama Alat<small style="color:red">*</small></label>
                      <select name="nama_alat" id="nama_alat" class="form-control">
                        <option disabled readonly selected>-- Pilih Alat --</option>
                        <option>Nozel 1 1/2</option>
                        <option>Nozel 2 1/2</option>
                        <option>Selang 1 1/2</option>
                        <option>Selang 2 1/2</option>
                        <option>Cabang 1 1/2</option>
                        <option>Pompa Air Ampung</option>
                        <option>Pompa Air Portable</option>
                        <option>Mobil</option>
                      </select>
                    </div>

                    <div class="form-group" id="OptNozel">
                      <label for="jenis_kerusakan">Jenis Kerusakan</label>
                      <select name="ds1" class="form-control">
                        <option disabled readonly selected>-- Pilih Jenis Kerusakan --</option>
                        <option>Bocor</option>
                        <option>Berkarat</option>
                      </select>
                    </div>

                    <div class="form-group" id="OptSelang">
                      <label for="jenis_kerusakan">Jenis Kerusakan</label>
                      <select name="ds2" class="form-control">
                        <option disabled readonly selected>-- Pilih Jenis Kerusakan --</option>
                        <option>Bocor</option>
                        <option>Berkarat</option>
                      </select>
                    </div>

                    <div class="form-group" id="OptCabang">
                      <label for="jenis_kerusakan">Jenis Kerusakan</label>
                      <select name="ds3" class="form-control">
                        <option disabled readonly selected>-- Pilih Jenis Kerusakan --</option>
                        <option>Bocor</option>
                        <option>Berkarat</option>
                        <option>Patah</option>
                      </select>
                    </div>

                    <div class="form-group" id="OptPompaAirApung">
                      <label for="jenis_kerusakan">Jenis Kerusakan</label>
                      <select name="ds4" class="form-control">
                        <option disabled readonly selected>-- Pilih Jenis Kerusakan --</option>
                        <option>Motor dinamo terbakar</option>
                        <option>Kapasitor mati</option>
                        <option>Kabel utama putus</option>
                      </select>
                    </div>

                    <div class="form-group" id="OptPompaAirPortable">
                      <label for="jenis_kerusakan">Jenis Kerusakan</label>
                      <select name="ds5" class="form-control">
                        <option disabled readonly selected>-- Pilih Jenis Kerusakan --</option>
                        <option>Motor dinamo terbakar</option>
                        <option>Kapasitor mati</option>
                        <option>Kabel utama putus</option>
                      </select>
                    </div>

                    <div class="form-group" id="OptMobil">
                      <label for="jenis_kerusakan">Jenis Kerusakan</label>
                      <select name="ds6" class="form-control">
                        <option disabled readonly selected>-- Pilih Jenis Kerusakan --</option>
                        <option>Service mesin</option>
                        <option>Servise sparepart</option>
                        <option>Kehilangan komponen</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Upload Foto (1)<small style="color:red">*</small></label>
                      <small>Pastikan format foto yang diupload adalah JPEG/JPG/PNG</small>
                      <input type="file" class="form-control" name="photo_1" accept="image/jpg,image/jpeg" style="height:45px;margin-bottom:20px;" required="">
                    </div>

                    <div class="form-group">
                      <label>Upload Foto (2)</label>
                      <small>Pastikan format foto yang diupload adalah JPEG/JPG/PNG</small>
                      <input type="file" class="form-control" name="photo_2" accept="image/jpg,image/jpeg" style="height:45px;margin-bottom:20px;">
                    </div>

                    <div class="form-group">
                      <label>Upload Foto (3)</label>
                      <small>Pastikan format foto yang diupload adalah JPEG/JPG/PNG</small>
                      <input type="file" class="form-control" name="photo_3" accept="image/jpg,image/jpeg" style="height:45px;margin-bottom:20px;">
                    </div>

                    <br />
                    <div class="callout callout-danger">
                      <small>Proses permohonan biasanya memakan waktu selama 3 hari</small>
                    </div>

                  </div>



                  <div class="card-footer">
                    <button type="submit" name="addPermohonan" class="btn btn-primary">
                      <i class="fa fa-paper-plane" aria-hidden="true"></i>
                      Kirim Permohonan</button>
                  </div>

                </form>
              </div>

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
  <script>
    $("#nama_alat").change(function() {
      if ($(this).val() == "Nozel 1 1/2") {
        $("#OptNozel").show();
        $("#OptSelang").hide();
        $("#OptCabang").hide();
        $("#OptPompaAirApung").hide();
        $("#OptPompaAirPortable").hide();
        $("#OptMobil").hide();
      } else if ($(this).val() == "Nozel 2 1/2") {
        $("#OptNozel").show();
        $("#OptSelang").hide();
        $("#OptCabang").hide();
        $("#OptPompaAirApung").hide();
        $("#OptPompaAirPortable").hide();
        $("#OptMobil").hide();
      } else if ($(this).val() == "Selang 1 1/2") {
        $("#OptNozel").hide();
        $("#OptSelang").show();
        $("#OptCabang").hide();
        $("#OptPompaAirApung").hide();
        $("#OptPompaAirPortable").hide();
        $("#OptMobil").hide();
      } else if ($(this).val() == "Selang 2 1/2") {
        $("#OptNozel").hide();
        $("#OptSelang").show();
        $("#OptCabang").hide();
        $("#OptPompaAirApung").hide();
        $("#OptPompaAirPortable").hide();
        $("#OptMobil").hide();
      } else if ($(this).val() == "Cabang 1 1/2") {
        $("#OptNozel").hide();
        $("#OptSelang").hide();
        $("#OptCabang").show();
        $("#OptPompaAirApung").hide();
        $("#OptPompaAirPortable").hide();
        $("#OptMobil").hide();
      } else if ($(this).val() == "Pompa Air Ampung") {
        $("#OptNozel").hide();
        $("#OptSelang").hide();
        $("#OptCabang").hide();
        $("#OptPompaAirApung").show();
        $("#OptPompaAirPortable").hide();
        $("#OptMobil").hide();
      } else if ($(this).val() == "Pompa Air Portable") {
        $("#OptNozel").hide();
        $("#OptSelang").hide();
        $("#OptCabang").hide();
        $("#OptPompaAirApung").hide();
        $("#OptPompaAirPortable").show();
        $("#OptMobil").hide();
      } else if ($(this).val() == "Mobil") {
        $("#OptNozel").hide();
        $("#OptSelang").hide();
        $("#OptCabang").hide();
        $("#OptPompaAirApung").hide();
        $("#OptPompaAirPortable").hide();
        $("#OptMobil").show();
      } else {
        $("#OptNozel").hide();
        $("#OptSelang").hide();
        $("#OptCabang").hide();
        $("#OptPompaAirApung").hide();
        $("#OptPompaAirPortable").hide();
        $("#OptMobil").hide();
      }
    });
  </script>
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

<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function() {
    // Summernote
    $('.textarea').summernote()
  })
</script>