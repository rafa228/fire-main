<?php
session_start();

if(!isset($_GET['ex'])){
	echo ("<script LANGUAGE='JavaScript'>
			    window.alert('Anda tidak dapat mengakses laman ini!');
			    window.location.href='my_detail.php';
			    </script>");
}
else {
	$session_id = $_GET['ex'];
	if ($session_id != session_id()){
		echo ("<script LANGUAGE='JavaScript'>
			    window.alert('Anda tidak dapat mengakses laman ini!');
			    window.location.href='my_detail.php';
			    </script>");
	}
	else{
		include_once('../system/sys_user.php');
  		$quser = new user();
  		$user_id = $_SESSION['user_id'];
	}
}

if(isset($_POST['changePassword'])){
	$old_password = md5($_POST['old_password']);
	$new_password = $_POST['new_password'];
	$confirm_password = $_POST['confirm_password'];

	$show_password = $quser->get_user_password($_SESSION['user_id']);
	$current_password = $show_password['user_password'];


	if ($old_password != $current_password){
		header('location:change_user_password.php?ex='.session_id().'&message=old_password_not_match');
	}
	
	if ($new_password != $confirm_password){
		header('location:change_user_password.php?ex='.session_id().'&message=confirm_password_not_match');
	}
	else{
		$uppercase = preg_match('@[A-Z]@', $new_password);
		$lowercase = preg_match('@[a-z]@', $new_password);
		$number    = preg_match('@[0-9]@', $new_password);

		if(!$uppercase || !$lowercase || !$number || strlen($new_password) < 8) {
		    header('location:change_user_password.php?ex='.session_id().'&message=validation_error');
		}else{
			$new_password = md5($new_password);
		    if($quser->update_user_password($user_id,$new_password)){
        		header('location:my_detail.php?message=success_change_password');
      		}
      		else{
      			echo ("<script LANGUAGE='JavaScript'>
			    window.alert('Terjadi Kesalahan!');
			    window.location.href='my_detail.php';
			    </script>");
      		}
		}
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
            <h1>Ganti Password</h1>
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
                <h3 class="card-title">Ganti Password Pengguna</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              	<?php
              		if (isset($_GET['message'])){
              			if ($_GET['message'] == 'old_password_not_match'){
              				echo '<div class="alert alert-danger alert-dismissible">
				                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				                  <h5><i class="icon fas fa-ban"></i> Oopss!</h5>
				                  Password yang dimasukkan tidak sama seperti sebelumnya!
				                </div>';
              			}
              			else if ($_GET['message'] == 'validation_error'){
              				echo '<div class="alert alert-danger alert-dismissible">
				                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				                  <h5><i class="icon fas fa-ban"></i> Oopss!</h5>
				                  Harap periksa karakter pada password!
				                </div>';
              			}
              		}
              	?>
                <form method="POST" action="#">
                  <label>Password Sekarang</label>
                  <input type="password" class="form-control" name="old_password" style="margin-bottom: 15px;" maxlength="15">
                  <label>Password Baru</label>
                  <p>Password baru harus terdiri minimum 8 karakter, 1 huruf kecil, 1 huruf besar dan 1 angka</p>
                  
                  <input type="password" class="form-control" name="new_password" style="margin-bottom: 15px;" maxlength="15">
                  <label>Konfirmasi Password Baru</label>
                  <input type="password" class="form-control" name="confirm_password" style="margin-bottom: 15px;" maxlength="15">
                  <button type="submit" name="changePassword" class="btn btn-primary"><i class="fa fa-key" aria-hidden="true" style="padding-right: 8px"></i>Proses Ganti Password</button>
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