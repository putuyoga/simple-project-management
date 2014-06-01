
<p class="desc">Disini anda dapat melihat daftar task yang ada di project ini</p>
<?php if($list != NULL): ?>
<table>
	<tr>
		<th>
		
		</th>
		<th style="width:35%;">
			Nama
		</th>
		<th style="width:20%;">
			Assigned To
		</th>
		<th style="width:15%;">
			Deadline
		</th>
		<th style="width:25%;">
			Progress
		</th>
		<th></th>
	</tr>
	<?php foreach($list as $item) : ?>
		<tr>
			<td>
			<img src="<?php echo base_url('images/' . $item['prioritas'] . '.png'); ?>" title="<?php echo $item['prioritas']; ?>">
			</td>
			<td style="width:30%;">
				<a href="<?php echo base_url(); ?>/index.php/tasks/detail/<?php echo $item['id']; ?>">
					<?php echo $item['nama']; ?>
				</a>
			</td>
			<td  style="width:20%;">
				<?php echo $item['assigned_username']; ?>
			</td>
			<td style="width:15%;">
				<?php echo date('d M Y',strtotime($item['deadline'])); ?>
			</td>
			<td style="width:20%;">
			<?php //untuk atur warna dan lebar progress
				if($item['progress'] > 80)
				{
					$bg = '#27ae60';
				}
				elseif($item['progress'] > 40)
				{
					$bg = '#f39c12';
				}
				else
				{
					$bg = '#c0392b';
				}
				
				$width = $item['progress'] . '%';
				$style = 'style="background-color: ' . $bg . '; width: ' . $width . ';"';
			?>
			<div id="progress"><span id="percent"><?php echo $item['progress']; ?>%</span><div id="bar" <?php echo $style; ?>></div></div>
			</td>
			<td style="width:15%;">
				<?php if($item['assigned_to'] == $member_id): ?>
					<a href="<?php echo base_url('index.php/tasks/edit/' . $item['id']); ?>">update</a>
				<?php endif; ?>
				
			</td>
		</tr>
	<?php endforeach; ?>
</table>
<?php else: ?>
tidak ada task
<?php endif; ?>