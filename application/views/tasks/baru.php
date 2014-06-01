<?php echo validation_errors(); ?>
<form action="<?php echo current_url(); ?>" method="post" name="form-login">
	<label>nama task</label>
	<br/>
	<input type="text" id="nama" placeholder="nama task" name="nama" value="<?php echo set_value('nama'); ?>">
	<div style="display: table; width: 100%; ">
		<div style="display: table-row;">
			<div style="display: table-cell; margin-right: 20px; width: 5s0%">
				<?php $style = 'style=" width: 100%; margin-bottom: 20px"'; ?>
				<label>assigned to</label>
				<br/>
				<?php 
					if(isset($anggota_tim))
					{
						if($anggota_tim !== NULL)
						{
							echo form_dropdown('assigned_to', $anggota_tim, '', $style . ' class="select2"');
						}
						else
						{
							echo "tidak ada anggota tim";
						}
					}
					else
					{
						echo "pilih project dulu";
					}
				?>
				<label>prioritas</label>
				<br/>
				<?php echo form_dropdown('prioritas', $prioritas_list, '', $style); ?>
			</div>
			<div style="display: table-cell; width: 50%">
			<div style="margin-left: 20px;">
				<label>project</label>
				<br/>
				<?php
					$style .= ' id="project" class="select2"';
					echo form_dropdown('id_project', $project_list, $id, $style);
				?>
				<label>deadline</label>
				<br/>
				<input type="text" id="deadline" placeholder="deadline" name="deadline" value="<?php echo set_value('deadline'); ?>">
			</div>
			</div>
			
		</div>
	</div>
	<label>deskripsi</label>
	<br/>
	<textarea name="deskripsi" style="width: 100%; height: 100px; margin-bottom: 15px;"></textarea>
	<input type="submit" name="do-create" value="buat" class="button">
</form>
<script src="<?php echo base_url('js/select2.min.js'); ?>"></script>
<script src="<?php echo base_url('js/anytime.5.0.1-1403131246.min.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery-te-1.4.0.min.js'); ?>"></script>
<script>
$("textarea").jqte();

$('.select2').select2(
	{
		allowClear: true
	}
);

$('#project').change(function()
{
	var id = $('#project').val();
	window.location.replace('<?php echo base_url('index.php/tasks/baru'); ?>/' + id);
});

$("#deadline").AnyTime_picker( {
    format: "%Y-%m-%d",
    hideInput: false} );

	$("#tanggal_selesai").AnyTime_picker( {
    format: "%Y-%m-%d",
    hideInput: false} );
</script>