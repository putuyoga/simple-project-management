<?php echo validation_errors(); ?>
<form action="<?php echo current_url(); ?>" method="post" name="form-login">
	<?php echo form_dropdown('auth', $list_auth, set_value('auth')); ?>
	<input type="text" placeholder="username" name="username" value="<?php echo set_value('username'); ?>">
	<input type="text" placeholder="tanggal" name="tanggal" value="<?php echo set_value('email'); ?>">
	<input type="password" placeholder="jumlah" name="password">
	<input type="hidden" value="1" name="auth">
	<input type="submit" name="do-create" value="buat" class="button">
</form>