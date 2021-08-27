<?php
include_once('security/session_check.php');
include_once('../system/sys_damkar.php');
$damkar = new damkar();
$uid = $_GET['id'];
$show = $damkar->user_detail($uid);

if(isset($_POST['save_edit_pegawai']))
  {
      $user_id = $_POST['user_id'];
      $user_name = $_POST['user_name'];
      $user_gender = $_POST['user_gender'];
      // $user_role = $_POST['user_role'];

      if($damkar->edit_user($user_id, $user_name, $user_gender))
      {
        header('location:show_user_detail.php?id='.$uid.'&ex='.session_id().'');
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
          <h3 class="card-title">Informasi Tentang Data Pegawai</h3>
        </div>
        <div class="card-body">
          
          <table class="table table-bordered" style="margin-bottom: 30px">
            <form action="" method="POST">
            <tbody>
              <tr>
                <div style="position: relative; float:right; margin-bottom: 10px">
                  <button type="submit" name="save_edit_pegawai" class="btn btn-sm btn-success" style="width: 90px"><i class="far fa-save" style="margin-right: 5px"></i> Simpan</button>
                </div>
              </tr>
              <tr>
                <td rowspan="5" style="width: 20%">
                  <center>
                    <img src="files/user_photo/<?php echo $show['user_photo']; ?>" style="width: 160px; height: 200px;margin-bottom: 10px">
                  </center>
                </td>
              </tr>
              <tr>
                <td style="width: 30%;">N I K</td>
                <td style="width: 50%;"><?php echo $show['user_nip']; ?></td>
              </tr>
              <tr>
                <td>Nama Lengkap</td>
                <td><input type="text" class="form-control" value="<?php echo $show['user_name']; ?>" name="user_name" ></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>
                  <select name="user_gender" class="form-control">
                    <option value="<?php echo $show['user_gender']; ?>" selected hidden>
                      <?php
                        if($show['user_gender'] == 'P'){
                          echo "Pria";
                        }
                        else{
                          echo "Wanita";
                        }
                      ?>
                    </option>
                    <option value="P">Pria</option>
                    <option value="W">Wanita</option>
                  </select>
                </td>
              </tr>
               <tr>
                <td>Role</td>
                <td><input type="text" class="form-control" value="<?php
                    if($show['user_role'] == 'AKC'){
                      echo "Admin Kepala Cabang";
                    }
                    else if($show['user_role'] == 'AP'){
                      echo "Admin Pusat";
                    }
                    else if($show['user_role'] == 'KD'){
                      echo "Kepala Dinas";
                    }
                  ?>" readonly></td>
              </tr>
              <tr>
              <input type="hidden" class="form-control" value="<?php echo $show['user_id']; ?>" name="user_id" >
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
</body>
</html>
