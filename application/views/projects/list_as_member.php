
<p class="desc">Disini anda dapat melihat daftar project di sistem ini</p>
<table>
	<tr>
		<th>
		</th>
		<th>
			Nama
		</th>
		<th>
			PM
		</th>
		<th>
			Mulai
		</th>
		<th>
			Selesai
		</th>
		<th>
			Task
		</th>
	</tr>
	<?php foreach($list as $item) : ?>
		<tr>
			<td>
				<?php if($is_list_all) : ?>
					<?php if($item['is_done']): ?>
						<img src="<?php echo base_url('images/done.png'); ?>">
					<?php endif; ?>
				<?php endif; ?>
			</td>
			<td>
				<a href="<?php echo base_url(); ?>/index.php/projects/detail/<?php echo $item['id']; ?>">
					<?php echo $item['nama']; ?>
				</a>
			</td>
			<td>
				<?php echo $item['pm']; ?>
			</td>
			<td>
				<?php echo date('d M Y',strtotime($item['tanggal_mulai'])); ?>
			</td>
			<td>
				<?php echo date('d M Y',strtotime($item['tanggal_selesai'])); ?>
			</td>
			<td>
				<a href="<?php echo base_url('index.php/projects/task/' . $item['id']); ?>"><?php echo $item['task_count']; ?></a>
				
			</td>
		</tr>
	<?php endforeach; ?>
</table>