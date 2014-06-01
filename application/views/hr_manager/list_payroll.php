<p class="desc">Disini anda dapat melihat daftar gaji karyawan di sistem ini</p>
<table>
	<tr>
		<th>
			Username
		</th>
		<th>
			Auth
		</th>
		<th>
			Tanggal
		</th>
		<th>
			Jumlah
		</th>
		<th>
		</th>
	</tr>
	<?php if (is_array($list)) {
	foreach($list as $item) : ?>
		<tr>
			<td>
				<a href="<?php echo base_url(); ?>/index.php/karyawan/edit_karyawan/<?php echo $item['id']; ?>">
					<?php echo $item['username']; ?>
				</a>
			</td>
			<td>
				<?php echo get_job_title($item['auth']); ?>
			</td>
			<td>
				<?php 
					echo $item['tanggal'];
				?>
			</td>
			<td>
				<?php 
					echo $item['jumlah'];
				?>
			</td>
			<td>
				<a href="<?php echo base_url('index.php/payroll/hapus_payroll/' . $item['id_payroll']); ?>">hapus</a>
			</td>
		</tr>
	<?php endforeach; }?>
</table>