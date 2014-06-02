<style>
	[class^=slider] { display: inline-block; margin-bottom: 15px; }
	.output { color: #888; font-size: 14px; padding-top: 1px; margin-left: 5px; vertical-align: top;}
  </style>
<?php echo validation_errors(); ?>
<script src="<?php echo base_url('js/simple-slider.min.js'); ?>"></script>
<form action="<?php echo current_url(); ?>" method="post" name="form-login">
	<label>nama task</label>
	<br/>
	<input type="text" id="nama" placeholder="nama task" name="nama" value="<?php echo $nama; ?>">
	<div style="display: table; width: 100%;">
		<div style="display: table-row;">
			<div style="display: table-cell; margin-right: 20px; width: 50%">
				<?php $style = 'style=" width: 100%; margin-bottom: 20px"'; ?>
				<label>assigned to</label>
				<br/>
				<?php 
					
					if(isset($anggota_tim))
					{
						if($anggota_tim !== FALSE)
						{
							echo form_dropdown('assigned_to', $anggota_tim, $assigned_to, $style . ' class="select2"');
						}
						else
						{
							echo "<div>tidak ada anggota tim</div>";
						}
					}
					else
					{
						echo "<div>pilih project dulu</div>";
					}
				?>
				<br/>
				<label>prioritas</label>
				<br/>
				<?php echo form_dropdown('prioritas', $prioritas_list, $prioritas, $style); ?>
			</div>
			<div style="display: table-cell; width: 50%">
			<div style="margin-left: 20px;">
				<label>project</label>
				<br/>
				<?php
					$style .= ' id="project" class="select2"';
					echo form_dropdown('id_project', $project_list, $id_project, $style);
				?>
				<label>deadline</label>
				<br/>
				<input type="text" id="deadline" placeholder="deadline" name="deadline" value="<?php echo $deadline; ?>">
			</div>
			</div>
			
		</div>
	</div>
	<label>progress</label>
	<br/>
		<input type="text" data-slider="true" data-slider-step="1" data-slider-highlight="true" data-slider-range="0,100" name="progress" value="<?php echo $progress; ?>">
	<br/>
	<label>deskripsi</label>
	
	<br/>
	<textarea name="deskripsi" style="width: 100%; height: 100px; margin-bottom: 15px;"><?php echo $deskripsi; ?></textarea>
	<input type="submit" name="do-create" value="simpan" class="button">
</form>
<script src="<?php echo base_url('js/select2.min.js'); ?>"></script>
<script src="<?php echo base_url('js/anytime.5.0.1-1403131246.min.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery-te-1.4.0.min.js'); ?>"></script>
<script>

//buat progress slider
$("[data-slider]")
.each(function () {
  var input = $(this);
  $("<span>")
	.addClass("output")
	.insertAfter($(this));
})
.bind("slider:ready slider:changed", function (event, data) {
  $(this)
	.nextAll(".output:first")
	  .html(data.value + " %");
});

//buat textarea editor
$("textarea").jqte();

$('.select2').select2(
	{
		allowClear: true
	}
);

//buat project change event listener
$('#project').change(function()
{
	var id = $('#project').val();
	window.location.replace('<?php echo base_url('index.php/tasks/edit/' . $id); ?>/?set_project=' + id);
});

//buat date picker untuk deadline
$("#deadline").AnyTime_picker( {
    format: "%Y-%m-%d",
    hideInput: false} );

	$("#tanggal_selesai").AnyTime_picker( {
    format: "%Y-%m-%d",
    hideInput: false} );
</script>