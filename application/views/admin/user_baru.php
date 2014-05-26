<?php echo validation_errors(); ?>
<form action="<?php echo current_url(); ?>" method="post" name="form-login">
	<input type="text" placeholder="username" name="username" value="<?php echo set_value('username'); ?>">
	<input type="text" placeholder="email" name="email" value="<?php echo set_value('email'); ?>">
	<input type="password" placeholder="password" name="password">
	<input type="password" placeholder="ketik ulang password" name="repassword">
	<?php echo form_dropdown('auth', $list_auth, set_value('auth')); ?>
	<input type="submit" name="do-create" value="buat" class="button">
</form>