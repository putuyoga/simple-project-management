<?php echo validation_errors(); ?>
<form action="<?php echo current_url(); ?>" method="post" name="form-order">
	<label>Pelanggan</label>
    <div class="mediumtext" style="padding:6px; margin-bottom:10px"><?php echo $id_pelanggan; ?></div>
    <label>Nama Project</label>
    <input type="text" placeholder="nama" name="nama" value="<?php echo $nama; ?>">
    <label>Sales Person</label>
    <div class="mediumtext" style="padding:6px; margin-bottom:10px" ><?php echo $sales_person; ?></div>
    <label>Status</label>
    <?php echo form_dropdown('status', $status, set_value('status')); ?>
    <label>Harga</label>
    <input type="numeric" placeholder="harga(Rp.)" name="harga" value="<?php echo $harga; ?>" >
    <label>Tanggal</label>
    <input type="date" placeholder="tttt-bb-hh" name="tanggal" id="tanggal" value="<?php echo date('d M Y',strtotime($tanggal)); ?>" >
    <label>Catatan</label>
    <textarea rows="4" name="catatan" ><?php echo $catatan; ?> </textarea>
	<input type="submit" name="do-create" value="buat" class="button"  >
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
