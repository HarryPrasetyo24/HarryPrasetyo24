<?php
    include("../../frontend/function/koneksi.php");   
    include("../../frontend/function/helper.php");  
	
	admin_only("berita", $level);
     
    $berita = $_POST['berita'];
    $isi = $_POST['isi'];
    $status = $_POST['status'];
    $button = $_POST['button'];
    $edit_gambar = "";
	
 
    if($_FILES["file"]["name"] != "")
    {
        $nama_file = $_FILES["file"]["name"];
        move_uploaded_file($_FILES["file"]["tmp_name"], "../../frontend/images/berita/" . $nama_file);
         
        $edit_gambar  = ", gambar='$nama_file'";
    }
     
    if($button == "Add")
    {
        mysqli_query($koneksi, "INSERT INTO berita (berita, isi, gambar, status) 
                                            VALUES ('$berita', '$isi', '$nama_file', '$status')");
    }
    elseif($button == "Update")
    {
	    $berita_id = $_GET['berita_id'];
		
        mysqli_query($koneksi, "UPDATE berita SET berita='$berita',
                                        isi='$isi',
                                        status='$status'
										$edit_gambar WHERE berita_id='$berita_id'");
    }
     
     
    header("location: ".BASE_URL."my_profile.php?page=my_profile&module=berita&action=list");
?>