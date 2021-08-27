<?php
 session_start();
 if(!isset($_SESSION['is_login']))
  {
    header('location:../../login.php');
  }

if(!isset($_GET['ex'])){
	echo ("<script LANGUAGE='JavaScript'>
			    window.alert('Anda tidak dapat mengakses laman ini!');
			    window.location.href='index.php';
			    </script>");
}
else {
	$session_id = $_GET['ex'];
	if ($session_id != session_id()){
		echo ("<script LANGUAGE='JavaScript'>
			    window.alert('Anda tidak dapat mengakses laman ini!');
			    window.location.href='index.php';
			    </script>");
	}
	else{
			include_once('../system/sys_user.php');
  		$quser = new user();
  		$user_id = $_SESSION['user_id'];
	}
}
?>