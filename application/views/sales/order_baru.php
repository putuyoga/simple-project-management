<?php echo validation_errors(); ?>
<form action="<?php echo current_url(); ?>" method="post" name="form-order">

	<label>Pelanggan</label>
	<?php  if(count($pelanggan > 0) && $pelanggan != NULL): ?>
	<?php echo form_dropdown('id_pelanggan', $pelanggan, '', 'id="pelanggan"'); ?>
	<?php else: ?>
	<div>Tidak ada pelanggan</div>
	<?php endif; ?>
	<br />
    <label>Nama Project</label>
    <input type="text" placeholder="nama" name="nama">
    <label>Status</label>
    <?php echo form_dropdown('status', $status, set_value('status')); ?>
    <label>Harga</label>
    <input type="numeric" placeholder="harga(Rp.)" name="harga">
    <label>Tanggal</label>
    <input placeholder="tanggal" name="tanggal" id="tanggal">
    <label>Catatan</label>
    <textarea rows="4" name="catatan"> </textarea>
	<input type="submit" name="do-create" value="buat" class="button">
</form>
<script src="<?php echo base_url('js/select2.min.js'); ?>"></script>
<script src="<?php echo base_url('js/anytime.5.0.1-1403131246.min.js'); ?>"></script>
<script>
$('#pelanggan').select2(
	{
		allowClear: true
	}
);

$("#tanggal").AnyTime_picker( {
    format: "%Y-%m-%d",
    hideInput: false} );

	$("#tanggal_selesai").AnyTime_picker( {
    format: "%Y-%m-%d",
    hideInput: false} );
</script>
