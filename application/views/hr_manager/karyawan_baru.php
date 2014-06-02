<?php echo validation_errors(); ?>
<form action="<?php echo current_url(); ?>" method="post" name="form-login">
<?php $style = 'style=" width: 100%; margin-bottom: 20px"'; ?>
	<input type="text" placeholder="username" name="username" value="<?php echo set_value('username'); ?>">
	<input type="text" placeholder="email" name="email" value="<?php echo set_value('email'); ?>">
	<input type="password" placeholder="password" name="password">
	<input type="password" placeholder="ketik ulang password" name="repassword">
	<input type="hidden" value="1" name="auth">
	<?php echo form_dropdown('auth', $list_auth, set_value('auth'), $style); ?>
	<input type="submit" name="do-create" value="buat" class="button">
</form>
<script src="<?php echo base_url('js/select2.min.js'); ?>"></script>
<script src="<?php echo base_url('js/anytime.5.0.1-1403131246.min.js'); ?>"></script>
<script>
$('select').select2(
	{
		allowClear: true
	}
);

</script>