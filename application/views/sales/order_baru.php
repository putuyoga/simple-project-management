<?php echo validation_errors(); ?>
<form action="<?php echo current_url(); ?>" method="post" name="form-order">
<?php print_r($pelanggan[0]);
echo "<br />";
print_r($status); ?>
	<label>Pelanggan</label>
	<?php echo form_dropdown('pelanggan', $pelanggan); ?>
    <label>Status</label>
    <?php echo form_dropdown('status', $status, set_value('status')); ?>
    <label>Harga</label>
    <input type="numeric" placeholder="harga(Rp.)" name="harga">
    <label>Tanggal</label>
    <input type="date" placeholder="tttt-bb-hh" name="tanggal">
    <label>Catatan</label>
    <textarea rows="4" name="catatan"> </textarea>
	<input type="submit" name="do-create" value="buat" class="button">
</form>

