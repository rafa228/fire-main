<?php
include_once('db_connect.php');
class user
{

	function __construct()
	{
		$this->conn = new conn();
	}

	function login($user_nip, $user_password)
	{
		$sql = mysqli_query($this->conn->koneksi, "select * from db_user where user_nip='$user_nip' and user_password='$user_password'");
		$data = $sql->fetch_array();

		if ($user_nip == $data['user_nip'] and $user_password == $data['user_password']) {
			session_start();
			$_SESSION['user_nip'] = $data['user_nip'];
			$user_nip = $data['user_nip'];
			$_SESSION['user_id'] = $data['user_id'];
			$_SESSION['user_name'] = $data['user_name'];
			$_SESSION['user_role'] = $data['user_role'];

			$last_login = date('d F Y H:i:s');

			$add_log = mysqli_query($this->conn->koneksi, "INSERT INTO db_login_activity ( activity_date, user_id) VALUES ('$last_login','$user_nip')");

			return TRUE;
		} else {
			return FALSE;
		}
	}


	function getdata($user_nip)
	{
		$query = mysqli_query($this->conn->koneksi, "select * from db_user where user_nip='$user_nip'");
		return $query->fetch_array();
	}
}
