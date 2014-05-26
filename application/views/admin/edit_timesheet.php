<script src="<?php echo base_url(); ?>js/anytime.5.0.1-1403131246.min.js"></script>
<form action="<?php echo current_url(); ?>" method="post" name="form-login">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<label>user</label><?php echo form_dropdown('id_user', $list_user, $id_user); ?>
	<label>waktu mulai</label><input type="datetime" placeholder="waktu mulai" name="start" value="<?php echo $start;?>" id="startDate">
	<label>waktu selesai</label><input type="datetime" placeholder="waktu selesai" name="end" value="<?php echo $end;?>" id="endDate">
	<input type="submit" name="do-save" value="simpan" class="button">
</form>
<script>
  $("#startDate").AnyTime_picker( {
    format: "%Y-%m-%d %H:%i:%s",
    formatUtcOffset: "%: (%@)",
    hideInput: false});
	$("#endDate").AnyTime_picker( {
    format: "%Y-%m-%d %H:%i:%s",
    formatUtcOffset: "%: (%@)",
    hideInput: false});
  </script>