<?php

session_start();
include_once("frontend/function/koneksi.php");
	include_once("frontend/function/helper.php");
	
	
	
	$nama_penebus = $_POST["nama_penebus"];
	$nomor_penebus = $_POST["nomor_penebus"];
	$alamat_penebus = $_POST["alamat_penebus"];
	$kecamatan = $_POST["kecamatan"];
	$edit_gambar = "";
	
	$user_id = $_SESSION['user_id'];
	$waktu_saat_ini = date("Y-m-d H:i:s");

		    if($_FILES["file"]["name"] != "")
    {
        $nama_file = $_FILES["file"]["name"];
        move_uploaded_file($_FILES["file"]["tmp_name"], "frontend/images/resep/" . $nama_file);

		$edit_gambar  = ", gambar_resep='$nama_file'";
         
    }
	
	$query = mysqli_query($koneksi, "INSERT INTO resep (nama_penebus, user_id, nomor_penebus, kecamatan_id, alamat_penebus, gambar_resep, harga, tanggal_penebusan, status)
												VALUES ('$nama_penebus', '$user_id', '$nomor_penebus','$kecamatan','$alamat_penebus','$nama_file','0','$waktu_saat_ini','0')");
												

		$last_resep_id = mysqli_insert_id($koneksi);
			$harga = $value['harga'];
		
			mysqli_query($koneksi, "INSERT INTO resep_detail(resep_id,  gambar_resep, harga)
													VALUES ('$last_resep_id', '$nama_file','$harga')");

		
		header("location:".BASE_URL."my_profile.php?page=my_profile&module=resep&action=list&resep_id=$last_resep_id");
	

?>