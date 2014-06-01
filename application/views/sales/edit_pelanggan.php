<?php echo validation_errors(); ?>
<form action="<?php echo current_url(); ?>" method="post" name="form-edit">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<label>Nama</label>
	<input type="text" placeholder="nama" name="nama" value="<?php echo $nama; ?>">
	<label>Email</label>
	<input type="email" placeholder="email" name="email" value="<?php echo $email; ?>">
	<label>No. Telp.</label>
	<input type="text" placeholder="no. telp." name="no_telp" value="<?php echo $no_telp; ?>">
	<label>Website</label>
	<input type="text" placeholder="website" name="website" value="<?php echo $website; ?>">
	<label>Alamat</label>
	<input type="text" placeholder="alamat" name="alamat" value="<?php echo $alamat; ?>">

	<input type="submit" name="do-save" value="simpan" class="button">
</form>