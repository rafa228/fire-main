<?php 

include_once('db_connect.php');

class user {

	function __construct(){
		$this->conn = new conn();
	}

	function user_detail($user_id)
	{
		$data = mysqli_query($this->conn->koneksi,"SELECT * FROM db_user WHERE user_id = '$user_id' ");
		return $data->fetch_array();
	}

	function user_get_photo($user_id){
		$query = mysqli_query($this->conn->koneksi,"SELECT user_photo FROM db_user WHERE user_id='$user_id'");
		return $query->fetch_array();
	}

	function user_get_role($user_id){
		$query = mysqli_query($this->conn->koneksi,"SELECT user_role FROM db_user WHERE user_id='$user_id'");
		return $query->fetch_array();
	}

	function edit_user($user_id, $user_name, $user_gender, $user_role){
		$query = mysqli_query($this->conn->koneksi,"UPDATE db_user SET user_name = '$user_name', user_gender = '$user_gender', user_role = '$user_role' WHERE user_id = '$user_id'");
		return TRUE;
	}

	function update_user_photo($user_id,$user_photo){
		$query = mysqli_query($this->conn->koneksi,"UPDATE db_user SET user_photo='$user_photo' WHERE user_id='$user_id'");
		return TRUE;
	}

	function get_user_password($user_id){
		$query = mysqli_query($this->conn->koneksi,"SELECT user_password FROM db_user WHERE user_id='$user_id'");
		return $query->fetch_array();
	}

	function update_user_password($user_id, $new_password){
		$query = mysqli_query($this->conn->koneksi,"UPDATE db_user SET user_password='$new_password' WHERE user_id='$user_id'");
		return TRUE;
	}

	function get_user_photo($user_id){
		$query = mysqli_query($this->conn->koneksi,"SELECT user_photo FROM db_user WHERE user_id='$user_id'");
		return $query->fetch_array();
	}

	function user_delete($user_id){
		$data = mysqli_query($this->conn->koneksi,"DELETE FROM db_user WHERE user_id='$user_id'");
		return TRUE;
	}
}
?>