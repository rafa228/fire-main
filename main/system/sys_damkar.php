<?php
include_once('db_connect.php');
class damkar
{

	function __construct()
	{
		$this->conn = new conn();
	}

	function permohonan_list()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * FROM db_permohonan");
		while ($row = mysqli_fetch_array($data)) {
			$tampil[] = $row;
		}
		if (empty($tampil)) {
			return "No Data";
		} else {
			return $tampil;
		}
	}

	function add_permohonan($tgl_pelaporan, $user_id, $kantor_cabang, $nama_alat, $deskripsi_kerusakan, $foto_1, $foto_2, $foto_3, $status_pelaporan)
	{
		$query_add = mysqli_query(
			$this->conn->koneksi,
			"INSERT into db_permohonan (tgl_pelaporan, user_id, kantor_cabang, nama_alat, deskripsi_kerusakan, foto_1, foto_2, foto_3) 
								VALUES ('$tgl_pelaporan','$user_id','$kantor_cabang','$nama_alat','$deskripsi_kerusakan','$foto_1','$foto_2','$foto_3')"
		);

		// get last id_permohonan from session
		$query = mysqli_query($this->conn->koneksi, "SELECT id_permohonan from db_permohonan WHERE tgl_pelaporan = '$tgl_pelaporan' AND user_id = '$user_id' AND kantor_cabang = '$kantor_cabang' ");
		$detail =  $query->fetch_array();


		// tambahkan kedalam database db_jadwal
		$id_permohonan = $detail['id_permohonan'];
		$query_add_jadwal = mysqli_query(
			$this->conn->koneksi,
			"INSERT into db_jadwal (id_permohonan, user_id, status_pelaporan, estimasi_waktu) 
								VALUES ('$id_permohonan','$user_id','$status_pelaporan','')"
		);
		return TRUE;
	}

	function perbaikan_list()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * FROM db_permohonan WHERE jenis_pelaporan = 'Perbaikan' AND status_pelaporan = 'Menunggu Persetujuan' ");
		while ($row = mysqli_fetch_array($data)) {
			$tampil[] = $row;
		}
		if (empty($tampil)) {
			return "No Data";
		} else {
			return $tampil;
		}
	}

	function perawatan_list()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * FROM db_permohonan WHERE jenis_pelaporan = 'Perawatan' AND status_pelaporan = 'Menunggu Persetujuan' ");
		while ($row = mysqli_fetch_array($data)) {
			$tampil[] = $row;
		}
		if (empty($tampil)) {
			return "No Data";
		} else {
			return $tampil;
		}
	}

	function laporan_list()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * from db_permohonan INNER JOIN db_jadwal ON db_permohonan.id_permohonan = db_jadwal.id_permohonan");
		while ($row = mysqli_fetch_array($data)) {
			$tampil[] = $row;
		}
		if (empty($tampil)) {
			return "No Data";
		} else {
			return $tampil;
		}
	}

	function permohonan_detail($id_permohonan)
	{
		$query = mysqli_query($this->conn->koneksi, "SELECT * from db_permohonan INNER JOIN db_jadwal ON db_permohonan.id_permohonan = db_jadwal.id_permohonan WHERE db_permohonan.id_permohonan = '$id_permohonan' ");
		return $query->fetch_array();
	}

	function approve_perbaikan_list()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * from db_permohonan INNER JOIN db_jadwal ON db_permohonan.id_permohonan = db_jadwal.id_permohonan WHERE jenis_pelaporan = 'Perbaikan' AND status_pelaporan = 'Disetujui' ");
		while ($row = mysqli_fetch_array($data)) {
			$tampil[] = $row;
		}
		if (empty($tampil)) {
			return "No Data";
		} else {
			return $tampil;
		}
	}

	function approve_perawatan_list()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * from db_permohonan INNER JOIN db_jadwal ON db_permohonan.id_permohonan = db_jadwal.id_permohonan WHERE jenis_pelaporan = 'Perawatan' AND status_pelaporan = 'Disetujui' ");
		while ($row = mysqli_fetch_array($data)) {
			$tampil[] = $row;
		}
		if (empty($tampil)) {
			return "No Data";
		} else {
			return $tampil;
		}
	}

	function decline_perbaikan_list()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * from db_permohonan INNER JOIN db_jadwal ON db_permohonan.id_permohonan = db_jadwal.id_permohonan WHERE jenis_pelaporan = 'Perbaikan' AND status_pelaporan = 'Ditolak' ");
		while ($row = mysqli_fetch_array($data)) {
			$tampil[] = $row;
		}
		if (empty($tampil)) {
			return "No Data";
		} else {
			return $tampil;
		}
	}

	function decline_perawatan_list()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * from db_permohonan INNER JOIN db_jadwal ON db_permohonan.id_permohonan = db_jadwal.id_permohonan WHERE jenis_pelaporan = 'Perawatan' AND status_pelaporan = 'Ditolak' ");
		while ($row = mysqli_fetch_array($data)) {
			$tampil[] = $row;
		}
		if (empty($tampil)) {
			return "No Data";
		} else {
			return $tampil;
		}
	}

	function setujui_permohonan($id_permohonan)
	{
		$estimasi_waktu = date('d F Y', strtotime("+3 day", strtotime(date("d F Y"))));
		$query = mysqli_query($this->conn->koneksi, "UPDATE db_jadwal SET status_pelaporan = 'Disetujui',  estimasi_waktu = '$estimasi_waktu' WHERE id_permohonan = '$id_permohonan' ");

		return $query;
	}

	function tolak_permohonan($id_permohonan)
	{
		$query = mysqli_query($this->conn->koneksi, "UPDATE db_jadwal SET status_pelaporan = 'Ditolak',  estimasi_waktu = '' WHERE id_permohonan = '$id_permohonan' ");
		return $query;
	}

	function add_user($user_nip, $user_name, $user_gender, $user_photo, $user_role, $user_password)
	{
		$query_add = mysqli_query(
			$this->conn->koneksi,
			"INSERT into db_user (user_nip, user_name, user_gender, user_photo, user_role, user_password) VALUES ('$user_nip','$user_name','$user_gender','$user_photo','$user_role','$user_password')"
		);
		return $query_add;
	}

	function user_list()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * FROM db_user ");
		while ($row = mysqli_fetch_array($data)) {
			$tampil[] = $row;
		}
		if (empty($tampil)) {
			return "No Data";
		} else {
			return $tampil;
		}
	}

	function admin_list()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * FROM db_user WHERE user_role = 'AKC'");
		while ($row = mysqli_fetch_array($data)) {
			$tampil[] = $row;
		}
		if (empty($tampil)) {
			return "No Data";
		} else {
			return $tampil;
		}
	}

	function user_detail($user_nip)
	{
		$query = mysqli_query($this->conn->koneksi, "SELECT * from db_user WHERE user_nip = '$user_nip' ");
		return $query->fetch_array();
	}

	function edit_user($user_id, $user_name, $user_gender)
	{
		$query = mysqli_query($this->conn->koneksi, "UPDATE db_user SET user_name = '$user_name', user_gender = '$user_gender' WHERE user_id = '$user_id'");
		return TRUE;
	}

	function hapus_permohonan($id_permohonan)
	{
		$query = mysqli_query($this->conn->koneksi, "DELETE FROM db_permohonan WHERE id_permohonan = '$id_permohonan'");
		return TRUE;
	}

	function count_total_perbaikan()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * from db_permohonan INNER JOIN db_jadwal ON db_permohonan.id_permohonan = db_jadwal.id_permohonan WHERE jenis_pelaporan = 'Perbaikan'");
		$jumlah = mysqli_num_rows($data);
		return $jumlah;
	}

	function count_total_perawatan()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * from db_permohonan INNER JOIN db_jadwal ON db_permohonan.id_permohonan = db_jadwal.id_permohonan WHERE jenis_pelaporan = 'Perawatan'");
		$jumlah = mysqli_num_rows($data);
		return $jumlah;
	}

	function count_total_permohonan()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * from db_permohonan INNER JOIN db_jadwal ON db_permohonan.id_permohonan = db_jadwal.id_permohonan");
		$jumlah = mysqli_num_rows($data);
		return $jumlah;
	}

	function count_approve_perbaikan()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * from db_permohonan INNER JOIN db_jadwal ON db_permohonan.id_permohonan = db_jadwal.id_permohonan WHERE jenis_pelaporan = 'Perbaikan' AND status_pelaporan = 'Disetujui' ");
		$jumlah = mysqli_num_rows($data);
		return $jumlah;
	}

	function count_approve_perawatan()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * from db_permohonan INNER JOIN db_jadwal ON db_permohonan.id_permohonan = db_jadwal.id_permohonan WHERE jenis_pelaporan = 'Perawatan' AND status_pelaporan = 'Disetujui' ");
		$jumlah = mysqli_num_rows($data);
		return $jumlah;
	}

	function count_approve_permohonan()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * from db_permohonan INNER JOIN db_jadwal ON db_permohonan.id_permohonan = db_jadwal.id_permohonan WHERE status_pelaporan = 'Disetujui' ");
		$jumlah = mysqli_num_rows($data);
		return $jumlah;
	}

	function count_decline_permohonan()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * from db_permohonan INNER JOIN db_jadwal ON db_permohonan.id_permohonan = db_jadwal.id_permohonan WHERE status_pelaporan = 'Ditolak' ");
		$jumlah = mysqli_num_rows($data);
		return $jumlah;
	}

	function count_admin_kantor()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * FROM db_user WHERE user_role = 'AKC' ");
		$jumlah = mysqli_num_rows($data);
		return $jumlah;
	}

	function delete_user($uid)
	{
		$query = mysqli_query($this->conn->koneksi, "DELETE FROM db_user WHERE user_nip = '$uid'");
		return TRUE;
	}

	function edit_pelaporan($kantor_cabang, $nama_alat, $deskripsi_kerusakan, $id_permohonan)
	{
		$query = mysqli_query($this->conn->koneksi, "UPDATE db_permohonan SET kantor_cabang = '$kantor_cabang', nama_alat = '$nama_alat', deskripsi_kerusakan = '$deskripsi_kerusakan' WHERE id_permohonan = '$id_permohonan'");
		return TRUE;
	}

	function request_all()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * from db_permohonan INNER JOIN db_jadwal ON db_permohonan.id_permohonan = db_jadwal.id_permohonan");
		while ($row = mysqli_fetch_array($data)) {
			$tampil[] = $row;
		}
		if (empty($tampil)) {
			return "No Data";
		} else {
			return $tampil;
		}
	}

	function approve_permohonan_list()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * from db_permohonan INNER JOIN db_jadwal ON db_permohonan.id_permohonan = db_jadwal.id_permohonan WHERE status_pelaporan = 'Disetujui' ");
		while ($row = mysqli_fetch_array($data)) {
			$tampil[] = $row;
		}
		if (empty($tampil)) {
			return "No Data";
		} else {
			return $tampil;
		}
	}

	function decline_permohonan_list()
	{
		$data = mysqli_query($this->conn->koneksi, "SELECT * from db_permohonan INNER JOIN db_jadwal ON db_permohonan.id_permohonan = db_jadwal.id_permohonan WHERE  status_pelaporan = 'Ditolak' ");
		while ($row = mysqli_fetch_array($data)) {
			$tampil[] = $row;
		}
		if (empty($tampil)) {
			return "No Data";
		} else {
			return $tampil;
		}
	}
}
