<?php
	session_start();
	include_once ("system/sys_user.php");
	$quser = new user();
	$chkrole = $quser->user_get_role($_SESSION['user_id']);
	
	if ($chkrole['user_role'] == "AKC"){
	    echo '<script type="text/javascript">
	        window.location.replace("pages/dashboard_akc.php?ex='.session_id().'");
	      </script>';
	}
	else if ($chkrole['user_role'] == "AP"){
		echo '<script type="text/javascript">
			  window.location.replace("pages/dashboard_ap.php?ex='.session_id().'");
			</script>';
	}
	else if ($chkrole['user_role'] == "KD"){
		echo '<script type="text/javascript">
			  window.location.replace("pages/dashboard_kd.php?ex='.session_id().'");
			</script>';
	}
	else{
		exit();
	}
?>
