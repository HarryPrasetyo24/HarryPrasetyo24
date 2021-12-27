<?php
       
    $berita_id = isset($_GET['berita_id']) ? $_GET['berita_id'] : "";
       
    $berita = "";
	$isi = "";
    $gambar = "";
    $status = "";
	$keterangan_gambar = "";
       
    $button = "Add";
       
    if($berita_id != ""){
        $queryBerita = mysqli_query($koneksi, "SELECT * FROM berita WHERE berita_id='$berita_id'");
        $row=mysqli_fetch_array($queryBerita);
        
		$berita = $row["berita"];
		$isi = $row['isi'];
		$gambar = "<img src='".BASE_URL."frontend/images/berita/$row[gambar]' style='width: 200px;vertical-align: middle;' />";
		$status = $row["status"];
        $button = "Update";

		$keterangan_gambar = "(klik 'Pilih Gambar' hanya jika tidak ingin mengganti gambar)";
    }   
?>
<script src="<?php echo BASE_URL."frontend/libraries/ckeditor/ckeditor.js";?>"></script>

<form action="<?php echo BASE_URL."module/berita/action.php?berita_id=$berita_id"; ?>" method="POST"
    enctype="multipart/form-data">

    <div class="element-form">
        <label>Judul Berita</label>
        <span><input type="text" name="berita" value="<?php echo $berita; ?>" /></span>
    </div>

    <div style="margin-bottom:10px" ;>
        <label style="font-weight:bold" ;>Isi Berita</label>
        <span><textarea name="isi" id="editor"><?php echo $isi; ?></textarea></span>
    </div>

    <div class="element-form">
        <label>Gambar <?php echo $keterangan_gambar; ?></label>
        <span><input type="file" name="file" /><?php echo $gambar; ?></span>
    </div>

    <div class="element-form">
        <label>Status</label>
        <span>
            <input type="radio" value="on" name="status" <?php if($status == "on"){ echo "checked"; } ?> /> On
            <input type="radio" value="off" name="status" <?php if($status == "off"){ echo "checked"; } ?> /> Off
        </span>
    </div>

    <div class="element-form">
        <span><input type="submit" name="button" value="<?php echo $button; ?>" class="submit-my-profile" /></span>
    </div>
</form>

<script>
CKEDITOR.replace("editor");
</script>