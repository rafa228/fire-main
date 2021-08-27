<?php
  include_once('../system/sys_user.php');
  $quser = new user();
  session_start();

  $user_id = $_SESSION['user_id'];

  if(isset($_POST['submitFoto'])){
    $temp = $_FILES['user_photo']['tmp_name'];
    $user_photo = rand(0,9999999999).$_FILES['user_photo']['name'];
    $size = $_FILES['user_photo']['size'];
    $type = $_FILES['user_photo']['type'];
    $folder = "files/user_photo/";

    if ($size < 1000000){
      move_uploaded_file($temp,$folder.$user_photo);
      if($quser->update_user_photo($user_id,$user_photo))
      {
        header('location:my_detail.php');
      }
    }else{
        header('location:change_user_photo.php?message=error_upload');
    }
  }
?>
<!DOCTYPE html>
<html>
  <?php 
    include 'included/head.php'; 
    $user_show = $quser->user_detail($_SESSION['user_id']);
  ?>
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
            <h1>Ganti Foto Profil</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-4">
            <div class="card card-navy">
              <div class="card-header">
                <h3 class="card-title">Foto Profil Sekarang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="height: 280px">
                <center>
                  <?php $user_get = $quser->user_get_photo($_SESSION['user_id']); ?>
                  <img class="profile-user-img img-fluid img-circle" src="files/user_photo/<?php echo $user_get['user_photo']; ?>" alt="User profile picture" style="width:180px; height:180px;margin-top: 25px;margin-bottom: 10px">
                </center>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-8">
            <div class="card card-navy">
              <div class="card-header">
                <h3 class="card-title">Ganti Foto Profil</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <div class="callout callout-warning">
                  <h5>Perhatian!</h5>
                  <p>Format foto yang diterima adalah JPG/JPEG dan ukuran maksimal adalah 1Mb</p>
                </div>
                <form method="POST" enctype="multipart/form-data">
                  <label>Upload Foto</label>
                  <input type="file" class="form-control" name="user_photo" accept="image/jpg,image/jpeg" style="height:45px;margin-bottom:20px;" required="">
                  <button type="submit" name="submitFoto" class="btn btn-primary">Ganti Foto</button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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

<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>