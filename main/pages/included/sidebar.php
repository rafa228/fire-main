<?php
 $quser = new user();
 $role = $quser->user_get_role($_SESSION['user_id']);
 if ($role['user_role'] == 'Siswa'){
  include "sidebar_siswa.php";
 }
 else if ($role['user_role'] == 'AKC'){
  include "sidebar_akc.php";
 }
 else if ($role['user_role'] == 'AP'){
  include "sidebar_ap.php";
 }
 else if ($role['user_role'] == 'KD'){
  include "sidebar_kd.php";
 }

?>
