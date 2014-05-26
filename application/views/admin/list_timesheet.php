<script src="<?php echo base_url('js/anytime.5.0.1-1403131246.min.js'); ?>"></script>

<div>
	<select id="filter_picker" style="width: 100px; float: left;  margin-right: 10px;">
		<option id="date" value="date">tanggal</option>
		<option id="month" value="month">bulan</option>
		<option id="year" value="year">tahun</option>
	</select>
	<input type="text" name="filter_date" id="filter_date" value="<?php echo $select_date; ?>" style="width: 100px; float: left;  margin-right: 10px;">
	<input type="text" name="filter_month" id="filter_month" value="<?php echo $select_month; ?>" style="width: 100px; float: left;  margin-right: 10px; display: none;">
	<input type="text" name="filter_year" id="filter_year" value="<?php echo $select_year; ?>" style="width: 100px; float: left;  margin-right: 10px; display: none;">
	<input type="submit" name="do-filter" value="filter" class="button" style="width: 60px; float: left; padding: 3px;" id="filterButton">
	</form>
</div>
<script>
var selectedFilter = 0;
var base_url = '<?php echo base_url('index.php/admin/timesheet'); ?>/';
$('#filter_picker').val('<?php echo $select_filter == '' ? 'date' : $select_filter; ?>');
//init picker
$("#filter_date").AnyTime_picker( {
format: "%Y-%m-%d",
hideInput: false});
$("#filter_month").AnyTime_picker( {
format: "%M",
hideInput: false});
$("#filter_year").AnyTime_picker( {
format: "%Y",
hideInput: false});

//init end

$('#filterButton').click(function()
{
	if(selectedFilter == 0)
	{
		window.location.href = base_url + 'date/' + $("#filter_date").val();
	}
	else if(selectedFilter == 1)
	{
		window.location.href = base_url + 'month/' + $("#filter_month").val();
	}
	else if(selectedFilter == 2)
	{
		window.location.href = base_url + 'year/' + $("#filter_year").val();
	}
});

//change event handler
$('#filter_picker').change(function()
{
	var selected = $("#filter_picker option:selected").attr('id');
	changeFilter(selected);
}).change();

function changeFilter(type)
{
	if(type == 'date')
	{
		$('#filter_date').show();
		$('#filter_month').hide();
		$('#filter_year').hide();
		selectedFilter = 0;
	}
	else if(type == 'month')
	{
		$('#filter_date').hide();
		$('#filter_month').show();
		$('#filter_year').hide();
		selectedFilter = 1;
	}
	else if(type == 'year')
	{
		$('#filter_date').hide();
		$('#filter_month').hide();
		$('#filter_year').show();
		selectedFilter = 2;
	}
}
</script>
<table>
	<tr>
		<th>
			Username
		</th>
		<th>
			Sesi Terakhir
		</th>
		<th>
			Durasi (jam)
		</th>
	</tr>
	<?php if(!is_array($list)) return; ?>
	<?php foreach($list as $item) : ?>
		<tr>
			<td>
				<a href="<?php echo base_url(); ?>/index.php/admin/list_ts/<?php echo $item['id_user']; ?>"><?php echo $item['username']; ?></a>
			</td>
			<td>
				<?php if($item['is_online'] == '0000-00-00 00:00:00') : ?>
					online
				<?php else : ?>
				<?php echo $item['last']; ?>
				<?php endif; ?>
			</td>
			<td>
				<?php 
					//print_r($item); die();
					if($item['is_online'] == '0000-00-00 00:00:00')
					{
						$item['totaltime'] = "<a href='" . base_url('index.php/admin/stop_ts/' . $item['id_user']) . "' title='stop'><small>" . $item['totaltime'] . "</small></a>";
					}
					
					echo $item['totaltime'];
					
				?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>