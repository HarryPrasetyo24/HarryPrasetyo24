<?php

	$resep_id = $_GET["resep_id"];

	$query=mysqli_query($koneksi, "SELECT status FROM resep WHERE resep_id='$resep_id'");
	$row=mysqli_fetch_assoc($query);
	$status = $row['status'];
    $harga = "";

    if($resep_id){
		$query = mysqli_query($koneksi, "SELECT * FROM resep WHERE resep_id='$resep_id'");
		$row = mysqli_fetch_assoc($query);
		

		$harga = $row['harga'];
	}


?>
<form action="<?php echo BASE_URL."module/resep/action.php?resep_id=$resep_id"; ?>" method="POST">

    <div class="element-form">
        <label>Resep ID (Faktur ID)</label>
        <span><input type="text" value="<?php echo $resep_id; ?>" name="resep_id" readonly="true" /></span>

        <div class="element-form">
            <label>Status</label>
            <span>
                <select name="status">
                    <?php 
				
                foreach($arrayStatusPesanan AS $key => $value){
                    if($status == $key){
                        echo "<option value ='$key' selected='true'>$value</option>";	
						}
						else{
                            echo "<option value ='$key'>$value</option>";
						}
					}
                    
                    ?>
                </select>
            </span>
        </div>
    </div>
    <div class="element-form">
        <label>Harga Resep</label>
        <span><input type="text" name="harga" value="<?php echo $harga; ?>" />

        </span>
    </div>

    <div class="element-form">
        <span><input class="tombol-action" type="submit" value="Edit Status" name="button" /></span>
    </div>
</form>