<?php echo validation_errors(); ?>
<form action="<?php echo current_url(); ?>" method="post" name="form-login">
	<label>nama project</label>
	<br/>
	<input type="text" id="nama" placeholder="nama project" name="nama" value="<?php echo set_value('nama'); ?>">
	<div style="width: 40%; float: left; margin-right: 10px;">
		<?php $style = 'style=" width: 100%; margin-bottom: 20px"'; ?>
		<label>order</label>
		<br/>
		<?php echo form_dropdown('id_order', $order_list, '', $style); ?>
		<br/>
		<?php $style = 'style=" width: 100%; margin-bottom: 20px"'; ?>
		<label>project manager</label>
		<br/>
		<?php echo form_dropdown('project_manager', $pm_list, '', $style); ?>
	</div>
	<div style="width: 50%; float: right;">
		<label>tanggal mulai</label>
		<br/>
		<input type="text" id="tanggal_mulai" placeholder="tanggal mulai" name="tanggal_mulai" value="<?php echo set_value('tanggal_selesai'); ?>">
		<label>tanggal selesai</label>
		<br/>
		<input type="text" id="tanggal_selesai" placeholder="tanggal selesai" name="tanggal_selesai" value="<?php echo set_value('tanggal_selesai'); ?>">
	</div>
	<label>anggota tim</label>
	<br/>
	<?php $style = 'style=" width: 100%; margin-bottom: 30px;"'; ?>
	<?php if($em_list !== NULL) : ?>
		<?php echo form_multiselect('anggota_tim[]', $em_list, '', $style); ?>
	<?php else: ?>
		<span style="color: red;">tidak ada karyawan</span>
	<?php endif; ?>
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

$("#tanggal_mulai").AnyTime_picker( {
    format: "%Y-%m-%d",
    hideInput: false} );

	$("#tanggal_selesai").AnyTime_picker( {
    format: "%Y-%m-%d",
    hideInput: false} );
</script>