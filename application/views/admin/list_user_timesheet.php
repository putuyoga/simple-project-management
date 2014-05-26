<table>
	<tr>

		<th>
			Mulai
		</th>
		<th>
			Selesai
		</th>
		<th>
			Durasi (jam)
		</th>
		<th>
			
		</th>
	</tr>
	<?php if(!is_array($list)) return; ?>
	<?php foreach($list as $item) : ?>
		<tr>

			<td>
				<?php echo $item['start']; ?>
			</td>
			<td>
				<?php if($item['end'] == '0000-00-00 00:00:00') : ?>
					<span style="text-decoration: underline;">progress+</span>
				<?php else: ?>
					<?php echo $item['end']; ?>
				<?php endif; ?>
			</td>
			<td>
				<?php 
					$waktu = new DateTime($item['start']);
					if($item['end'] == '0000-00-00 00:00:00')
					{
						$now = new DateTime('now');
						$item['totaltime'] = "+ " . round(($now->format('U') - $waktu->format('U'))/3600, 4);
					}
					else 
					{
						$now = new DateTime($item['end']);
						$item['totaltime'] = round(($now->format('U') - $waktu->format('U'))/3600, 4);
					}
					
					echo $item['totaltime'];
					
				?>
			</td>
			<td>
				<a href="<?php echo base_url(); ?>/index.php/admin/edit_ts/<?php echo $item['id']; ?>"><small>edit</small></a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>