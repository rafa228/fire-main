<?php
session_start();
// error_reporting(0);
include_once('../system/sys_user.php');
include_once('../system/sys_damkar.php');

$damkar = new damkar();
if (isset($_POST['addUser'])) {
  $user_nip           = $_POST['user_nip'];
  $user_name          = $_POST['user_name'];
  $user_gender        = $_POST['user_gender'];
  $user_role          = $_POST['user_role'];
  $user_password      = md5($user_nip);

  if (empty($_FILES['user_photo']['name'])) {
    $user_photo = "blank.jpg";
  } else {
    // untuk foto pertama
    $temp1 = $_FILES['user_photo']['tmp_name'];
    $user_photo = rand(0, 9999999999) . $_FILES['user_photo']['name'];
    $size1 = $_FILES['user_photo']['size'];
    $type1 = $_FILES['user_photo']['type'];
    $folder1 = "files/user_photo/";

    if ($size1 < 1000000) {
      move_uploaded_file($temp1, $folder1 . $user_photo);
    }
  }


  if ($damkar->add_user($user_nip, $user_name, $user_gender, $user_photo, $user_role, $user_password)) {
    header('location:show_list_user.php?ex=' . session_id() . '');
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
              <h1>Tambah Pengguna</h1>
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
                  <h3 class="card-title">Tambah Pengguna</h3>
                </div>

                <form method="POST" enctype="multipart/form-data">

                  <div class="card-body">

                    <div class="form-group">
                      <label for="tacit_name">NIP</label>
                      <input type="text" name="user_nip" class="form-control" autocomplete="off" placeholder="Masukkan NIP...">
                    </div>

                    <div class="form-group">
                      <label for="admin_pelapor">Nama Pegawai</label>
                      <input type="text" name="user_name" class="form-control" autocomplete="off" placeholder="Masukkan Nama Pegawai...">
                    </div>

                    <div class="form-group">
                      <label>Jenis Kelamin<small style="color:red">*</small></label>
                      <select name="user_gender" class="custom-select" required="">
                        <option disabled readonly selected>-- Pilih Jenis Kelamin --</option>
                        <option value="P">Pria</option>
                        <option value="W">Wanita</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Upload Foto Profil</label><br>
                      <small>Format foto yang dapat diterima adalah JPEG/JPG</small> <input type="file" class="form-control" name="user_photo" accept="image/jpg,image/jpeg" style="height:45px;margin-bottom:20px;">
                    </div>

                    <div class="form-group">
                      <label>Pilih Role<small style="color:red">*</small></label>
                      <select name="user_role" class="custom-select" required="">
                        <option disabled readonly selected>-- Pilih Role --</option>
                        <option value="AKC">Admin Kantor Cabang </option>
                        <option value="KD">Kepala Dinas </option>
                      </select>
                    </div>

                    <div class="callout callout-success">
                      <small>Username dan Password akan otomatis menggunakan NIK secara default</small>
                    </div>

                  </div>


                  <div class="card-footer">
                    <button type="submit" name="addUser" class="btn btn-primary">
                      <i class="fa fa-user-plus" aria-hidden="true"></i>
                      Tambah Pengguna</button>
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