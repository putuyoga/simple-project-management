<?php echo validation_errors(); ?>
<form action="<?php echo current_url(); ?>" method="post" name="form-edit">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<!--<label>authority</label> -->
	<?php //echo form_dropdown('auth', $list_auth, $auth); ?>
	<input type="hidden" name="auth" value="1">
	<label>username</label>
	<input type="text" placeholder="username" name="username" value="<?php echo $username; ?>">
	<label>email</label>
	<input type="text" placeholder="email" name="email" value="<?php echo $email; ?>">
	<label>password</label>
	<input type="password" placeholder="password" name="password">
	<label>ulangi password</label>
	<input type="password" placeholder="ketik ulang password" name="repassword">

	<input type="submit" name="do-save" value="simpan" class="button">
</form>