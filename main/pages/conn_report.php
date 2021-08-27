<?php
	require('fpdf/fpdf.php');
	//Membuat Koneksi ke database akademik
	$host="localhost";
	$user="root";
	$password="";
	$db="damkar";
	$kon = mysqli_connect($host,$user,$password,$db);
?>