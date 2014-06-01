
<p class="desc">Disini anda dapat melihat daftar project di sistem ini</p>
<table>
	<tr>
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