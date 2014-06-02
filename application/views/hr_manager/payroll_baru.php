<?php echo validation_errors(); ?>
<form action="<?php echo current_url(); ?>" method="post" name="form-login">
<?php $style = 'style=" width: 100%; margin-bottom: 20px"'; ?>
		<?php echo form_dropdown('id_user', $em_list, '', $style); ?>
	<!--<input type="text" placeholder="username" name="username" value="<?php //echo set_value('username'); ?>">-->
	<input type="text" id='tanggal' placeholder="tanggal" name="tanggal" value="<?php echo set_value('tanggal'); ?>">
	<input type="text" placeholder="gaji" name="gaji" value="<?php echo set_value('gaji'); ?>">
	<input type="text" placeholder="bonus" name="bonus" value="<?php echo set_value('bonus'); ?>">
	<?php echo form_dropdown('status', $list_status, set_value('status'), $style); ?>
	<!--<input type="text" placeholder="status" name="username" value="<?php //echo set_value('username'); ?>"> -->
	<!--<input type="hidden" value="1" name="auth">-->
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

$("#tanggal").AnyTime_picker( {
    format: "%Y-%m-%d",
    hideInput: false} );
</script>