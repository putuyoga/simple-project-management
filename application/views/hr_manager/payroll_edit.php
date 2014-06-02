<?php echo validation_errors(); ?>
<form action="<?php echo current_url(); ?>" method="post" name="form-login">
<?php $style = 'style=" width: 100%; margin-bottom: 20px"'; ?>
	<?php echo form_dropdown('id_user', $em_list, $id_user, $style); ?>
	<input type="text" id='tanggal' placeholder="tanggal" name="tanggal" value="<?php echo $tanggal; ?>">
	<input type="text" placeholder="gaji" name="gaji" value="<?php echo $gaji; ?>">
	<input type="text" placeholder="bonus" name="bonus" value="<?php echo $bonus; ?>">
	<?php echo form_dropdown('status', $list_status, $status, $style); ?>
	<input type="submit" name="do-create" value="simpan" class="button">
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