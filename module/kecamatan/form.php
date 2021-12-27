<?php

	$kecamatan_id = isset($_GET['kecamatan_id']) ? $_GET['kecamatan_id'] : false;
	
	$kecamatan = "";
	$tarif = "";
	$status = "";
	$button = "Add";

	if($kecamatan_id){
		$queryKecamatan = mysqli_query($koneksi, "SELECT * FROM kecamatan WHERE kecamatan_id='$kecamatan_id'");
		$row=mysqli_fetch_assoc($queryKecamatan);
		
		$kecamatan = $row['kecamatan'];
		$tarif = $row['tarif'];
		$status = $row['status'];
		
		$button = "Update";
	}
		
?>
<form action="<?php echo BASE_URL."module/kecamatan/action.php?kecamatan_id=$kecamatan_id"?>" method="post">

    <div class="element-form">
        <label>Kecamatan</label>
        <span><input type="text" name="kecamatan" value="<?php echo $kecamatan; ?>" /></span>
    </div>

    <div class="element-form">
        <label>Tarif</label>
        <span><input type="text" name="tarif" value="<?php echo $tarif; ?>" /></span>
    </div>

    <div class="element-form">
        <label>Status</label>
        <span>
            <input type="radio" name="status" value="on" <?php if($status == "on"){ echo "checked"; } ?> /> On
            <input type="radio" name="status" value="off" <?php if($status == "off"){ echo "checked"; } ?> /> Off
        </span>
    </div>

    <div class="element-form">
        <span><input type="submit" name="button" value="<?php echo $button; ?>" class="submit-my-profile" /></span>
    </div>

</form>