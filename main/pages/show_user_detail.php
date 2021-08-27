
<?php
include_once('security/session_check.php');
include_once('../system/sys_damkar.php');
$damkar = new damkar();
$uid = $_GET['id'];
$show = $damkar->user_detail($uid);

if (isset($_GET['action'])){
  if ($_GET['action'] == 'delete'){
    $damkar->delete_user($uid);
      echo ("<script LANGUAGE='JavaScript'>
            window.alert('Data berhasil dihapus!');
            window.location.href='show_list_user.php?ex=".session_id()."';
            </script>");
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
          <h3 class="card-title">Informasi Data Pegawai</h3>
        </div>
        <div class="card-body">
          
          <table class="table table-bordered" style="margin-bottom: 30px">
            <tbody>
              <tr>
                <div style="position: relative; float:right; margin-bottom: 10px">
                  <a href="ap_edit_pegawai.php?id=<?php echo $uid; ?>&ex=<?php echo session_id() ?>" type="button" class="btn btn-sm btn-info" style="width: 90px"><i class="far fa-edit" style="margin-right: 5px"></i> Edit</a>
                   <a href="show_user_detail.php?id=<?php echo $uid; ?>&ex=<?php echo session_id() ?>&action=delete" type="button" class="btn btn-sm btn-danger" style="width: 90px" onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')"><i class="fa fa-trash" style="margin-right: 5px"></i> Hapus</a>
                </div>
              </tr>
              <tr>
                <td rowspan="6" style="width: 15%"><img src="files/user_photo/<?php echo $show['user_photo']; ?>" style="width: 140px; height: 180px"></td>
              <tr>
                <td style="width: 30%;">N I K</td>
                <td style="width: 50%;"><?php echo $show['user_nip']; ?></td>
              </tr>
              <tr>
                <td>Nama Lengkap</td>
                <td><?php echo $show['user_name']; ?></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>
                  <?php
                    if($show['user_gender'] == 'P'){
                      echo "Pria";
                    }
                    else{
                      echo "Wanita";
                    }
                  ?>
                </td>
              </tr>
              <tr>
                <td>Role</td>
                <td>
                  <?php
                    if($show['user_role'] == 'AKC'){
                      echo "Admin Kepala Cabang";
                    }
                    else if($show['user_role'] == 'AP'){
                      echo "Admin Pusat";
                    }
                    else if($show['user_role'] == 'KD'){
                      echo "Kepala Dinas";
                    }
                  ?>
                </td>
              </tr>
            </tbody>
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
</body>
</html>
