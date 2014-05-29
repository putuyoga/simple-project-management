<?php echo validation_errors(); ?>
<form action="<?php echo current_url(); ?>" method="post" name="form-login">
	<input type="text" placeholder="nama" name="nama" value="<?php echo set_value('nama'); ?>">
	<input type="email" placeholder="email" name="email" value="<?php echo set_value('email'); ?>">
	<input type="text" placeholder="no_telp" name="no_telp">
	<input type="text" placeholder="website" name="website">
    <input type="text" placeholder="alamat" name="alamat">
	<input type="submit" name="do-create" value="buat" class="button">
</form>

